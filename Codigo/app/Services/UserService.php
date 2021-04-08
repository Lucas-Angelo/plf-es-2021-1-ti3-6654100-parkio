<?php

namespace App\Services;

use App\Models\User;

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
     * @return void
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

    public function search(String $type = null) {
        $data = new User();

        if(isset($type)) {
            $data = $data->where('type',$type);
        }

        if(isset($type)) {
            $data = $data->where('type',$type);
        }

        return $data->orderByDesc('created_at')->paginate();

    }
}
