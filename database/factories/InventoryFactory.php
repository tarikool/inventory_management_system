<?php

namespace Database\Factories;

use App\Models\Inventory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryFactory extends Factory
{
    protected $model = Inventory::class;

    public function definition()
    {
        $user = User::all()->random(1)->first();


        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'user_id' => $user->id,
        ];
    }
}
