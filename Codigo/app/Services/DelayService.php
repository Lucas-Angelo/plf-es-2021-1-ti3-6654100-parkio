<?php

namespace App\Services;

use App\Models\Delay;
use App\Models\Vehicle;
use App\Models\User;


class DelayService {

    public function create($description, $time, int $vehicleId, int $userId, int $gateId) {
        $message = "Tempo de permanência do veículo alterado com sucesso";
        $created = false;
        $v = Vehicle::find($vehicleId);

        if(!empty($v)) {

                if($gateId != $v->gate_id) { // Cars can't leave on different gates
                    $message = "O tempo de permanência deste veículo não pode ser alterado através deste portão";
                }
                else if(!empty($v->left_at)) { // Cars can't leave if they already left
                    $message = "Veículo já saiu";
                }
                else {
                    $user = User::find($userId);
                    if($user->type == 'A' || $user->type == 'R'){
                        $v->time = $time;
                        $v->updated_at = date("Y-m-d H:i:s");
                        $v->save();

                        $d = new Delay();
                        $d->description = strtoupper($description);
                        $d->time = strtoupper($time);
                        $d->vehicle_id =  $vehicleId;
                        $d->user_id = $userId;
                        $d->save();

                        $created = true;
                    }
                    else {
                        throw new \Exception("Forbidden!", 403);
                    }

                }

        }
        else {
            $message = "Veiculo não encontrado";
        }

        return [
            'message' => $message,
            'created' => $created
        ];
    }

    public function getAll() {
        $d = new Delay();
        return $d
            ->orderByDesc('created_at')
            ->paginate();
    }

}
