@extends('layouts.public')
@section('title', 'Reset Password | Muhamadi R Charity Foundation Uganda')
@section('page-key', 'login')
@section('content')
<section class="section"><div class="container auth-container"><div class="auth-card">
    <span class="eyebrow">Account help</span>
    <h1 class="h1">Choose a new password</h1>
    @if ($errors->any()) <div class="auth-error" role="alert">{{ $errors->first() }}</div> @endif
    <form method="POST" action="{{ route('password.update') }}" class="auth-form">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <label for="email">Email address</label>
        <input id="email" name="email" type="email" value="{{ old('email', $email) }}" autocomplete="email" required>
        <label for="password">New password</label>
        <input id="password" name="password" type="password" autocomplete="new-password" required minlength="4">
        <span class="auth-hint">Use at least 4 characters.</span>
        <label for="password_confirmation">Confirm new password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required minlength="4">
        <button type="submit" class="btn btn-primary auth-submit">Reset password</button>
    </form>
</div></div></section>
@endsection
