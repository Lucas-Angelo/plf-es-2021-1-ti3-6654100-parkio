<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Firebase\JWT\JWT;

class UserService
{
    /**
     * Returns user list (with pagination)
     *
     * @return void
     */
    public function getAll(){
        return User::paginate();
    }

    /**
     * Creates a new User
     *
     * @param String $name User name
     * @param String $login User nickname
     * @param String $password User Password
     * @param String $type User type (A - Admin, M - Apartament/Block Manager, R - Ronda??, D - Doorman)
     * @return array
     */
    public function create(String $name, String $login, String $password, String $type){
        $u = new User();
        $u->name = $name;
        $u->login = $login;
        $u->password = md5($password);
        $u->type = $type;
        $u->save();
        return [
            'message' => 'success',
            'created' => true
        ];
    }

    public function auth($login, $password){
        $user = User::where('login',$login)->where('password', DB::raw("MD5('".$password."')"))->first();
        if(!empty($user)) {
            $key = env('JWTSECRET');
            $payload = array(
                "iss" => env("APP_URL"),
                "aud" => env("APP_URL"),
                "iat" => time(),
                "nbf" => time(),
                "exp" => time() + 86400, //(60*60*24) - 1 day
                "uid" => $user->id,
                "tip" => $user->type
            );
            $jwt = JWT::encode($payload, $key);
            return ['token' => $jwt];
        } else {
            throw new \Exception("User or pass incorrect", 405);
        }
    }
}
