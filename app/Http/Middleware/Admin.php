<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('login'); // Arahkan ke halaman login jika belum login
        }

        // Pastikan pengguna memiliki role admin
        if (Auth::user()->usertype != 'admin') {
            return redirect('/')->with('error', 'You do not have admin access.');
        }


        return $next($request);
    }
}
