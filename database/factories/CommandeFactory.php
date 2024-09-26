<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commande>
 */
class CommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => \App\Models\Client::inRandomOrder()->first()->id,
            'offer_id' => \App\Models\Offre::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['new', 'in_progress', 'awaiting', 'completed']), // Use only valid status values
            'number_of_licenses' => $this->faker->numberBetween(1, 100),
            'description' => $this->faker->sentence,
            'os_type' => $this->faker->randomElement(['Windows', 'Linux', 'Mac']),
            'extended_protection' => $this->faker->boolean,
            'encryption_protection' => $this->faker->boolean,
            'firewall' => $this->faker->boolean,
        ];
    }
}
