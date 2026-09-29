<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //jika sudah login redirect ke dashboard
        if(session()->has('auth.token')){
            return redirect()->route('dashboard.index');
        }
        return $next($request);
    }
}