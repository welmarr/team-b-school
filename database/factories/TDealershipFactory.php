<?php

namespace Database\Factories;

use App\Models\TDealership;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dealer>
 */
class TDealershipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     * @var string
     */

     protected $model = TDealership::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'code' =>generateRandomAlphanumericCode(rand(3,5)),
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
