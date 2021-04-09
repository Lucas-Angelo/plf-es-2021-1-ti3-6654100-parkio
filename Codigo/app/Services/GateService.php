<?php

namespace App\Services;

use App\Models\Gate;

class GateService
{
    /**
     * Returns Gate list (with pagination)
     *
     * @return void
     */
    
    public function getAll(){
        return Gate::paginate();
    }

    /**
     * Creates a new Gate
     */
    public function create(String $description){
        $gate = new Gate();
        $gate->description = strtoupper($description);
        $gate->save();
        return [
            'message' => 'success',
            'created' => true
        ];
    }
}
