<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardList extends Model
{
    protected $guarded = [];

    public function boards()
    {
        return $this->belongsTo(Board::class);
    }
}
