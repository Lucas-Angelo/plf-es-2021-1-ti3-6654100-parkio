<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DestinationService;

class DestinationController extends Controller
{
    public function getAll(Request $request){
        try {
            $v = new DestinationService();
            return $v->getAll($request->search);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $this->treatCodeError($e));
        }
    }

    //
}
