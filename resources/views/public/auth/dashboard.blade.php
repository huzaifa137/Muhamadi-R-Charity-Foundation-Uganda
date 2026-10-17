@extends('layouts.public')
@section('title', 'My Dashboard | Muhamadi R Charity Foundation Uganda')
@section('page-key', 'dashboard')
@section('content')
<section class="page-hero"><div class="container">
    <span class="eyebrow">Public account</span>
    <h1 class="h1">Welcome, {{ Auth::user()->name }}</h1>
    <p class="lead">You are signed in to your foundation account.</p>
</div></section>
<section class="section"><div class="container"><div class="auth-card auth-dashboard-card">
    <h2>Account details</h2>
    <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
    <form method="POST" action="{{ route('logout') }}">@csrf
        <button type="submit" class="btn btn-primary">Sign out</button>
    </form>
</div></div></section>
@endsection