<?php

namespace App\Services;

use App\Models\Gate;
use App\Models\Vehicle;

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
        $message = 'Portaria criada com sucesso';
        $gate = new Gate();
        $gate->description = strtoupper($description);
        $gate->save();
        return [
            'message' => $message,
            'created' => true
        ];
    }

    public function delete(int $id)
    {
        $message = 'Portaria removida com sucesso';
        $deleted = true;
        $gate = $this->search($id);

        if(empty($category)){
            $message = "Portaria não encontrada";
            $deleted = false;
        } else {
            $gate->delete();
        }

        return [
            'message' => $message,
            'deleted' => $deleted
        ];
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
        $message = 'Portaria editada com sucesso';

        $gate = $this->search($id);

        $gate->description = strtoupper($description);
        $gate->update();
        return [
            'message' => $message,
            'updated' => true
        ];


    }
}
