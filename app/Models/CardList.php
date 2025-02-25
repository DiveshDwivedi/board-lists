<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardList extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function boards()
    {
        return $this->belongsTo(Board::class);
    }

    public function cards() {
        return $this->hasMany(Card::class);
    }
}
