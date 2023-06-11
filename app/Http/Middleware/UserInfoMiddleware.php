<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserInfoMiddleware
{

    public function handle(Request $request, Closure $next)
    {


        $appData = app('user');

        $appData->userInfo = ['store'=>2];

        return $next($request);
    }
}
