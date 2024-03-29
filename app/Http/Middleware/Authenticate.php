<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if( in_array("auth:admin", $request->route()->computedMiddleware) ){
            return route('admin.login');
        }
        if( in_array("auth:faculty", $request->route()->computedMiddleware) ){
            return route('faculty.login');
        }
        if( in_array("auth:user", $request->route()->computedMiddleware) ){
            return route('student.login');
        }
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
