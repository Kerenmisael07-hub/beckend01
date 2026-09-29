<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //cek apakah sudah login atau sudah punya token
        if (!session()->has('auth.token')) {
            return redirect()
                ->route('auth.index')
                ->withErrors(['msg' => 'Anda harus login terlebih dahulu.']);
        }
        return $next($request);
    }
} 