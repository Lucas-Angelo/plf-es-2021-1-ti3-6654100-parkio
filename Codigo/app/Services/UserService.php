<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    //
    public function getAll(){
        return User::paginate();
    }

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
}
