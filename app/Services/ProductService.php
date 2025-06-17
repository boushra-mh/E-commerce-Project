<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{

    public function getProductById($id ,$withTrashed=false)
    {
        $product=Product::when($withTrashed,fn($q)=>$q->withTrashed())
        ->findOrFail($id);
        return $product;
    }

    public function create(array $data)
    {
        $product=Product::create($data);
        return $product;
    }

   public function update($id , array $data){
        $product = $this->getProductById($id);

        $product->update($data);
        return $product ;
    }
    public function delete($id)
    {
        $product = $this->getProductById($id);
        $product->delete();
    }
    public function updateProductCategories($product ,$category_ids)
    {

        $product->categories()->sync($category_ids);
        return $product;
    }

}
