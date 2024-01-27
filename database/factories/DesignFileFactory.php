<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DesignFile>
 */
class DesignFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'size' => $this->faker->numberBetween(10, 100),
            'dpi' => $this->faker->numberBetween(10, 100),
            'mime_type' => $this->faker->mimeType(),
            'extension' => $this->faker->fileExtension(),
            
        ];
    }
}
