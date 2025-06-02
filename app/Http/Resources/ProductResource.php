<?php

namespace App\Http\Resources;

use App\Enums\ProductMediaEnum;
use App\Traits\DisountCalculator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    use DisountCalculator;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
$price = (float) str_replace([',', '$'], '', $this->price);

   $discount = $this->relationLoaded('discount') ? $this->discount : null;
    //dd( $discount);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->getTranslation('description', app()->getLocale()),
            'price' => $this->price,
            'price-after-discount'=>$this->calculateDiscountedPrice($price, $discount),
            'discount' => new DiscountResource($this->discount),
            'image' => $this->getFirstMediaUrl(ProductMediaEnum::MAIN_IMAGE->value) ,
            'gallery' => $this->getMedia(ProductMediaEnum::GALLERY->value)
                ->map(function($image){
                return $image->original_url ;
            }) ,
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'colors' => ColorResource::collection($this->whenLoaded('colors')),
            'sizes' => ProductSizeResource::collection($this->whenLoaded('sizes')),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            'deleted_at' => $this->whenNotNull($this->deleted_at),
        ];
    }
}
