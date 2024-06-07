<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $requiredType)
{
    if (auth()->check() && auth()->user()->usertype != $requiredType) {
        return redirect('/')->with('error', 'You do not have access to this section.');
    }
    return $next($request);
}

}
