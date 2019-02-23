<?php
namespace Solsticio\Http\Middleware;
use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Solsticio\User;
use JWTAuth;
class CheckIsAdmin
{
    public function handle($request, Closure $next)
    {
        $token = JWTAuth::getToken();
        if(Auth::check() && Auth::user()->isAdmin() == 'ADMIN') {
            return $next($request);
        }
        else {
            return response()->json(['error' => 'Unauthorized', 'request' => $token, 'next' => $next], 403);
        }
    }
}