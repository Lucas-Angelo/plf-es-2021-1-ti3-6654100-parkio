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

}
