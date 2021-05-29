<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReportService;

class ReportController extends Controller
{
    public function getQtdVisitorByDate(Request $request){

        $this->validate($request, [
            'dates' => 'required|max:12',
        ]);

        try {
            $r = new ReportService();
            return $r->getQtdVisitorByDate($request->dates, $request->gate, $request->doorMen); //pass initial date

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $this->treatCodeError($e));
        }
    }


    public function getQtdVehiclesByGateKeeper(Request $request){

        $this->validate($request, [
            'dates' => 'required|max:12',
        ]);

        try {
            $r = new ReportService();
            return $r->getQtdVehiclesByGateKeeper($request->dates, $request->gate, $request->doorMen); //pass initial date
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $this->treatCodeError($e));
        }
    }

    //
}
