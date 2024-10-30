<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class EnsureUserRoleIsAllowedToAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $userRole = auth()->user()->role;
            $currentRouteName = Route::currentRouteName();
            if (in_array($currentRouteName, $this->userAccessRole()[$userRole])) {
                return $next($request);
            } else {
                return abort(403, 'Action non autorisé');
            }
        } catch (\Throwable $th) {
            return abort(403, 'Action non autorisé');
        }
        
    }



    public function userAccessRole()
    {
        return [
            'user' => [
                'dashboard',
                'guide'
            ],
            'admin' => [
                'adminDash',
                'dashboard',
                'guide'

            ],
            'orange' => [
                'networkDash',
                'dashboard',
                'guide'
            ],
            'moov' => [
                'networkDash',
                'dashboard',
                'guide'
            ],
            'mtn' => [
                'networkDash',
                'dashboard',
                'guide'
            ]
        ];
    }
}
