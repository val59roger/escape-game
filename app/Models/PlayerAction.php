<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerAction extends Model
{
    use HasFactory;

    protected $fillable = ['game_id', 'enigma_id', 'item_id', 'action'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
