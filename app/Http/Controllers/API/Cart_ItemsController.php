<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiController;
use App\Models\Cart_Item;
use App\Traits\ResponceTrait;
use Illuminate\Http\Request;

class Cart_ItemsController extends ApiController
{
    use ResponceTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //REVIEW - Focus please please
        $cart_items = Cart_Item::orderBy('id', 'desc')->with('product.category')->get();

        return $this->sendResponce($cart_items, 'cart_items retrieved successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cart_items = Cart_Item::create($request->all());

        // Return JSON response

        return $this->sendResponce($cart_items, 'cart_items created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cart_items = Cart_Item::find($id);
        if (!$cart_items) {

            return $this->sendError($cart_items, 'This cart_items Not found');
        } else {

            return $this->sendResponce($cart_items, 'cart_items created successfully');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cart_items = Cart_Item::find($id);
        if ($cart_items) {
            $cart_items->update([
                'quantity' => $request->get('quantity'),
                'product_id' => $request->get('product_id'),
                'user_id' => $request->get('user_id'),

            ]);
            return $this->sendResponce($cart_items, 'cart_items updated successfully');
        } else {

            return $this->sendError(null, 'TThe cart_items cant updated or not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart_item = Cart_Item::find($id);
        if ($cart_item) {
            $cart_item->delete();

            return $this->sendResponce($cart_item, 'The cart_item Is Deleted Successfully');
        } else {

            return $this->sendError(null, 'This cart_item Not found');
        }
    }
}
