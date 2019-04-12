<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class CheckForAdminRights
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
        $token = Cookie::get('token');
        $discordId = '';

        if ($token != null && in_array($discordId, config('admins.ids')))
        {
            return $next($request);
        }

        return abort(403);
    }
}
