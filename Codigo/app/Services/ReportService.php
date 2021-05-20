<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Models\Gate;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
    
    public function getVisitorByDate()
    {
        $list = new Vehicle();

        //$list = Vehicle::where()
        //if()
//        SELECT
  //      date(created_at),
      //  COUNT(id)
    // FROM vehicle
     //GROUP BY 1;

        $list->where('created_at','>=','2021-05-10 12-00');
        return $list
                    //->count('id')
                    ->with(['gate:id,description','userIn:id,name','userOut:id,name', 'destination'])
                    ->orderByDesc('created_at')
                    ->paginate();
                //->with(['gate:id,description','userIn:id,name','userOut:id,name', 'destination'])
                //->orderByDesc('created_at')
                //->paginate();

    }

}
