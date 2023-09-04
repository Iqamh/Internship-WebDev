<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => fake()->name(),
            'nim' => fake()->numerify('#########'),
            'noHP' => fake()->phoneNumber(),
            'email' => fake()->safeEmail(),
            'institusi' => fake()->company(),
            'fakultas' => fake()->word(),
            'jurusan' => fake()->word(),
            'waktu_mulai' => fake()->dateTimeBetween('now', '+1 week'),
            'waktu_selesai' => fake()->dateTimeBetween('+1 week', '+2 month'),
            'judul' => fake()->sentence(),
            'rekomendasi' => fake()->word(),
            'surat' => fake()->word(),
            'bidang' => fake()->word(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
