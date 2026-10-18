@extends('admin.auth.layout')
@section('title', 'Forgot password')
@section('card')
<form class="login-card" method="POST" action="{{ route('admin.password.email') }}">
    @csrf
    <div class="crumb">Admin account help</div><h1>Forgot your password?</h1>
    <p class="muted mb-3">Enter your administrator email and we will send you a link to choose a new password.</p>
    <div class="field mb-3"><label>Email address</label><input type="email" name="email" value="{{ old('email') }}" autocomplete="username" placeholder="you@muhamadircharity.org" required autofocus></div>
    <button class="btn btn-primary" style="width:100%;height:50px">Send reset link</button>
    <p class="small muted mt-3" style="text-align:center"><a class="link" href="{{ route('admin.login') }}">← Back to sign in</a></p>
    @if ($errors->any())<p role="alert" class="small" style="color:#c62828;margin-top:12px">{{ $errors->first() }}</p>@endif
    @if (session('status'))<p role="status" class="small">{{ session('status') }}</p>@endif
</form>
@endsection
