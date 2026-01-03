<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class BelumLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Session::has('user.id')) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
