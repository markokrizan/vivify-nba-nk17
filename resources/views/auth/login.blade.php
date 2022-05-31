@extends('layout.app')

@section('title', 'Login')

@section('content')
<form action="/login" method="POST">
    @csrf
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" required name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="Enter email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" required name="password" value="{{old('password')}}" class="form-control" id="password" placeholder="Enter password">
        @if(isset($invalid_credentials) && $invalid_credentials)
        <small class="text-danger">Invalid credentials</small>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Login</button>

    <a href="{{ url('/register') }}">Don't have an account - register</a>
</form>
@endsection
