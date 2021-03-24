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

    public function getAll(Request $request){
        try {
            $v = new VehicleService();
            return $v->getAll();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $this->treatCodeError($e));
        }
    }

    public function create(Request $request){
        //validate essencials fields
        $this->validate($request, [
            'driverName' => 'required|max:255',
            'plate' => 'required|max:8',
            'time' => 'required|numeric',
            'categoryId' => 'required|exists:visitor_category,id',
            'destinationId' => 'required|exists:destination,id',
            'gateId' => 'required|exists:gate,id'

        ]);

        //calls the service and the function create passing datas
        $vehicle = new VehicleService();


        return response()->json(
            $vehicle->create($request->driverName, $request->plate, $request->time,
              $request->destinationId, $request->categoryId, $request->gateId,
              $request->color, $request->model, $request->cpf
             )
        );
    }

    public function search(Request $request)
    {

      $this->validate($request, [
          'plate' => 'required|max:8'
      ]);

      $vehicle = new VehicleService();

      return response()->json(
          $vehicle->search($request->plate)
      );
    }

    //
}
