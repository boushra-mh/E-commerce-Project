<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\ResponceTrait;
use Illuminate\Http\Request;
use App\Enums\ProductMediaEnum;
use App\Services\ProductService;

class ProductController extends ApiController
{
    use ResponceTrait;
    protected $productService;

    public function __construct(ProductService $productService)
    {

        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $products = Product::query();;

        if ($search != null) {
            $products = $products->where('name', 'like', '%' . $search . '%');
        }

        /*
         * $limit = $request->input('limit', 10); //NOTE -  - number of products in a page
         *
         * $page = $request->input('page', 0); //NOTE - number of page
         *
         * $product = Product::all();
         */
        // REVIEW - Clone allow using aggregation fun with cancel

        // all ralation with another models for optimization

        // FIXME -  $count_products = (clone $product)->count();

        // NOTE - after with()fun we need ->get() because is acollection .

        $products = $products->with('discount', 'categories', 'colors', 'sizes')->paginate();  /* ->pluck('name', 'id') */

        // REVIEW -  $products = $products->filter(fn($product) => $product->price > 1000);

        // REVIEW -   $products = $products->sortBy('name');

        // REVIEW -  $products = $products->map(function ($product) {

        /*
         * $product->price = '$' . number_format($product->price, 2);
         *     return $product;
         * });
         */

        return $this->sendResponce(
            ProductResource::collection($products),
            __('Products_retrieved_successfully'), 200, true
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
    public function store(ProductRequest $request)
    {
        $category_ids = $request->category_ids;  // REVIEW  - This ids will i hold from request as array .

        $product = Product::create($request->validated());
        $product->setTranslations('name', [
            'en' => $request->name_en,
            'ar' => $request->name_ar
        ]);
        $product->save();
          if ($request->hasFile('image')  && $request->file('image')->isValid()) {
           $product
                ->addMedia($request->file('image'))
                ->toMediaCollection('main-image');
        }



        if ($request->hasFile('images')) {
            // إذا كانت 'images' مجموعة من الصور (multiple)
            foreach ($request->file('images') as $image) {
                  if ($image && $image->isValid()) {
            $product->addMedia($image)->toMediaCollection(ProductMediaEnum::GALLERY->value);
        }
            }
        }


        $product->categories()->attach($category_ids);  // REVIEW - attach: Adding Records to a Many-to-Many Relationship .

        $product->colors()->attach($request->color_ids);

        $product->colors()->syncWithoutDetaching($request->color_ids);

        // Return JSON response

        return $this->sendResponce(
            new ProductResource($product),
            __('Product_created_successfully'),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->sendError(__('This_Product_Not_found'), 404);
        } else {
            return $this->sendResponce(
                new ProductResource($product),
                __('Product_retrieved_successfully')
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

   public function update(ProductRequest $request, string $id)
{
    $product=$this->productService->update($id, $request->all());
    $this->productService->updateProductCategories($product,$request->category_ids);
    // $product = Product::find($id);
    // if (!$product) {
    //     return $this->sendError(__('The_Product_cant_updated_or_not_Found'));
    // }

    // if ($request->has('name_ar')) {
    //     $product->setTranslation('name', 'ar', $request->name_ar);
    // }
    // if ($request->has('name_en')) {
    //     $product->setTranslation('name', 'en', $request->name_en);
    // }

    // $product->update($request->validated());

    // $category_ids = $request->category_ids;
    // $product->categories()->sync($category_ids);

    // if ($request->hasFile('image')) {
    //     $product
    //         ->addMedia($request->file('image'))
    //         ->toMediaCollection('main-image');
    // }

    // if ($request->hasFile('images')) {
    //     foreach ($request->file('images') as $image) {
    //         $product->addMedia($image)->toMediaCollection(ProductMediaEnum::GALLERY->value);
    //     }
    // }

    return $this->sendResponce(
        new ProductResource($product),
        __('Product_updated_successfully')
    );
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $this->productService->delete($id);
            return $this->sendResponce(null, __('The_Product_Is_Deleted_Successfully'));

    }

    public function retrieve_active_records()
    {
        $activeProducts = Product::all();  // SECTION -  Retrieves only active products .

        return $this->sendResponce($activeProducts, __('Product_retrieved_successfully'));
    }

    public function soft_deleted_records()
    {
        $allProducts = Product::withTrashed()->get();  // SECTION -  Retrieves all products, including soft-deleted ones .

        return $this->sendResponce(
            ProductResource::collection($allProducts),
            __('Product_retrieved_successfully')
        );
    }

    public function only_soft_deleted_records()
    {
        $deletedProructs = Product::onlyTrashed()->get();  // SECTION - Retrieves only deleted products .

        return $this->sendResponce(
            ProductResource::collection($deletedProructs),
            __('Product_retrieved_successfully')
        );
    }

    public function restore_product($id)  // SECTION - Restore all products with deleted_at flag .
    {
        $product = Product::withTrashed()->find($id);

        $product->restore();

        return $this->sendResponce(
            new ProductResource($product),
            __('The_Product_restored_Successfully')
        );
    }
}
