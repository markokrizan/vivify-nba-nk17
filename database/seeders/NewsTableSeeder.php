<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        Team::all()->each(function ($team) use ($users) {
            $team->news()->attach(News::factory(20)->create([
                // U koliko za vrednost fielda stavimo funkciju laravel ce je izvrsiti svaki put kada kreira komentar
                // u koliko bi ostavili $users->random() 1 random user bi se primenio na svih 5 komentara koje kreiramo
                // u ovom slucaju pri kreiranju svake od 10 vesti izvrsavamo random funkciju i dobijamo random korisnika
                'user_id' => fn () => $users->random()->id
            ]));
        });
    }
}
