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

    public function link(Request $request){
        $this->validate($request, [
            'block' => 'required',
            'userId' => 'required'
        ]);
        try {
            $mhd = new BlockManagerHasDestinationService();
            return $mhd->link($request->block, $request->userId);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $this->treatCodeError($e));
        }
    }

    public function unlink(Request $request){
        $this->validate($request, [
            'block' => 'required',
            'userId' => 'required'
        ]);
        try {
            $mhd = new BlockManagerHasDestinationService();
            return $mhd->unlink($request->block, $request->userId);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $this->treatCodeError($e));
        }
    }
}
