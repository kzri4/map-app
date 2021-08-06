<?php

namespace Database\Factories;

use App\Models\shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = shop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('ja_JP');

        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->paragraph(),
            'address' => $faker->address(),
            'latitude' => $faker->latitude($min=26, $max=43),
            'longitude' => $faker->longitude($min=127.7, $max=141.6),
            'active' => 1,
        ];
    }
}
