<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enigma extends Model
{
    use HasFactory;

    protected $fillable = ['scenario_id', 'question', 'answer', 'hints', 'order'];

    protected $casts = [
        'hints' => 'array',
    ];

    public function scenario()
    {
        return $this->belongsTo(Scenario::class);
    }
}
