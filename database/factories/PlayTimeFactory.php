<?php

namespace Database\Factories;

use App\Models\PlayTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlayTime>
 */
class PlayTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = PlayTime::class;
    public function definition(): array
    {
        return [
            'start_time' => '08:00:00', // Overridden in Seeder
            'end_time' => '09:00:00',   // Overridden in Seeder
            'price' => $this->faker->randomFloat(2, 10000, 100000),
            'field_id' => 1, // Overridden in Seeder
        ];
    }
}
