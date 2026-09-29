<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    private $api;
    public function __construct()
    {
        $this->api = new ApiService();
    }

    public function index()
    {
        return view('dashboard');
    }
    public function profile()
    {
        $body = $this->getCurrentUser();
        return view('profile',compact('body'));
    }

    public function editProfile()
    {
        $body = $this->getCurrentUser();

        return view('profileEdit', compact('body'));
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $header = [
            'Authorization' => session()->get('auth.token'),
        ];

        $resp = $this->api->requestResource('PATCH', 'users/current', $validated, $header);

        if (($resp['status'] ?? 500) >= 400) {
            Log::warning('Profile update failed', ['response' => $resp]);

            return back()
                ->withInput()
                ->withErrors(['msg' => 'Gagal update profile.']);
        }

        return redirect()->route('profile.index')->with('success', 'Profile berhasil diupdate.');
    }

    private function getCurrentUser(): mixed
    {
        $header = [
            'Authorization' => session()->get('auth.token'),
        ];

        $resp = $this->api->requestResource('GET', 'users/current', null, $header);

        return $resp['body'] ?? null;
    }
}