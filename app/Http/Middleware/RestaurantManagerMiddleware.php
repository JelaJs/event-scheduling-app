<?php

namespace App\Http\Middleware;

use App\Models\User;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestaurantManagerMiddleware
{
   
    public function handle(Request $request, Closure $next): Response
    {
        return Auth::user()->role === User::RESTAURANT_MANAGER_ROLE ? $next($request) : redirect()->route('home');
    }
}
