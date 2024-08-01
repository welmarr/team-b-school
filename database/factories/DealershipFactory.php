<?php

namespace Database\Factories;

use App\Models\Dealership;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dealer>
 */
class DealershipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     * @var string
     */

     protected $model = Dealership::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'code' => Str::random(rand(3,5)),
            'admin_id' => User::factory(),
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
