<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Http\Resources\ColorResource;
use App\Models\Color;
use App\Services\ColorService;
use App\Traits\ResponceTrait;


class ColorController extends Controller
{
    use ResponceTrait;
    protected $colorService;

    public function __construct(ColorService $colorService)
    {
        $this->colorService = $colorService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = $this->colorService->index();
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

        $color =$this->colorService->create($request->validated());


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
        $color= $this->colorService->getColorById($id);
            return $this->sendResponce(new ColorResource($color),
                __('this_color_retrieved_successfully'),
                200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ColorRequest $request, string $id)
{
    $color = $this->colorService->update($id, $request->validated());

    return $this->sendResponce(new ColorResource($color),
        __('this_color_updated_successfully'),
        200);
}
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->colorService->delete($id);
            return $this->sendResponce(null,
            __('this_color_deleted_successfully'),200);
    }

}
