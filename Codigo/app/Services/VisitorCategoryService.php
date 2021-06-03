<?php

namespace App\Services;

use App\Models\VisitorCategory;
use App\Models\Vehicle;


class VisitorCategoryService
{


    public function create($description,int $time){

      $message = "Categoria de Visitante cadastrada com sucesso!";

      $visitorCategory = new VisitorCategory();
      $visitorCategory->description = strtoupper($description);
      $visitorCategory->time = $time;
      $visitorCategory->save();

      return [
        'id'=>$visitorCategory->id,
        'message'=>$message
      ];
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

    if(empty($category)) {
      $deleted = false;
      $message = "Categoria não encontrada";
    } else {
       $category->delete();
    }

    return [
        'message' => $message,
        'deleted' => $deleted
    ];
  }

  public function search(int $id)
    {
        $category = VisitorCategory::find($id);

        if(!empty($category)){

            return $category;

        }else {
            throw new \Exception("Visitor Category Not Found", 404);
        }

    }

  public function update(int $id, String $description, int $time){
    $message = 'Categoria editada com sucesso';

    $category = $this->search($id);

    $category->description = strtoupper($description);
    $category->time = $time;
    $category->update();
    return [
        'message' => $message,
        'updated' => true
    ];


}

}
