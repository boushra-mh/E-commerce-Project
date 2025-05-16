<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Http\Resources\ColorResource;
use App\Models\Color;
use App\Traits\ResponceTrait;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    use ResponceTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorRequest $request)
    {
        $color=Color::create($request->validated());
         $color->setTranslations('title', [
            'en' => $request->title_en,
            'ar' => $request->title_ar
         ]
    ); 
    
          $color->setTranslations('status', [
            'en' => $request->status_en,
            'ar' => $request->status_ar
         ]);
          $color->save();
        return $this->sendResponce(new ColorResource($color),
        __('this_color_stored_successfully'),
        201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
