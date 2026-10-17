@extends('layouts.public')
@section('title', 'Create Account | Muhamadi R Charity Foundation Uganda')
@section('page-key', 'register')
@section('content')
<section class="section"><div class="container auth-container"><div class="auth-card">
    <span class="eyebrow">Join our community</span>
    <h1 class="h1">Create your account</h1>
    @if ($errors->any()) <div class="auth-error" role="alert">Please correct the information below.</div> @endif
    <form method="POST" action="{{ route('register.submit') }}" class="auth-form">
        @csrf
        <label for="name">Full name</label>
        <input id="name" name="name" value="{{ old('name') }}" autocomplete="name" maxlength="120" required>
        @error('name') <span class="auth-field-error">{{ $message }}</span> @enderror
        <label for="email">Email address</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required>
        @error('email') <span class="auth-field-error">{{ $message }}</span> @enderror
        <label for="password">Password</label>
        <input id="password" name="password" type="password" autocomplete="new-password" required>
        <span class="auth-hint">Use at least 8 characters.</span>
        @error('password') <span class="auth-field-error">{{ $message }}</span> @enderror
        <label for="password_confirmation">Confirm password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required>
        <button type="submit" class="btn btn-primary auth-submit">Create account</button>
    </form>
    <p class="auth-switch">Already registered? <a href="{{ route('login') }}">Sign in</a></p>
    <p class="auth-admin-link">Foundation staff? <a href="{{ route('admin.login') }}">Admin / Staff login</a></p>
</div></div></section>
@endsection