<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VisitorCategoryService;
use Illuminate\Support\Facades\DB;

class VisitorCategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function create(Request $request){
        //validate essencials fields
        $this->validate($request, [
            'description' => 'required|max:45',
            'time' => 'required|numeric'
        ]);

        //calls the service and the function create passing datas
        $visitor = new visitorCategoryService();


        return response()->json(
            $visitor->create( $request->description, $request->time )
        );
    }

}
