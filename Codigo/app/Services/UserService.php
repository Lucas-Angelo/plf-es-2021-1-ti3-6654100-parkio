<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public $model;

    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * Returns user list (with pagination)
     *
     * @return void
     */
    public function getAll(){
        return $this->model->paginate();
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
        $u = $this->model;
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

    public function search($parameters) {
        $data = $this->model;

        if(isset($parameters['name']) && !is_null($parameters['name'])) {
            $name = $parameters['name'];
            $data = $data->where('name', 'like', "%$name%");
        }

        if(isset($parameters['type']) && !is_null($parameters['type'])) {
            $data = $data->where('type',$parameters['type']);
        }

        return $data
            ->orderByDesc('created_at')
            ->paginate();

    }
}
