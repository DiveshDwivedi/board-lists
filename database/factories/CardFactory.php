<?php

namespace Database\Factories;

use App\Models\Board;
use App\Models\CardList;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'board_id' => Board::factory(),
            'user_id' => User::factory(),
            'card_list_id' => CardList::factory(),
            'title' => fake()->sentence,
            'description' => fake()->sentence(3, true),
        ];
    }
}
