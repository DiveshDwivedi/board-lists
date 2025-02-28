<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CardController extends Controller
{
    public function store()
    {
        $validated = request()->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'board_id' => ['required', 'exists:boards,id'],
            'card_list_id' => ['required', 'exists:card_lists,id'],
        ]);

        $validated['user_id'] = Auth::id();

        Card::create($validated);

        return redirect()->back();
    }

    public function update(Card $card)
    {
        request()->validate([
            'title' => ['required', 'string', 'min:3', 'max:255']
        ]);

        $card->update([
            'title' => request('title'),
        ]);

        return redirect()->back();
    }

    public function move(Card $card) {
        $validated = request()->validate([
            'card_list_id' =>  ['required', 'exists:card_lists,id'],
            'position' => ['required', 'numeric'],            
        ]);

        $validated['position'] = round($validated['position'], 5);

        $card->update($validated);

        return redirect()->back();
    }
}
