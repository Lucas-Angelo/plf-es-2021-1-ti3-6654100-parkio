<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\DelayService;

class DelayController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }

    /**
     * Controller function that returns ds with pagination
     *
     * @param Request $request
     * @return void
     */
    public function getAll() {
        $ds = new DelayService();
        return $ds->getAll();
    }

    /**
     * Controller function that creates a new dser
     * It also validates info that the dser has sent
     * For more rules, see: https://laravel.com/docs/7.x/validation#available-validation-rules
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request) {
        $this->validate($request, [
            'description' => 'required|min:1|max:65535',
            'time' => 'required|min:1|max:65535',
            'vehicleId' => 'required|exists:vehicle,id',
        ]);

        $ds = new DelayService();

        return response()->json(
            $ds->create($request->input('description'), $request->input('time'), $request->input('vehicleId'), $request->auth->id, $request->input('gateId'))
        );
    }


    //
}
