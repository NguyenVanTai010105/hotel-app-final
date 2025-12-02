<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        foreach (range(1, 10) as $i) {
            Room::create([
                'name'        => fake()->sentence(2),
                'type'        => fake()->randomElement(['Standard', 'VIP']),
                'capacity'    => fake()->numberBetween(1, 6),
                'price'       => fake()->numberBetween(300000, 5000000),
                'description' => fake()->paragraph(2),
                'status'      => fake()->randomElement(['available', 'occupied', 'maintenance']),
                'image'       => "https://source.unsplash.com/800x600/?hotel,room&sig={$i}",
            ]);
        }
    }
}
