<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BlockManagerHasDestinationService;

class BlockManagerHasDestinationController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getAll(Request $request){
        try {
            $mhd = new BlockManagerHasDestinationService();
            return $mhd->getAll($request->id);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $this->treatCodeError($e));
        }
    }
/*
    public function create(Request $request){
        //validate essencials fields
        $this->validate($request, [
            'block' => 'required|min:1|max:20',
            'apt' => 'required|min:1|max:20'
        ]);
        try {
        //calls the service and the function create passing datas
            $d = new BlockManagerHasDestinationService();
            return response()->json(
                $d->create($request->block, $request->apt)
            );
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $this->treatCodeError($e));
        }
    }

    public function update(Request $request, int $id)
    {
        if(!empty($id)){
            $this->validate($request, [
                'block' => 'required|min:1|max:20',
                'apt'   => 'required|min:1|max:20'
            ]);

            try {
                //calls the service and the function create passing datas
                    $d = new BlockManagerHasDestinationService();
                    return response()->json(
                        $d->update($id, $request->block, $request->apt)
                    );
            }
            catch (\Exception $e) {
                    return response()->json([
                        'error' => $e->getMessage()
                    ], $this->treatCodeError($e));
            }

        }else{
            return response()->json(['error' => 'missing id' ]);
        }
    }

    public function delete(Request $request, int $id){
        if(!empty($id)){
            try {
                $d = new BlockManagerHasDestinationService();
                return response()->json(
                    $d->delete($id)
                );
            } catch (\Exception $e) {
                return response()->json([
                    'error' => $e->getMessage()
                ], $this->treatCodeError($e));
            }

        }else return response()->json([
            'error' => 'missing id'
        ]);

    }*/
}
