<?php

namespace App\Models;

use App\Enums\ColorMediaEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Color extends Model implements HasMedia
{
    use HasTranslations;
    /** @use HasFactory<\Database\Factories\ColorFactory> */
    use HasFactory,  InteractsWithMedia;
    public $translatable=['title'];
    protected $fillable = ['title', 'status'];
    protected $casts=[
        'status'=>StatusEnum::class];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_colors');
    }
      public function registerMediaCollections(): void
    {
        $this->addMediaCollection(ColorMediaEnum::MAIN_IMAGE->value)
            ->useDisk(ColorMediaEnum::MAIN_IMAGE->disk())
            ->singleFile();}
}
