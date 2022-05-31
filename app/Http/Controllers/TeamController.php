<?php

namespace App\Http\Controllers;

use App\Models\Team;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index() {
        return view('teams.index', ['teams' => Team::all()]);
    }

    public function show(Team $team) {      
        $team->load(['players', 'comments']);

        return view('teams.show', ['team' => $team]);
    }
}
