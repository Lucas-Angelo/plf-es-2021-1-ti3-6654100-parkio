<?php
namespace App\Http\Middleware;
use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class WebMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->cookie('X-token');
        
        if(!$token) {
            // Unauthorized response if token not there
            return redirect('/auth');
        }
        try {
            JWT::decode($token, env('JWTSECRET'), ['HS256']);
            return $next($request);
        } catch(ExpiredException $e) {
            return redirect('/auth'); //Expired Token
        } catch(Exception $e) {
            return redirect('/auth'); //Invalid Token
        }
    }
}