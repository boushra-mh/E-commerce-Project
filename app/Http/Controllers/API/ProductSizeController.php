<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductSizeRequest;
use App\Http\Resources\ProductSizeResource;
use App\Models\ProductSize;
use App\Traits\ResponceTrait;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{
    use ResponceTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $size=ProductSize::with('product')->paginate();
        return $this->sendResponce(ProductSizeResource::collection($size),
        __('size_retreived_successfully'),
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
    public function store(ProductSizeRequest $request)
    {
         $size =ProductSize::create($request->validated());
           $size->setTranslations('title', [
            'en' => $request->title_en,
            'ar' => $request->title_ar
        ]);
        $size->save();
        return $this->sendResponce( $size,__('size_stored_successfully'),201);
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
