<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use App\Http\Resources\DiscountResource;
use App\Models\Discount;
use App\Traits\ResponceTrait;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    use ResponceTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts=Discount::with('products')->paginate();
        return $this->sendResponce(DiscountResource::collection($discounts),
        __('discount_retreived_successfully'),
        200,
        true);
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
    public function store(DiscountRequest $request)
    {
        $discount=Discount::create($request->validated());
         $discount->setTranslations('title', [
            'en' => $request->title_en,
            'ar' => $request->title_ar
        ]);

        $discount->save();
        return $this->sendResponce($discount,__('discount_created_successfully'),201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
