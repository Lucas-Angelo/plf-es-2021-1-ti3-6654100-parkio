<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GateService;

class GateController extends Controller{
  
    public function getAll(Request $request){
        try {
            $v = new GateService();
            return $v->getAll();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $this->treatCodeError($e));
        }
    }

    public function create(Request $request){
        //validate essencials fields
        $this->validate($request, [
            'description' => 'required|max:255',
        ]);

        //calls the service and the function create passing datas
        $vehicle = new GateService();


        return response()->json(
            $vehicle->create($request->description)
        );
    }

}
