@extends('layouts.public')
@section('title', 'Forgot Password | Muhamadi R Charity Foundation Uganda')
@section('page-key', 'login')
@section('content')
<section class="section"><div class="container auth-container"><div class="auth-card">
    <span class="eyebrow">Account help</span>
    <h1 class="h1">Forgot your password?</h1>
    <p class="muted">Enter your email address and we will send you a link to choose a new password.</p>
    @if (session('status')) <div class="auth-hint" role="status">{{ session('status') }}</div> @endif
    @if ($errors->any()) <div class="auth-error" role="alert">{{ $errors->first() }}</div> @endif
    <form method="POST" action="{{ route('password.email') }}" class="auth-form">
        @csrf
        <label for="email">Email address</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
        <button type="submit" class="btn btn-primary auth-submit">Send reset link</button>
    </form>
    <p class="auth-switch"><a href="{{ route('login') }}">Back to sign in</a></p>
</div></div></section>
@endsection
