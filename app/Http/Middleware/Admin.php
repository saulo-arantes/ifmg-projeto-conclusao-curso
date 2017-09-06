<?php

namespace App\Http\Middleware;

use App\Entities\Notification;
use App\Entities\User;
use Closure;

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
        if (User::isAdmin()) {
	        Notification::updateBadges();

            return $next($request);
        }

        return redirect('home');
    }
}
