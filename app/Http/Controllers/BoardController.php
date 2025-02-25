<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BoardController extends Controller
{
    public function index() {
        return Inertia::render('Boards/Index', [
            'boards' => auth()->user()->boards,
        ]);
    }

    public function show(Board $board) {
        $board->load('lists.cards');

        return Inertia::render('Boards/Show', [
            'board' => $board,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|min:3|max:51',
        ]);

        Board::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, Board $board) {

        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
        ]);

        $board->update($validated);

        return redirect()->back();
    }
}
