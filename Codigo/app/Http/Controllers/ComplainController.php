<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\ComplainService;

class ComplainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Controller function that returns cs with pagination
     *
     * @param Request $request
     * @return void
     */
    public function getAll(Request $request){
        $cs = new ComplainService();
        return $cs->getAll();
    }

    /**
     * Controller function that creates a new cser
     * It also validates info that the cser has sent
     * For more rules, see: https://laravel.com/docs/7.x/validation#available-validation-rules
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request){
        $this->validate($request, [
            'plate' => 'required',
            'description' => 'required',
            'vehicleId' => 'required',
        ]);

        $cs = new ComplainService();      

        return response()->json(
            $cs->create($request->description, $request->plate,$request->vehicleId, $request->auth->id, $request->gateId)
        );
    }


    //
}
