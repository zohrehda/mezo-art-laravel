<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject' => $this->faker->word,
          //  'uuid' => $this->faker->uuid,
            'title' => $this->faker->word,
            'priority' => 'low',
            'ref' => 'sales',
            'status' => 'open',
            'user_id'=>1 ,
            

        ];
    }
}
