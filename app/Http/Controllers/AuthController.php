<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    private ApiService $api;

    public function __construct()
    {
        $this->api = new ApiService();
    }

    public function index()
    {
        return view('login');
    }

    public function verify(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        try {
            $resp = $this->api->requestResource('POST', 'users/login', $validated);
            $body = $resp['body'] ?? null;

            if (!is_array($body) || !isset($body['data'])) {
                throw new \RuntimeException('Invalid login response.');
            }

            session([
                'auth.username' => $body['data']['username'] ?? $validated['username'],
                'auth.name' => $body['data']['name'] ?? $validated['username'],
                'auth.token' => $body['data']['token'] ?? null,
                'auth.logged_in_at' => now()->toDateTimeString(),
                'auth.session_id' => (string) Str::uuid(),
            ]);

            return redirect()->intended(route('dashboard.index'))
                ->with('success', 'Berhasil masuk. Selamat datang!');
        } catch (\Throwable $e) {
            Log::error('Login exception', ['message' => $e->getMessage()]);

            return back()
                ->withInput($request->only('username'))
                ->withErrors(['msg' => 'Email dan password salah.']);
        }
    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('auth.index')->with('success', 'Berhasil logout.');
    }

    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name'    => ['required'],
        'username'    => ['required'],
        'password' => ['required']
    ]);

    try {
        $resp = $this->api->requestResource('POST', 'users', $validated);
        $body   = $resp['body']??null;

        return redirect()->intended(route('auth.register'))
            ->with('success', 'Berhasil register!');

    } catch (\Throwable $e) {
        Log::error('Register exception', ['message' => $e->getMessage()]);
        return back()->withErrors(['msg' => 'Gagal register.']);
    }
}
}