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
    
    public function getQtdVisitorByDate($date, $gate = null, $doorMen = null)
    {
        $list = new Vehicle();
        $arrayday = array();
        $arrayhour = array();
        //dd(strtotime("+7 day", strtotime($date)));
        //dd(date("Y-m-d", strtotime("+7 day", strtotime($date) )));
        $vehicles = new Vehicle();
        $begin = new DateTime( $date );
        $end   = new DateTime( date("Y-m-d", strtotime("+7 day", strtotime($date))) );
        
        for($i = $begin; $i < $end; $i->modify('+1 day')){
               
                $arrayhour = [];
                for($x = 0; $x < 24 ; $x+=3){
                    
                    $vehicles = Vehicle::
                              whereRaw('date(created_at) = ?', $i->format("Y-m-d"))
                            ->whereRaw('hour(created_at) >= ?', $x)
                            ->whereRaw('hour(created_at) <= ?', $x+3);
                            
                    if(!empty($gate)){
                        $vehicles = $vehicles->where('gate_id', $gate);          
                    }    
                    
                    if(!empty($doorMen)){
                        $vehicles = $vehicles->where('user_in_id', $doorMen);          
                    }    

                    array_push($arrayhour, $vehicles->count('id'));
                }

            array_push($arrayday,  $arrayhour);

         }

        return $arrayday;

    }


    public function getQtdVehiclesByGateKeeper($date, $gate = null, $doorMen = null)
    {
        $list = new Vehicle();
        $arrayday = array();
        $arrayhour = array();

        $begin = new DateTime( $date );
        $end   = new DateTime( date("Y-m-d", strtotime("+7 day", strtotime($date))) );
        
        for($i = $begin; $i < $end; $i->modify('+1 day')){

                    $gateKeeper = Vehicle::
                              Select(DB::raw("count(vehicle.id), user_in_id, name"))
                              ->join('user', 'user.id', '=', 'user_in_id')
                            ->whereRaw('date(vehicle.created_at) = ?', $i->format("Y-m-d"))
                            ->groupBy('user_in_id', 'name');
                    if(!empty($gate)){
                        $gateKeeper = $gateKeeper->where('gate_id', $gate);
                    }
                    if(!empty($doorMen)){
                        $gateKeeper = $gateKeeper->where('user_in_id', $doorMen);
                    }
            
            array_push($arrayday,  $gateKeeper->get()->toArray());

         }

        return $arrayday;

    }


}
