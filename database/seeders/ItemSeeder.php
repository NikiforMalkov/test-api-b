<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Item::factory()->createMany([
            [
                'name'  => 'Газированная вода',
                'description' => 'Газированная питьевая вода',
                'category_id' => 1,
            ],
            [
                'name'  => 'Йогурт',
                'description' => 'Питьевой йогурт',
                'category_id' => 1,
            ],
            [
                'name'  => 'Ручка',
                'description' => 'Синяя ручка',
                'category_id' => 2,
            ],
            [
                'name'  => 'Ручка',
                'description' => 'Красная ручка',
                'category_id' => 2,
            ],
            [
                'name'  => 'Ручка',
                'description' => 'Зелёная ручка',
                'category_id' => 2,
            ],
            [
                'name'  => 'Карандаш в',
                'description' => 'Чёрный карандаш в',
                'category_id' => 2,
            ],
            [
                'name'  => 'Карандаш а',
                'description' => 'Чёрный карандаш',
                'category_id' => 2,
            ],
            [
                'name'  => 'Карандаш б',
                'description' => 'Чёрный карандаш б',
                'category_id' => 2,
            ],
            [
                'name'  => 'Test',
                'description' => 'Test desc',
                'category_id' => 3,
            ]
        ]);
    }
}
