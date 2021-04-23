<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Complain;


class ComplainService
{

    public function create($description, $plate, int $vehicleId, int $userId)
    {

        $c = new Complain();
        $c->description = strtoupper($description);
        $c->plate = strtoupper($plate);
        $c->vehicle_id =  $vehicleId;
        $c->user_id = $userId;
        $c->save();

        return [
            'message' => 'success',
            'created' => true
        ];
        
    }




}
