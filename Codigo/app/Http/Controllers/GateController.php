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
        $g = new GateService();


        return response()->json(
            $g->create($request->description)
        );
    }

    public function delete(Request $request, int $id){
        if(!empty($id)){

            try {
                $g = new GateService();
                return response()->json(
                    $g->delete($id)
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
        if(!empty($id)){

            try {
                $g = new GateService();
                //dd($g->edit($id));
                return response()->json($g->edit($id));
                
            } catch (\Exception $e) {
                return response()->json([
                    'error' => $e->getMessage()
                ], $this->treatCodeError($e));
            }

        }else return response()->json([
            'error' => 'missing id'
        ]);

    }

}
