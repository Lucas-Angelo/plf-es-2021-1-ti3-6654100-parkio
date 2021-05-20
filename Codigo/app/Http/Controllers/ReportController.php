<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReportService;

class ReportController extends Controller
{
    public function getVisitorByDate(Request $request){
        try {
            $r = new ReportService();
            return $r->getVisitorByDate();

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $this->treatCodeError($e));
        }
    }


    public function getVehiclesByGateKeeper(Request $request){
        try {
            $r = new ReportService();
            return $r->getAll($request->search);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $this->treatCodeError($e));
        }
    }

    //
}
