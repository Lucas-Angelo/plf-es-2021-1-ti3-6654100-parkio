<?php

namespace App\Services;

use App\Models\Destination;
use Illuminate\Support\Facades\DB;


class DestinationService
{
    
  /** 
   * Search for all gates (with pagination)
   *
   * @param String $search Search filter string to find in blocks and/or apartments
   * @return Collection
   */
  public function getAll($search = null){
    $d = new Destination();

    if(!empty($search)) {
      $d = $d->where(DB::raw("CONCAT(block,' ',apartament)"), 'LIKE' , '%'.$search.'%');
    }

    return $d->paginate(200);
  }

  public function createDestination($block,int $apartament){
    $destination = new Destination();
    $destination->block = strtoupper($block);
    $destination->apartament = $apartament;
    $destination->save();

    return $destination->id;
  }

}
