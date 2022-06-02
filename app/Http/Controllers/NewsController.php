<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(Request $request) 
    {
        $teamFilter = $request->input('team');

        // sortiraj descending po created_at koloni da bi prvo videli najnovije vesti
        $newsQuery = News::with('user')->latest(); 

        if (!empty($teamFilter)) {
            $newsQuery->whereHas('teams', fn ($existsQuery) => $existsQuery->where('teams.id', $teamFilter));
        }

        $teams = Team::get();
        
        return view('news.index', ['allNews' => $newsQuery->paginate(10), 'allTeams' => $teams]);
    }

    public function show(News $news) 
    {
        return view('news.show', ['news' => $news->load(['user', 'teams'])]);
    }

    public function create()
    {
        return view('news.create', ['teams' => Team::get()]);
    }

    public function store(NewsRequest $newsRequest)
    {
        //Kreiraj vest
        $news = new News($newsRequest->validated());
        //Povezi usera
        $news->user()->associate(Auth::user());
        //Snimi
        $news->save();

        //Dodaj nove redove u pivot tabelu (potrebno da news model bude snimljen)
        $news->teams()->attach($newsRequest->input('teams'));

        // push vrednosti na key toast_message u session koji se cita u app.blade glavnom layout fajlu
        $newsRequest->session()->flash(
            'toast_message', 
            'Thank you for publishing article on www.nba.com!'
        );

        return redirect('/news');
    }
}
