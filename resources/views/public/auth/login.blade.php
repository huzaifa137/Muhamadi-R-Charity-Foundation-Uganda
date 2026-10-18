@extends('layouts.public')
@section('title', 'Public Login | Muhamadi R Charity Foundation Uganda')
@section('page-key', 'login')
@section('content')
<section class="section"><div class="container auth-container"><div class="auth-card">
    <span class="eyebrow">Welcome back</span>
    <h1 class="h1">Sign in to your account</h1>
    <p class="muted">Access your public foundation account.</p>
    @if ($errors->any()) <div class="auth-error" role="alert">Please check your email and password.</div> @endif
    <form method="POST" action="{{ route('login.submit') }}" class="auth-form">
        @csrf
        <label for="email">Email address</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
        <label for="password">Password</label>
        <input id="password" name="password" type="password" autocomplete="current-password" required>
        <label class="auth-remember"><input type="checkbox" name="remember" value="1"> Keep me signed in</label>
        <button type="submit" class="btn btn-primary auth-submit">Sign in</button>
    </form>
    @if (session('status')) <div class="auth-hint" role="status">{{ session('status') }}</div> @endif
    <p class="auth-switch"><a href="{{ route('password.request') }}">Forgot your password?</a></p>
    <p class="auth-switch">New here? <a href="{{ route('register') }}">Create a public account</a></p>
    <p class="auth-admin-link">Foundation staff? <a href="{{ route('admin.login') }}">Admin / Staff login</a></p>
</div></div></section>
@endsection