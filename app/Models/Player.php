<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    /**
     * Get the team that owns the player.
     */
    public function post()
    {
        return $this->belongsTo(Team::class);
    }

    public function getFullNameAttribute() {
        return "$this->first_name $this->last_name";
    }
}
