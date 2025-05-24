<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->getTranslation('description', app()->getLocale()),
            'price' => $this->price,
            'discount_id'=>$this->discount_id,
            'image_url' => $this->getFirstMediaUrl('products'),
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'colors' => ColorResource::collection($this->whenLoaded('colors')),
            'sizes' => ProductSizeResource::collection($this->whenLoaded('sizes')),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            'deleted_at' => $this->whenNotNull($this->deleted_at),
        ];
    }
}
