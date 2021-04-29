<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TaskMiddleware
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
        $userID = $request->route('user');
        if ($userID == Auth::id()) {
            // before middleware
            return $next($request);

            // after middleware
//            $response = $next($request);
//            // do something
//            return $response;
        }
        return abort(Response::HTTP_FORBIDDEN);
    }
}
