<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RegularDealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
           $companyName = $this->faker->company();

        return [
            'name' => $companyName,
            'details' => $this->faker->sentence(6), // e.g., "10% discount in anything"
            'image' => "https://picsum.photos/300?random=" . $this->faker->unique()->numberBetween(1, 1000), // Unique image URL
            'location' => 'https://www.google.com/maps/search/?api=1&query=' . urlencode($this->faker->address()),
            'phone' => $this->faker->phoneNumber(),
            'facebook' => 'https://facebook.com/' . Str::slug($companyName),
            'discount_percentage' => $this->faker->numberBetween(5, 50),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
