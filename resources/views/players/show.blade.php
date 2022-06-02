@extends('layout.app')

@section('content')

<h1>Player</h1>

<p>Full name: {{$player->full_name}}</p>

<a href="{{ url("/teams/{$player->team_id}") }}">Team</a>

@endsection
