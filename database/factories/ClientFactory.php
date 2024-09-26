<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'siren' => $this->faker->unique()->numerify('#########'),
            'siret' => $this->faker->unique()->numerify('#########00000'),
            'legal_name' => $this->faker->company,
        ];
    }
}
