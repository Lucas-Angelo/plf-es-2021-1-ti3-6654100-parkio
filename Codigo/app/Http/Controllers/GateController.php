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
            'description' => 'required|min:1|max:45',
        ]);

        //calls the service and the function create passing datas
        $g = new GateService();


        return response()->json(
            $g->create($request->input('description'))
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

    public function search(Request $request, int $id){
        if(!empty($id)){

            try {
                $g = new GateService();
                return response()->json($g->search($id));

            } catch (\Exception $e) {
                return response()->json([
                    'error' => $e->getMessage()
                ], $this->treatCodeError($e));
            }

        }else return response()->json([
            'error' => 'missing id'
        ]);

    }

        public function update(Request $request){
        //validate essencials fields
        $this->validate($request, [
            'id' => 'required',
            'description' => 'required|min:1|max:45'
        ]);

        //calls the service and the function create passing datas
        $g = new GateService();

        return response()->json(
            $g->update($request->input('id'), $request->input('description'))
        );
    }

}
