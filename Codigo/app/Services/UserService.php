<?php

namespace App\Services;

use App\Models\User;
use App\Models\Vehicle;
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
     * @param String $type User type (A - Admin, S - Apartament/Block Manager, R - Ronda??, P - Doorman)
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
            'message' => 'Usuario criado com sucesso',
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
                "tip" => $user->type,
                "nm" => $user->name
            );
            $jwt = JWT::encode($payload, $key);
            return ['token' => $jwt];
        } else {
            throw new \Exception("User or pass incorrect", 405);
        }
    }

    public function search(String $login = null, String $type = null) {
        $data = new User();

        if(isset($type)) {
            $data = $data->where('type',$type);
        }
        if(isset($login)) {
            $data = $data->where('login',$login);
        }

        return $data->orderByDesc('created_at')->paginate();

    }

    public function delete(int $id) {

        $message = 'Usuário removido com sucesso';
        $deleted = true;

        try {
            $user = User::find($id);

            if( Vehicle::where('user_in_id', $id)->get()->count() > 0 || Vehicle::where('user_out_id', $id)->get()->count() > 0  ){
                $message = 'Remoção não concluída, esse usuário contém veículos.';
                $deleted = false;
            }
            else $user->delete();
        } catch (\Throwable $th) {
            $message = 'Remoção não concluída, esse usuário não existe.';
            $deleted = false;
        }

        return [
            'message' => $message,
            'deleted' => $deleted
        ];

    }
}
