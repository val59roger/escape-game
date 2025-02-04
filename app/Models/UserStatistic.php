<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'games_played', 'games_won', 'games_lost', 'total_score', 'best_score'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
