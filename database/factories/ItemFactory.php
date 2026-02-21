<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Item;
use App\Models\Location;
use App\Models\Manufacturer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Item::class;

    public function definition(): array
    {
        $units = ['pcs', 'set', 'm', 'kg', 'Ohm', 'F', 'V', 'H'];

        return [
            'name' => $name = fake()->unique()->words(rand(1, 3), true),
            'slug' => Str::slug($name),
            'serial_number' => strtoupper(fake()->bothify('??###??###')),
            'model' => strtoupper(fake()->bothify('??-###')),
            'value' => fake()->randomFloat(2, 0.1, 10000),
            'unit' => fake()->randomElement($units),
            'quantity' => fake()->numberBetween(1, 100),
            'minimal_quantity' => fake()->numberBetween(1, 20),
            'description' => fake()->sentence(8),
            'picture' => fake()->unique()->imageUrl(640, 480, 'technics', true),
            'datasheet' => fake()->unique()->url,
            'category_id' => Category::inRandomOrder()->first()->id ?? null,
            'location_id' => Location::inRandomOrder()->first()->id ?? null,
            'manufacturer_id' => Manufacturer::inRandomOrder()->first()->id ?? null,
        ];
    }
}
