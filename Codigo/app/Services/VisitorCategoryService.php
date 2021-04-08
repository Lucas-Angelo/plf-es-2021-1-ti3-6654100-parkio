<?php

namespace App\Services;

use App\Models\VisitorCategory;


class VisitorCategoryService
{


    public function create($description,int $time){

      $visitorCategory = new VisitorCategory();
      $visitorCategory->description = strtoupper($description);
      $visitorCategory->time = $time;
      $visitorCategory->save();

      return $visitorCategory->id;
    }

    public function getAll(){
      $v = VisitorCategory::all();
      
      return $v;/*
      return $v
            ->orderByDesc('id');*/
  }




}
