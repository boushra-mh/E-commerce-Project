<?php

namespace Database\Factories;

use App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    use HasFactory;
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $enFaker = fake('en_US');

        $arFaker = fake('ar_SA');

        return [
            'name' => [
                'en' => $enFaker->words(2, true),
                'ar' => $arFaker->words(2, true),
            ],
            'description' => [
                'en' => $enFaker->sentence(),
                'ar' => $arFaker->sentence(),
            ],
            'price' => $enFaker->randomFloat(2, 10, 1000),
        ];
    }
}
