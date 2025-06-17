<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function getCategoryById($id)
    {
        $category=Category::findOrFail($id);
        return $category;

    }
    public function index()
    {
        $categories=Category::with('products')->paginate();
        return $categories;
     }
    public function create(array $data){
        $category = new Category();

        $category->setTranslations('name', [
            'en' => $data['name_en'],
            'ar' => $data['name_ar']
        ]);
        $category->save();

        return $category ;
    }

     public function delete($id)
     {
        $category=$this->getCategoryById($id);
       $category->delete();

     }
     public function update($id,array $data)
     {
        $category=$this->getCategoryById($id);
       $category = $category->update($data);
       return $category;
     }
}
