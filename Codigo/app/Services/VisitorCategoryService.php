<?php

namespace App\Services;

use App\Models\VisitorCategory;


class VisitorCategoryService
{


    public function createVisitorCategory($description,int $time){

      $visitorCategory = new VisitorCategory();
      $visitorCategory->description = strtoupper($description);
      $visitorCategory->time = $time;
      $visitorCategory->save();

      return $visitorCategory->id;
    }




}
