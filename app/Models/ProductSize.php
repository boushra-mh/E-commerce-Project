<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasTranslations;

    protected $fillable=['title','status','products_id'];
     public $translatable = ['title'];

 protected $casts=[
        'status'=>StatusEnum::class
    ];
    

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
