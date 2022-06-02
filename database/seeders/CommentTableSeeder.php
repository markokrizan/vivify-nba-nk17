<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::pluck('id');

        Team::all()->each(function ($team) use ($users) {
            Comment::factory(5)->create(
                [
                    'team_id' => $team->id,
                    // U koliko za vrednost fielda stavimo funkciju laravel ce je izvrsiti svaki put kada kreira komentar
                    // u koliko bi ostavili $users->random() 1 random user bi se primenio na svih 5 komentara koje kreiramo
                    // u ovom slucaju pri kreiranju svakog od 5 komentara izvrsavamo random funkciju i dobijamo random korisnika
                    'user_id' => fn() => $users->random() 
                ]
            );
        });
    }
}
