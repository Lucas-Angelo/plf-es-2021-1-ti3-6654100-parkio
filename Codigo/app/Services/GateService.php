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
        return Gate::all();
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

    public function delete(int $id)
    {
        $gate = Gate::find($id);

        if(!empty($gate)){

            $gate->delete();

            return [
                'message' => 'success',
                'deleted' => true
            ];

        }else {
            throw new \Exception("Gate Not Found", 404);
        }

    }

    public function search(int $id)
    {
        $gate = Gate::find($id);

        if(!empty($gate)){

            return $gate;

        }else {
            throw new \Exception("Gate Not Found", 404);
        }

    }

    public function update(int $id, String $description){
        $gate = Gate::find($id);

        if(!empty($gate)){

            $gate->description = strtoupper($description);
            $gate->update();
            return [
                'message' => 'success',
                'updated' => true
            ];
        
        }else {
            throw new \Exception("Gate Not Found", 404);
        }

    }
}
