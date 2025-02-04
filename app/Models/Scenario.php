<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scenario extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'difficulty'];

    public function enigmas()
    {
        return $this->hasMany(Enigma::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
