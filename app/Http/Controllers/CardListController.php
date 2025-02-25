<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\CardList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardListController extends Controller
{
    public function store(Request $request, Board $board) {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
        ]);

        CardList::create([
            'name' => $validated['name'],
            'user_id' => Auth::user()->id,
            'board_id' => $board->id
        ]);

        return redirect()->back();
    }
}
