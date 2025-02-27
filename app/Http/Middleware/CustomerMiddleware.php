<?php

namespace App\Http\Middleware;

use App\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    
    public function handle(Request $request, Closure $next): Response
    {
        return Auth::user()->role === UserRole::CUSTOMER_ROLE->value ? $next($request) : redirect()->route('home');
    }
}
