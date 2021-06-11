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
            'name' => 'required|max:255',
            'login' => 'required|unique:user|max:40',
            'password' => 'required',
            'type' => 'required|in:A,S,R,P'
        ]);

        $us = new UserService();

        return response()->json(
            $us->create($request->input('name'), $request->input('login'),$request->input('password'), $request->input('type'))
        );
    }

    public function auth(Request $request) {
        $this->validate($request, [
            'login' => 'required',
            'password' => 'required',
        ]);

        $us = new UserService();

        return response()->json(
            $us->auth($request->input('login'),$request->input('password'))
        );
    }

    public function search(Request $request) {
        $us = new UserService();
        return $us->search($request->input('login'), $request->input('type'));
    }

    public function delete(Request $request, int $id) {

        if(!empty($id)){

            try {
                $u = new UserService();
                return response()->json(
                    $u->delete($id)
                );
            } catch (\Exception $e) {
                return response()->json([
                    'error' => $e->getMessage()
                ], $this->treatCodeError($e));
            }

        }else return response()->json([
            'error' => 'missing id'
        ]);

    }

    public function edit(Request $request, int $id){
        $this->validate($request, [
            'password' => 'required'
        ]);

        try {
            $u = new UserService();
            return response()->json(
                $u->edit($id, $request->input('password'))
            );
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $this->treatCodeError($e));
        }
    }
}
