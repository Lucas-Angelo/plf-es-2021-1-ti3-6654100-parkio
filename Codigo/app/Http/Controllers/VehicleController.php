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
        $this->validate($request, [
            'plate' => 'nullable|max:8',
            'gate' => 'nullable|exists:gate,id',
            'user_in' => 'nullable',
            'inside' => 'nullable',
            'color' => 'nullable|max:8',
            'driver_name' => 'nullable|max:255',
            'in_time' => 'nullable|date_format:Y-m-d',
            'out_time' => 'nullable|date_format:Y-m-d',
        ]);

        try {
            $v = new VehicleService();
            return $v->getAll($request->plate, $request->gate, $request->user_in, $request->inside, $request->color, $request->driver_name, $request->in_time, $request->out_time);
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
            'plate' => 'required|min:7|max:8',
            'time' => 'required|numeric',
            'categoryId' => 'required|exists:visitor_category,id',
            'destinationId' => 'required|exists:destination,id',
            'gateId' => 'required|exists:gate,id'

        ]);

        //calls the service and the function create passing datas
        $vehicle = new VehicleService();


        return response()->json(
            $vehicle->create($request->driverName, $request->plate, $request->time,
              $request->destinationId, $request->categoryId, $request->gateId, $request->auth->id,
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


    public function get(Request $request, int $id)
    {
  
      $vehicle = new VehicleService();

      return response()->json(
          $vehicle->get($id)
      );
    }

    public function edit(Request $request, int $id){
        $this->validate($request, [
            'plate' => 'nullable|max:8',
            'gateId' => 'required_with:score|exists:gate,id',
            'score' => 'required_with:gateId|in:G,B'
        ]);

        try {
            $v = new VehicleService();
            return response()->json(
                $v->edit($id, $request->auth->id, $request->score, $request->gateId, $request->plate, $request->model, $request->color)
            );
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $this->treatCodeError($e));
        }
    }
}
