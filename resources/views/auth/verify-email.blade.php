@extends('layout.app')

@section('title', 'Email not verified')

@section('content')

@if(session('message'))
    {{ session('message') }}
@else
    You need to verify your email!
@endif

<form action="/email/verification-notification" method="POST">
    @csrf
    <button type="submit">Resend email notification</button>
</form>
@endsection
