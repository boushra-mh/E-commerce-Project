<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;


use  App\Models\Product;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use SoftDeletes;
    use HasTranslations;
    use HasFactory;
    public $translatable = ['name'];
    protected $fillable = [

        'name'
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_products');
    }
    /*  */
}
