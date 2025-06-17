<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\ResponceTrait;
use Illuminate\Http\Request;
use App;
use App\Services\CategoryService;

class CategoryController extends ApiController
{
    use ResponceTrait;

    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService=$categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    protected $locale;

    /* public function __construct(Request $request)
    {
        $this->locale = $request->header('locale') ?? 'en';

        App::setLocale($this->locale);
    } */
    public function index(Request $request)
    {
    //     $title = "Hello EverBody In Any Where In The World";
    //   dd ( make_slug($title));
        // $categories = Category::orderBy('id', 'Asc')->with('products')->get();
        $categories = $this->categoryService->index();

        return $this->sendResponce(
            CategoryResource::collection($categories),
            __('Categories_retrieved_successfully'),200,true
        );
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->categoryService->create($request->validated());
        $category->save();

        return $this->sendResponce(
            new CategoryResource($category),
            __('Category_stored_successfully'),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->sendError(__('This_categories_Not_found'));
        } else {
            return $this->sendResponce(
                new CategoryResource($category),
                __('Category_retrieved_successfully')
            );
        }
    }


    public function update(CategoryRequest $request, string $id)
    {
        $category =$this->categoryService->update($id, $request);

            return $this->sendResponce(
                new CategoryResource($category),
                __('Category_updated_successfully')
            );

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $category = $this->categoryService->delete($id);
            return $this->sendResponce(null, __('Category_deleted_successfully'));
    }
}
