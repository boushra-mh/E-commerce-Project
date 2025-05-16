<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\ResponceTrait;
use Illuminate\Http\Request;
use App;

class CategoryController extends ApiController
{
    use ResponceTrait;
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
        $title = "Hello EverBody In Any Where In The World";
      dd ( make_slug($title));
        // $categories = Category::orderBy('id', 'Asc')->with('products')->get();
        $categories = Category::whereRelation('products', 'price', 675.98)
            ->with(['products' => function ($query) {
                $query->where('price', 675.98);
            }])
            ->paginate();

        return $this->sendResponce(
            CategoryResource::collection($categories),
            __('Categories_retrieved_successfully'),200,true
        );
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
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());

        $category->setTranslations('name', [
            'en' => $request->name_en,
            'ar' => $request->name_ar
        ]);
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
    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::find($id);
        if ($category) {
            if ($request->has('name_ar')) {
                $category->setTranslation('name', 'ar', $request->name_ar);
            }
            if ($request->has('name_en')) {
                $category->setTranslation('name', 'en', $request->name_en);
            }
            $category->save();

            return $this->sendResponce(
                new CategoryResource($category),
                __('Category_updated_successfully')
            );
        } else {
            return $this->sendError(__('This_category_Not_found'), 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return $this->sendResponce(null, __('Category_deleted_successfully'));
        } else {
            return $this->sendError(__('This_category_Not_found'), 404);
        }
    }
}
