<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestaurantManagerMiddleware
{
   
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::user()->role === 'restaurant_manager') {

            return $next($request);
        }

        return redirect()->route('home');
    }
}
