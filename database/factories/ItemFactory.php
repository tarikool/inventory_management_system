<?php

namespace Database\Factories;

use App\Models\Inventory;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition()
    {
        $inventory = Inventory::inRandomOrder()->first();

        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(),
            'quantity' => $this->faker->numberBetween(1, 100),
            'inventory_id' => $inventory->id,
        ];
    }
}
