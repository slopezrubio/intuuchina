<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth as Auth;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->isUser($request)) {
            if (Auth::guest()) {
                return redirect('home');
            } else if(Auth::user()->type === 'admin') {
                return redirect('admin');
            }
        }

        return $next($request);
    }

    private function isUser($request) {
        if (!Auth::guest()) {
            if ($request->user()) {
                return $request->user()->type === 'user' ? true : false;
            }
        }
    }
}
