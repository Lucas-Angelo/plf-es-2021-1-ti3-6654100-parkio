<?php

namespace App\Services;

use App\Models\BlockManagerHasDestination;
use Illuminate\Support\Facades\DB;


class BlockManagerHasDestinationService
{

  public function getAll($userId){
    /*
select distinct block from block_manager_has_destination md
join destination d on md.destination_id = d.id
where md.user_id = 13*/    
    $mhd = BlockManagerHasDestination::select(DB::raw("distinct block"))
    ->join('destination', 'destination_id','id')
    ->where('user_id',$userId)
    ->first()
    ->distinct('block');
    return $mhd;
  }

  /*public function link($block, $apartament){
    $destination = new Destination();
    $destination->block = strtoupper($block);
    $destination->apartament = $apartament;
    $destination->deleted_at = null;
    $destination->save();

    return ['id'=>$destination->id];
  }

  public function unlink(int $id, $block, $apartament){
    $message = 'Destino editado com sucesso';

    $destination = $this->search($id);

    $destination->block = strtoupper($block);
    $destination->apartament = $apartament;
    $destination->update();
    return [
        'message' => $message,
        'updated' => true
    ];


}*/

}
