<?php

namespace App\Services;

use App\Models\Destination;


class DestinationService
{
    
    public function getAll(){
        return Destination::paginate();
    }


    public function createDestination($block,int $apartament){
      $destination = new Destination();
      $destination->block = strtoupper($block);
      $destination->apartament = $apartament;
      $destination->save();

      return $destination->id;
    }






}
