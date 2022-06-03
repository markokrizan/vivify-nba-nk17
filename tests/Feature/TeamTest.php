<?php

namespace Tests\Feature;

use App\Models\Team;
use App\Models\User;
use Tests\TestCase;

// Naziv klase mora zavrsavati sa Test
class TeamTest extends TestCase
{
    // Imena metoda moraju pocinjati sa test
    // U koliko ovo nije ispunjeno test se nece racunati

    public function testListTeamsUnathenticated()
    {
        $response = $this->get('/teams');

        $response->assertStatus(302);
    }

    public function testListTeamsAuthenticated()
    {
        $response = $this
            ->actingAs(User::first())
            ->get('/teams');

        $response->assertViewHas('teams', Team::get());
        $response->assertViewIs('teams.index');
        $response->assertStatus(200);
    }

    public function testShowSingleTeam()
    {
        $team = Team::first();

        $response = $this
            ->actingAs(User::first())
            ->get('/teams/' . $team->id);

        $response->assertViewHas('team', $team);
        $response->assertViewIs('teams.show');
        $response->assertStatus(200);
    }
}
