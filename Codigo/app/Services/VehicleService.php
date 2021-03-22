<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\DestinationService;
use App\Services\VisitorCategoryService;
use App\Models\Vehicle;




class VehicleService
{
    //
    public function getAll(){
        return Vehicle::paginate();
    }

    public function create($driverName, $plate,int $time,int $destinationId,int $visitorCategoryId,
    int $gateId, $color=null, $model=null, $cpf=null  ){

        $vehicle = new Vehicle();

        $vehicle->driver_name = strtoupper($driverName);
        $vehicle->plate = trim(strtoupper($plate));
        $vehicle->time = $time;
        $vehicle->destination_id = $destinationId;
        $vehicle->visitor_category_id = $visitorCategoryId;
        $vehicle->gate_id = $gateId;
        $vehicle->user_in_id = 1; //While don't have session check in our app
        $vehicle->color = (!empty($color)) ? $color : null;
        $vehicle->model = (!empty($model)) ? $model : null;
        $vehicle->cpf = (!empty($cpf)) ? preg_replace('/[^0-9]/', '', $cpf) : null;
        $vehicle->save();

        return [
            'message' => 'success',
            'created' => true
        ];
    }

    public function search($plate)
    {

      $filtro = strtoupper($plate);
      $vehicle =Vehicle::where('plate','like', "%".$filtro."%")
                     ->first(['plate','model','color']);

      return ['message'=> 'sucess', 'items'=>$vehicle] ;
    }




}
