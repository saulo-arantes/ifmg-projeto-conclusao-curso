<?php

namespace App\Http\Middleware;

use App\Entities\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Doctor {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 *
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		if (Auth::user()->level == User::DOCTOR) {
			return $next($request);
		}

		return redirect('home');
	}
}
