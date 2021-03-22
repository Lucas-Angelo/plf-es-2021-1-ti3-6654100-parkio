<?php

namespace App\Services;

use App\Models\Destination;


class DestinationService
{
    //
    public function getAll(){
        return Destination::paginate();
    }


    public function verifyDestination($block,int $apartament){
      $destination = Destination::where('block','=', $block)->where('apartament','=',$apartament)->first();
      if($destination!=null) return $destination->id;
       return $this->createDestination($block, $apartament);

    }

    public function createDestination($block,int $apartament){
      $destination = new Destination();
      $destination->block = strtoupper($block);
      $destination->apartament = $apartament;
      $destination->save();

      return $destination->id;
    }






}
