<?php

namespace App\Http\Middleware;

use App\Entities\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->level == User::ADMIN) {
            return $next($request);
        }

        return redirect('home');
    }
}
