<?php

namespace App\Traits;

use App\Enums\StatusEnum;
use App\Enums\TypeDiscountEnums;
use App\Models\Discount;

trait DisountCalculator
{
    public function calculateDiscountedPrice(float $price,? Discount $discount): float
    {
    //     dd([
    //     'price' => $price,
    //     'discount' => $discount,
    //     'now' => now()->toDateTimeString(),
    //     'start_date' => $discount?->start_date,
    //     'end_date' => $discount?->end_date,
    //     'status' => $discount?->status,
    // ]);
         if (!$discount ||
        $discount->status != StatusEnum::Active) {
            return $price;
        }

        return match ($discount->type) {
            TypeDiscountEnums::PERCENTAGE => $price - ($price * ($discount->value / 100)),
            TypeDiscountEnums::FIXED => $price - $discount->value, //max($price - $discount->value, 0)
            default => $price,
        };
    }
}
