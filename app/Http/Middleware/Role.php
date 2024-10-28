<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $roles = is_array($role)
        ? $role
        : explode('|', $role);
        // dd($request->user());
        if($request->user()) {
            if(!in_array($request->user()->role, $roles)) {
                if($request->user()->role == 'customer') {
                    return redirect()->to(route('404'));
                }

                return redirect()->to(route('404admin'));
            }
        }
        return $next($request);
    }
}
