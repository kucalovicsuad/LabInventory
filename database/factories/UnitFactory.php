<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unit>
 */
class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $units = [
            'A',
            'V',
            'Ohm',
            'pF',
            'nF',
            'uF',
            'kOhm',
            'mA',
            'kV',
            'mV',
            'H',
            'W',
        ];

        return [
            'name' => fake()->unique()->randomElement($units),
            'description' => fake()->sentence(rand(2, 9)),
        ];
    }
}
