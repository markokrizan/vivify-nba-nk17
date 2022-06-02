<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    /**
     * Get the players for the team.
     */
    public function players()
    {
        return $this->hasMany(Player::class);
    }

    /**
     * Get the comments for the team.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the comments for the team.
     */
    public function news()
    {
        // Da se tabela zvala 'news_team' laravel bi je sam nasao po konvenciji imena
        // Na ovaj nacin mozemo da prosledimo ime nase kastom pivot tabele
        return $this->belongsToMany(News::class, 'news_teams'); 
    }

}
