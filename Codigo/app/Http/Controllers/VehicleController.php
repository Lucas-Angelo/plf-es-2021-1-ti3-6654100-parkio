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
        ]);

        try {
            $v = new VehicleService();
            return $v->getAll($request->plate);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $this->treatCodeError($e));
        }
    }
    public function getAllInside(Request $request){
        try {
            $v = new VehicleService();
            return $v->getAllInside();
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

    public function edit(Request $request, int $id){
        $this->validate($request, [
            'plate' => 'nullable|max:8',
            'gateId' => 'required_with:score|exists:gate,id',
            'score' => 'required_with:gateId|in:G,B'
        ]);

        try {
            $v = new VehicleService();
            return response()->json(
                $v->edit($id, $request->score, $request->gateId, $request->plate, $request->model, $request->color)
            );
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $this->treatCodeError($e));
        }
    }
}
