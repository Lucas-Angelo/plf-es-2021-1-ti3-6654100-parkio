<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Models\Gate;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;

class ReportService
{
    /**
     * Returns Gate list (with pagination)
     *
     * @return Collection
     */    
    public function getAll(){
        return Gate::all();
    }
    
    public function getQtdVisitorByDate($date)
    {
        $list = new Vehicle();
        $arrayday = array();
        $arrayhour = array();
        //dd(strtotime("+7 day", strtotime($date)));
        //dd(date("Y-m-d", strtotime("+7 day", strtotime($date) )));

        $begin = new DateTime( $date );
        $end   = new DateTime( date("Y-m-d", strtotime("+7 day", strtotime($date))) );
        
        for($i = $begin; $i < $end; $i->modify('+1 day')){

                $x = 0;
                $vehicles = new Vehicle();
                $arrayhour = [];
                for($x = 0; $x < 8 ; $x++){
                    $vehicles = Vehicle::
                              whereRaw('date(created_at) = ?', $i->format("Y-m-d"))
                            ->whereRaw('hour(created_at) >= ?', $x)
                            ->whereRaw('hour(created_at) <= ?', $x+3)
                            ->count('id');

                    array_push($arrayhour, $vehicles);
            }

            array_push($arrayday,  $arrayhour);

         }

        return $arrayday;

    }


    public function getQtdVehiclesByGateKeeper($date)
    {
        $list = new Vehicle();
        $arrayday = array();
        $arrayhour = array();
        //dd(strtotime("+7 day", strtotime($date)));
        //dd(date("Y-m-d", strtotime("+7 day", strtotime($date) )));

        $begin = new DateTime( $date );
        $end   = new DateTime( date("Y-m-d", strtotime("+7 day", strtotime($date))) );
        
        for($i = $begin; $i < $end; $i->modify('+1 day')){
//             select count(id), user_in_id as g
// from vehicle v 
// group by 2
                    $gateKeeper = Vehicle::
                              Select(DB::raw("count(id), user_in_id "))
                            ->whereRaw('date(created_at) = ?', $i->format("Y-m-d"))
                            ->groupBy('user_in_id')
                            ->get()
                            ->toArray();
            
                    dd($gateKeeper);
            array_push($arrayday,  $gateKeeper);

         }

        return $arrayday;

    }


}
