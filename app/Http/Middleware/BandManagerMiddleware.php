<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BandManagerMiddleware
{
   
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::user()->role === 'band_manager') {

            return $next($request);
        }

        return redirect()->route('home');
    }
}
