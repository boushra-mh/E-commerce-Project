<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ProductStatus;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasMedia
{
    use HasTranslations;
    use InteractsWithMedia;
    use HasFactory;
    use SoftDeletes;
    public $translatable = ['name', 'description'];

    protected $fillable = [
        'name',
        'price',
        'description',
        'status',
        'discount_id'

    ];
    protected $casts=[
        'status'=>ProductStatus::class
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_products');
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products');
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class,'product_colors');
    }

    public function discount()
{
    return $this->belongsTo(Discount::class);
}
    // public function getPriceAttribute($price)
    // {
    //     return '$' . number_format($price, 2);
    // }
    public function getNameAttribute($name)
    {
        return ucfirst($name);
    }
    public function setNameAttribute($name)
    {

        $this->attributes['name'] = ucfirst($name);
    }
}
