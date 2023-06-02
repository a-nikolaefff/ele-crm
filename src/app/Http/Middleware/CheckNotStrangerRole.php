<?php

namespace App\Http\Middleware;

use App\Enums\UserRoleEnum;
use App\Models\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckNotStrangerRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->hasRole(UserRoleEnum::Stranger)) {
            return redirect('/home');
        }
        return $next($request);
    }
}
