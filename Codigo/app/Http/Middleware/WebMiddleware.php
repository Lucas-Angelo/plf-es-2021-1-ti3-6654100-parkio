<?php
namespace App\Http\Middleware;
use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Symfony\Component\HttpFoundation\Cookie;

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
            $decode = JWT::decode($token, env('JWTSECRET'), ['HS256']);
            $res = $next($request);
            return $res->withCookie(new Cookie('PARKIO_UIF', json_encode([
                't' => $decode->tip,
                'n' => $decode->nm
            ]), 0, '/', null, null, false));
        } catch(ExpiredException $e) {
            return redirect('/auth'); //Expired Token
        } catch(Exception $e) {
            return redirect('/auth'); //Invalid Token
        }
    }
}