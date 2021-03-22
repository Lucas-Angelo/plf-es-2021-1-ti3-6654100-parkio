<?php

namespace App\Services;

use App\Models\VisitorCategory;


class VisitorCategoryService
{

    public function verifyVisitorCategory($description, int $time){

      $visitorCategory = VisitorCategory::where('description','=', $description)->first();

      if($visitorCategory!=null)  return $visitorCategory->id;
      else return $this->createVisitorCategory($description, $time);


    }

    public function createVisitorCategory($description,int $time){

      $visitorCategory = new VisitorCategory();
      $visitorCategory->description = strtoupper($description);
      $visitorCategory->time = $time;
      $visitorCategory->save();

      return $visitorCategory->id;
    }




}
