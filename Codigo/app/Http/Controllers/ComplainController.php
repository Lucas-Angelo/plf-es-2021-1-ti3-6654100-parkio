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
        $this->validate($request, [
            'plate' => 'nullable|max:8'
        ]);
        try {
            $cs = new ComplainService();
            return $cs->getAll($request->input('plate'));
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $this->treatCodeError($e));
        }
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
            'plate' => 'required|min:7|max:8',
            'description' => 'required|min:1|max:255',
            'vehicleId' => 'required',
        ]);

        $cs = new ComplainService();

        return response()->json(
            $cs->create($request->input('description'), $request->input('plate'),$request->input('vehicleId'), $request->auth->id, $request->input('gateId'))
        );
    }

    public function delete(Request $request, int $id){
        if(!empty($id)){

            try {
                $cs = new ComplainService();
                return response()->json(
                    $cs->delete($id)
                );
            } catch (\Exception $e) {
                return response()->json([
                    'error' => $e->getMessage()
                ], $this->treatCodeError($e));
            }

        }else return response()->json([
            'error' => 'missing id', 400
        ]);

    }



    //
}
