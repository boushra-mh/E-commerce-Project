<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;
    use HasFactory;
    use SoftDeletes;
    public $translatable = ['name', 'description'];

    protected $fillable = [
        'name',
        'price',
        'description',

    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_products');
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products');
    }
    public function getPriceAttribute($price)
    {
        return '$' . number_format($price, 2);
    }
    public function getNameAttribute($name)
    {
        return ucfirst($name);
    }
    public function setNameAttribute($name)
    {

        $this->attributes['name'] = ucfirst($name);
    }
}
