<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categories = [
        ["id" => 1, "name" => "cloths"],
        ["id" => 2, "name" => "food"],
        ["id" => 3, "name" => "games"]

    ];
    public function index()
    {

        $all_category = [];
        foreach ($this->categories as $category) {

            $all_category[] = $category;
        }
        //LINK - dd($all_category);
        return response()->json($all_category);
    }
    public function showByID($id)
    {
        foreach ($this->categories as $category) {
            if ($category["id"] == $id) {
                return Response()->json($category);
            }
        }
        return abort(404);
    }
}
