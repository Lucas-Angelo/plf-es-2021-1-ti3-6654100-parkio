<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GateService;

class GateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function getAll(){
        try {
            $v = new GateService();
            return $v->getAll();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $this->treatCodeError($e));
        }
    }

    //
}
