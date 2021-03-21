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

    public function test(Request $request){
        $us = new UserService();
        return $us->getAll();
    }

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

    //
}
