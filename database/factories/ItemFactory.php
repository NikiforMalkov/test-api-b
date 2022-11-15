<?php

namespace Database\Factories;

use App\Jobs\ProcessItem;
use App\Models\Item;
use App\Services\ElasticService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ItemFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->title(),
            'description' => fake()->text(),
            'category_id' => null
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Item $item) {
            //
        })->afterCreating(function (Item $item) {
            //TODO: переместить в конфиги время
            ProcessItem::dispatch($item)->delay(now()->addSeconds(30));
        });
    }
}
