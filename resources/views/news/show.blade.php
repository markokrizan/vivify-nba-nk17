@extends('layout.app')

@section('content')
Title: {{ $news->title }}
<br/>
Content: {{ $news->content}}
<br/>
Created by: {{ $news->user->name }}
<br/>
This news article mentions these teams: {{ $news->teams->pluck('name')->implode(',') }}
@endsection