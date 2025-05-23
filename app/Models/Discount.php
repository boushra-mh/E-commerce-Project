<?php

namespace App\Models;

use App\Enums\StatusEnum;
use App\Enums\TypeDiscountEnums;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
     use HasTranslations;
    protected $fillable=['title','type','status','start_date','end_date','value'];

     public $translatable = ['title'];

    protected $casts=[
        'status'=>StatusEnum::class,
        'type'=>TypeDiscountEnums::class,
          'start_date' => 'datetime',
    'end_date' => 'datetime',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}

