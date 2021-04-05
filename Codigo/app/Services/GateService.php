<?php

namespace App\Services;

use App\Models\Gate;

class GateService
{

    public $model;

    public function __construct() {
        $this->model = new Gate();
    }

    /**
     * Returns Gate list (with pagination)
     *
     * @return void
     */
    
    public function getAll(){
        return $this->model
            ->orderByDesc('created_at')
            ->paginate();
    }

}
