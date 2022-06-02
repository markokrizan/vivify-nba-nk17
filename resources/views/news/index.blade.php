@extends('layout.app')

@section('content')
<form method="GET">
    <select name="team">
        @foreach ($allTeams as $team)
            <option value="{{$team->id}}">{{$team->name}}</option>
        @endforeach
    </select>

    <button type="submit">Filter news by team</button>
</form>

<ul>
@foreach($allNews as $news)
    <li><a href="/news/{{$news->id}}">{{$news->title}} (created by {{$news->user->name}})<a></li>
@endforeach
</ul>

{{-- Da bi mogli i da filtriramo i paginiramo u isto vreme moramo da na pagination query paramtar page da dodamo --}}
{{-- I sve prethodne query parametre koje smo smo imali --}}
{{ $allNews->withQueryString()->links() }}
@endsection
