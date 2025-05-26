<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Admin::updateOrCreate(
            ['email' => 'boushraalmouhamad@gmail.com'], // Unique key
            [
                'name' => 'Boushra Almouhamad',
                'password' => Hash::make('123456789'), // استخدم كلمة مرور آمنة في الإنتاج
            ]
        );
    }
}
