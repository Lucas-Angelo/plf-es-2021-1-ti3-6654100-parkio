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
            'model' => 'nullable',
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
            return $v->getAll($request->input('plate'), $request->input('model'), $request->input('gate'), $request->input('user_in'), $request->input('inside'), $request->input('color'), $request->input('driver_name'), $request->input('in_time'), $request->input('out_time'), $request->auth->id, $request->auth->type);
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
            'cpf' => 'min:11|max:14',
            'plate' => 'required|min:7|max:8',
            'model' => 'min:1|max:80',
            'color' => 'max:45',
            'time' => 'required|numeric|min:1|max:65535',
            'categoryId' => 'required|exists:visitor_category,id',
            'destinationId' => 'required|exists:destination,id',
            'gateId' => 'required|exists:gate,id'
        ]);

        try {
            //calls the service and the function create passing datas
            $vehicle = new VehicleService();
            return response()->json(
                $vehicle->create($request->input('driverName'), $request->input('plate'), $request->input('time'),
                  $request->input('destinationId'), $request->input('categoryId'), $request->input('gateId'), $request->auth->id,
                  $request->input('color'), $request->input('model'), $request->input('cpf')
                 )
            );
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $this->treatCodeError($e));
        }



    }

    public function search(Request $request)
    {

      $this->validate($request, [
          'plate' => 'required|max:8'
      ]);

      $vehicle = new VehicleService();

      return response()->json(
          $vehicle->search($request->input('plate'))
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
            'plate' => 'nullable|min:7|max:8',
            'model' => 'max:80',
            'color' => '45',
            'gateId' => 'required_with:score|exists:gate,id',
            'score' => 'required_with:gateId|in:G,B'
        ]);

        try {
            $v = new VehicleService();
            return response()->json(
                $v->edit($id, $request->auth->id, $request->input('score'), $request->input('gateId'), $request->input('plate'), $request->input('model'), $request->input('color'))
            );
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $this->treatCodeError($e));
        }
    }
}
