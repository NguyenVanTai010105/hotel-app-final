<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name'        => fake()->sentence(2), // Ví dụ: "Phòng Hạng Sang"
            'type'        => fake()->randomElement(['Standard',  'VIP']),
            'capacity'    => fake()->numberBetween(1, 6), // Số khách
            'price'       => fake()->numberBetween(300000, 5000000), // Giá phòng
            'description' => fake()->paragraph(2),
            'status'      => fake()->randomElement(['available', 'occupied', 'maintenance']),
            'image'       => null,
        ];
    }
}
