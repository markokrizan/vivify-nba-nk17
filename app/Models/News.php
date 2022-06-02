<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content'
    ];

    public function team() 
    {
        return $this->belongsTo(Team::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teams()
    {
        // Da se tabela zvala 'news_team' laravel bi je sam nasao po konvenciji imena
        // Na ovaj nacin mozemo da prosledimo ime nase kastom pivot tabele
        return $this->belongsToMany(Team::class, 'news_teams');
    }
}
