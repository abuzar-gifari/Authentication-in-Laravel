<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role==1) {
            return $next($request);
        }
        return redirect()->route('home');      
    }
}
