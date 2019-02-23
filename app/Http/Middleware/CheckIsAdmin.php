<?php
namespace Solsticio\Http\Middleware;
use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Solsticio\User;
class CheckIsAdmin
{
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->isAdmin() == 'ADMIN') {
            return $next($request);
        }
        else {
            return response()->json(['error' => 'Unauthorized', 'request' => $request, 'next' => $next], 403);
        }
    }
}