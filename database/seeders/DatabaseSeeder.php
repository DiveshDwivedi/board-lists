<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\Card;
use App\Models\CardList;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Divesh Dwivedi',
            'email' => 'divesh.dwivedi@outlook.com',
            'password' => Hash::make('1234'),
        ]);

        $Boards = Board::factory(10)->for($user)->create(); 

        foreach ($Boards as $board) {
            $card_lists = CardList::factory()->create([
                'board_id' => $board->id,
                'user_id' => $user->id,
            ]);

            Card::factory(50)->create([
                'board_id' => $board->id,
                'user_id' => $user->id,
                'card_list_id' => $card_lists->id,
            ]);

        }
    }
}
