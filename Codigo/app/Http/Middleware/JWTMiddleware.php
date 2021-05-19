<?php
namespace App\Http\Middleware;
use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use App\Models\User;

class JWTMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->bearerToken();
        if(!$token) {
            // Unauthorized response if token not there
            return response()->json([
                'error' => 'Missing Token'
            ], 401);
        }
        try {
            $credentials = JWT::decode($token, env('JWTSECRET'), ['HS256']);
            $user = User::where('id',$credentials->uid)->first(['id','login','name','type']);
            if(empty($user)) {
                return response()->json([
                    'error' => 'Invalid Token'
                ], 401);
            }
            // Now let's put the user in the request class so that you can grab it from there
            $request->auth = $user;
            $request->request->add(['auth' => $user]);
            if(in_array($user->type, $request->route()[1]['auth'])) {
                return $next($request);
            } else {
                return response()->json([
                    'error' => 'Unauthorized'
                ], 401);
            }
            
        } catch(ExpiredException $e) {
            return response()->json([
                'error' => 'Expired Token'
            ], 401);
            //redirect('/auth'); //Expired Token
        } catch(Exception $e) {
            return response()->json([
                'error' => 'Invalid Token'
            ], 401);
        }
    }
}