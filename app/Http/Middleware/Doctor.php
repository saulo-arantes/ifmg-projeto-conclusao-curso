<?php

namespace App\Http\Middleware;

use App\Entities\User;
use Closure;

class Doctor
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
        if (User::isDoctor()) {
            return $next($request);
        }

        return redirect('home');
    }
}
