<?php

namespace App\Services;

use App\Models\VisitorCategory;
use App\Models\Vehicle;


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
      return $vvisitorCategory
            ->orderByDesc('id');*/
  }

  public function delete(int $id){    
    $category = VisitorCategory::find($id);
    $message = "Categoria deletada com sucesso!";
    $deleted = true;
    
    if(empty($category)){
      $deleted = false;
      $message = "Categoria não encontrada";

    }else if( Vehicle::where('visitor_category_id', $id)->get()->count() > 0  ){
            $message = 'Remoção não concluída, possui veículos nessa categoria.';
            $deleted = false;
    }else {

       $category->delete();

    }

        return [
            'message' => $message,
            'deleted' => $deleted 
        ];
  }

}
