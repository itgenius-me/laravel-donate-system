<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Activate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->activated) {
            auth()->logout();
        
            return redirect('/login')
                ->withErrors([
                    'email' => trans('global.Message.activated')
                ]);
        }

        return $next($request);
    }
}
