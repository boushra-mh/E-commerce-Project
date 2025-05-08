<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;
    use HasFactory;
    protected $fillable=['total','tax','status'];
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class,'order_id');
    }

}
