<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->createMany([
            [
                'id' => 1,
                'name' => 'first',
                'parent_id' => null,
                'index' => 1,
            ],
            [
                'id' => 2,
                'name' => 'second',
                'parent_id' => 1,
                'index' => 3,
            ],
            [
                'id' => 3,
                'name' => 'third',
                'parent_id' => 1,
                'index' => 2,
            ],
            [
                'id' => 4,
                'name' => 'test',
                'parent_id' => null,
                'index' => 1,
            ],
            [
                'id' => 5,
                'name' => 'test 2',
                'parent_id' => 4,
                'index' => 1,
            ],
            [
                'id' => 6,
                'name' => 'test 3',
                'parent_id' => null,
                'index' => 1,
            ],
            [
                'id' => 7,
                'name' => 'test 4',
                'parent_id' => 6,
                'index' => 1,
            ],
            [
                'id' => 8,
                'name' => 'test 5',
                'parent_id' => 1,
                'index' => 1,
            ],
            [
                'id' => 9,
                'name' => 'test 6',
                'parent_id' => 8,
                'index' => 2,
            ],
            [
                'id' => 10,
                'name' => 'test 7',
                'parent_id' => 8,
                'index' => 1,
            ]
        ]);

    }
}
