<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            return redirect(route('home'));
        }
        if (auth()->user()->page_added == 0) {
            return redirect(route('shop.list.view.approval'));
        }
        if (auth()->user()->profile_completed == 0) {
            return redirect(route('clients.profile'));
        }
        if (auth()->user()->profile_completed == 1) {
            return redirect(route('clients.profile'));
        }
        return $next($request);
    }
}
