<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Responden>
 */
class RespondenFactory extends Factory
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
            "nama" => $this->faker->name(),
            "email" => $this->faker->unique()->safeEmail(),
            "jenis_kelamin" => $this->faker->randomElement(["Laki-laki", "Perempuan"]),
        ];
    }
}
