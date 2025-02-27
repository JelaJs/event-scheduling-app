<?php

namespace App\Http\Middleware;

use App\UserRole;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestaurantManagerMiddleware
{
   
    public function handle(Request $request, Closure $next): Response
    {
        return Auth::user()->role === UserRole::RESTAURANT_MANAGER_ROLE->value ? $next($request) : redirect()->route('home');
    }
}
