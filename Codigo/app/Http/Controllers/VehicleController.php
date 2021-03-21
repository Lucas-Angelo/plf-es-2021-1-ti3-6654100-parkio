<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VehicleService;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function test(Request $request){
        $v = new VehicleService();
        $v->getAll();
    }

    public function create(Request $request){
        //validate essencials fields
        $this->validate($request, [
            'driverName' => 'required|max:255',
            'plate' => 'required|max:8',
            'time' => 'required|numeric',
            'block' => 'required',
            'apartament' => 'required|numeric',
            'category' => 'required',
            'gateId' => 'required|numeric'

        ]);

        //calls the service and the function create passing datas
        $vehicle = new VehicleService();

        return response()->json(
            $vehicle->create($request->driverName, $request->plate, $request->time,
              $request->block, $request->apartament,$request->category, $request->gateId,
              $request->color, $request->score, $request->model,$request->cpf
             )
        );
    }

    public function scearch(Request $request)
    {

      $vehicle = new VehicleService();

      return response()->json(
          $vehicle->scearch($request->plate)
      );
    }

    //
}
