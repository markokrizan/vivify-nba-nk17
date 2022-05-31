@extends('layout.app')

@section('title', 'Team')

@section('content')
    <h1>Team</h1>

    <p>Name: {{$team->name}}</p>
    <p>Address: {{$team->address}}</p>
    <p>City: {{$team->city}}</p>

    <h3>Players</h3>

    @foreach($team->players as $player)
        <li>
            <a href="/players/{{$player->id}}">{{ $player->full_name }}</a>
        </li>
    @endforeach

    <h3>Comments</h3>

    @foreach($team->comments as $comment)
        <li>
            {{ $comment->content }}
        </li>
    @endforeach

    <form method="POST" action="/teams/{{$team->id}}/comments">
        @csrf

        <label for="content">Add comment to team</label>
        <textarea name="content" id="content" rows="2"></textarea>
        @error('content')
            <span class="form-text text-danger">{{$message}}</span>
        @enderror

        <button type="submit" class="btn btn-primary">Save comment</button>
    </form>
@endsection
