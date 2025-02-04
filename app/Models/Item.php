<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['scenario_id', 'name', 'description', 'is_usable'];

    public function scenario()
    {
        return $this->belongsTo(Scenario::class);
    }
}
