<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReportService;

class ReportController extends Controller
{
    public function getQtdVisitorByDate(Request $request){
        try {
            $r = new ReportService();
            return $r->getQtdVisitorByDate($request->dates); //pass initial date

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $this->treatCodeError($e));
        }
    }


    public function getQtdVehiclesByGateKeeper(Request $request){
        try {
            $r = new ReportService();
            return $r->getQtdVehiclesByGateKeeper($request->dates); //pass initial date
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $this->treatCodeError($e));
        }
    }

    //
}
