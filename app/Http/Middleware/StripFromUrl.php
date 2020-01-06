<?php

namespace App\Http\Middleware;

use Closure;

class StripFromUrl
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
        if ($request->has('param')) {
            $param = $request->query('param');
            $request->query->remove('param');

            return redirect()->to(url()->current())
                ->with('param', $param);
        }

        return $next($request);
    }
}
