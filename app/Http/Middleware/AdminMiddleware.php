<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
   
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is not authenticated
        if (!Auth::check()) {  
            return redirect()->route('login');  
        }

        return $next($request);
    }
}
