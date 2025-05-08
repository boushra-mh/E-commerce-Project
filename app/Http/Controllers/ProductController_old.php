<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController_old extends Controller
{
    private $products = [
        ["id" => 1, "name" => "product_1", "price" => 100],
        ["id" => 2, "name" => "product_2", "price" => 100],
        ["id" => 3, "name" => "REQ", "price" => 1000]


    ];

    public function index()
    {
        $product_names = [];
        $responce = '';

        foreach ($this->products as $product) {
            $product_names[] = $product["name"];
            $responce .= 'h2' . $product["name"] . '/h2';
        }
        return response()->json([$product_names]);
        //LINK -  dd($responce);
    }
    public function store(ProductRequest $request) {}
    public function showByID($id = null)
    {

        foreach ($this->products as $product) {
            if ($product['id'] == $id) {
                return response()->json([$product]);
            }
        }
        return abort(404);
    }
}
