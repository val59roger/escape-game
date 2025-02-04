<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Save extends Model
{
    use HasFactory;

    protected $fillable = ['game_id', 'data'];

    protected $casts = [
        'data' => 'array',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
