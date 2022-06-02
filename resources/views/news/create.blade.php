@extends('layout.app')

@section('title', 'Create news')

@section('content')
<form action="/news/create" method="POST">
    @csrf

    <div class="form-group">
        <label for="name">Title</label>
        <input type="text" name="title" value="{{old('title')}}" class="form-control" id="name" placeholder="Enter title"/>
        @error('title')
            <span class="form-text text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Content</label>
        <textarea name="content" value="{{old('content')}}" class="form-control" id="email" placeholder="Enter content"></textarea>
        @error('content')
            <span class="form-text text-danger">{{$message}}</span>
        @enderror
    </div>

    Teams this news is related to:  <br/>
    @foreach ($teams as $team)
        {{$team->name}} <input type="checkbox" name="teams[]" value="{{$team->id}}" />
    @endforeach
    @error('teams')
        <span class="form-text text-danger">{{$message}}</span>
    @enderror

    <br/>

    <button type="submit" class="btn btn-primary">Register</button>
</form>
@endsection
