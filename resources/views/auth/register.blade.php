@extends('layout.app')

@section('title', 'Register')

@section('content')
<form action="/register" method="POST">
    @csrf

    {{-- Debug errors --}}
    {{ json_encode($errors->all()) }}

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Enter name">
        @error('name')
            <span class="form-text text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="Enter email">
        @error('email')
            <span class="form-text text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" value="{{old('password')}}" class="form-control" id="password" placeholder="Enter password">
        @error('password')
            <span class="form-text text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm your password</label>
        <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}" class="form-control" id="password_confirmation" placeholder="Enter password">
        @error('password_confirmation')
            <span class="form-text text-danger">{{$message}}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Register</button>
</form>
@endsection