<?php


namespace App\Services;

use App\Models\Delay;
use App\Models\Vehicle;
use App\Models\User;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class DelayService {

    public function create($description, $time, int $vehicleId, int $userId, int $gateId) {
        $v = Vehicle::find($vehicleId);

        if($gateId != $v->gate_id) { // Cars can't leave on different gates
            throw new \Exception("O tempo de permanência deste veículo não pode ser alterado através deste portão!", 403);
        }
        else if(!empty($v->left_at)) { // Cars can't leave if they already left
            throw new \Exception("O veículo já saiu", 409);
        }
        else {
            $user = User::find($userId);
            if($user->type == 'A' || $user->type == 'R') {
                $v->time = $time;
                $v->save();

                $d = new Delay();
                $d->description = strtoupper($description);
                $d->time = $v->time + $time;
                $d->vehicle_id =  $vehicleId;
                $d->user_id = $userId;
                $d->save();

                return [
                    'message' => "Tempo de permanência do veículo alterado com sucesso",
                    'created' => true
                ];
            }
            else {
                throw new \Exception("Somente administradores e porteiros podem alterar o tempo de um veículo!", 401);
            }

        }

    }

    public function getAll() {
        $d = new Delay();
        return $d
            ->orderByDesc('created_at')
            ->paginate();
    }

}
