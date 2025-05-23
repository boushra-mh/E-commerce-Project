<?php

namespace App\Traits;

use App\Enums\TypeDiscountEnums;
use App\Models\Discount;

trait DicountCalculator
{
    public function calculateDiscountedPrice(float $price, Discount $discount): float
    {
         if (!$discount || now()->lt($discount->start_date) || now()->gt($discount->end_date)) {
            return $price;
        }

        return match ($discount->type) {
            'percentage' => $price - ($price * ($discount->value / 100)),
            'fixed' => max($price - $discount->value, 0),
            default => $price,
        };
    }
}
