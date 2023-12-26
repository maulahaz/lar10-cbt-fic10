<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ujian>
 */
class UjianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'   => $this->faker->numberBetween(1,5),
            'nilai_area1'   => $this->faker->numberBetween(1,50),
            'nilai_area2'   => $this->faker->numberBetween(1,50),
            'nilai_area3'   => $this->faker->numberBetween(1,50),
            'nilai_area9'   => $this->faker->numberBetween(1,50),
            'hasil'         => $this->faker->randomElement(['Lulus', 'Tidak Lulus']),
            'status_area1'        => $this->faker->randomElement(['Start', 'Done']),
            'status_area2'        => $this->faker->randomElement(['Start', 'Done']),
            'status_area3'        => $this->faker->randomElement(['Start', 'Done']),
            'status_area9'        => $this->faker->randomElement(['Start', 'Done']),
            'timer_area1'   => $this->faker->numberBetween(1,100),
            'timer_area2'   => $this->faker->numberBetween(1,100),
            'timer_area3'   => $this->faker->numberBetween(1,100),
            'timer_area9'   => $this->faker->numberBetween(1,100),
        ];
    }
}
