<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {

        $language = $request->headers->get('language')=='en' || $request->headers->get('language')=='bn' ? $request->headers->get('language') :'en';

        $appData = app('permission');

        // Set permission if necessary , this permission will be accessible to everywhere
        //
        $appData->permissions = [
            'language' => $language,
            'store'=>1
        ];

        $user['role'] = $request->header('role') ?? 'user';


        if (!$user || !$this->userHasRole($user, $role)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
    private function userHasRole($user, $role)
    {
        // Implement your own logic to check if the user has the required role
        // You can use a different data source or approach to retrieve and check roles

        // Example: Assuming the user has a 'role' attribute in the user model
        return $user['role'] === $role;
    }
}
