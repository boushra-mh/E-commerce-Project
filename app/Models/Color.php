<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Color extends Model
{
    use HasTranslations;
    /** @use HasFactory<\Database\Factories\ColorFactory> */
    use HasFactory;
    public $translatable=['title', 'status'];
    protected $fillable = ['title', 'status'];
    protected $casts=[
        'status'=>StatusEnum::class];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_colors');
    }
}
