<?php

namespace App\Http\Middleware;

use App\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BandManagerMiddleware
{
   
    public function handle(Request $request, Closure $next): Response
    {
        return Auth::user()->role === UserRole::BAND_MANAGER_ROLE->value ? $next($request) : redirect()->route('home');
    }
}
