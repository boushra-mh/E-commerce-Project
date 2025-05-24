<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Http\Resources\ColorResource;
use App\Models\Color;
use App\Traits\ResponceTrait;


class ColorController extends Controller
{
    use ResponceTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = Color::paginate();
        return $this->sendResponce(ColorResource::collection($colors),
            __('these_colors_retrieved_successfully'),
            200,
            true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorRequest $request)
    {
        $color = Color::create($request->validated());
        $color->setTranslations('title', [
            'en' => $request->title_en,
            'ar' => $request->title_ar
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
        $color_id = Color::find($id);
        if ($color_id) {
            return $this->sendResponce(new ColorResource($color_id),
                __('this_color_retrieved_successfully'),
                200);
        } else {
            return $this->sendError(__('this_color_isnt_found'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ColorRequest $request, string $id)
    {
        $color = Color::find($id);
        if ($color) {
            if ($request->has('title_ar')) {
                $color->setTranslation('title', 'ar', $request->title_ar);
            }
            if ($request->has('title_en')) {
                $color->setTranslation('title', 'en', $request->title_en);
            }
           
            $color->save();
            return $this->sendResponce(new ColorResource($color),
            __('this_color_updated_successfully'),
            200);
        }
        else{
            return $this->sendError(__('you_cannot_update_this_color_!'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $color=Color::find($id);
        if($color)
        {
            $color->delete();
            return $this->sendResponce(null,
            __('this_color_deleted_successfully'),200);
        }
        else
        return $this->sendError(__('this_isnt_exist'));
    }
}
