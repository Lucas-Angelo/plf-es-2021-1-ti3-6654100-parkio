<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Controller function that returns users with pagination
     *
     * @param Request $request
     * @return void
     */
    public function getAll(Request $request){
        $us = new UserService();
        return $us->getAll();
    }

    /**
     * Controller function that creates a new user
     * It also validates info that the user has sent
     * For more rules, see: https://laravel.com/docs/7.x/validation#available-validation-rules
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'login' => 'required|unique:user',
            'password' => 'required',
            'type' => 'required|in:A,M,R,D'
        ]);

        $us = new UserService();

        return response()->json(
            $us->create($request->name, $request->login,$request->password, $request->type)
        );
    }

    public function search(Request $request) {
        $us = new UserService();
        return $us->search($request->type);
    }

    //
}
