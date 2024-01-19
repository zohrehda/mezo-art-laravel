<?php

namespace Database\Factories;

use App\Enums\DesignPrintType;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\DesignType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Design>
 */
class DesignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->numberBetween(10000, 99999),
            'print_type' => $this->faker->randomElement(array_column(DesignPrintType::cases(), 'value')),
            'design_type' => $this->faker->randomElement(array_column(DesignType::cases(), 'value')) ,
            'designer_id'=>1
        ];
    }
}
