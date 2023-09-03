<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Channel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Factory>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $channels = Channel::get()->pluck('id')->toArray();
        return [
            'title' => fake()->text(30),
            'content' => fake()->text(600),
            'channel_id' => fake()->randomElement($channels),
        ];
    }
}
