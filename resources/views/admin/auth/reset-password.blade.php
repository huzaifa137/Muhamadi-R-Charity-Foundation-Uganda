@extends('admin.auth.layout')
@section('title', 'Reset password')
@section('card')
<form class="login-card" method="POST" action="{{ route('admin.password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="crumb">Admin account help</div><h1>Choose a new password</h1>
    <p class="muted mb-3">Use at least 4 characters.</p>
    <div class="field mb-2"><label>Email address</label><input type="email" name="email" value="{{ old('email', $email) }}" autocomplete="username" required></div>
    <div class="field mb-2"><label>New password</label><input type="password" name="password" autocomplete="new-password" required minlength="4"></div>
    <div class="field mb-3"><label>Confirm new password</label><input type="password" name="password_confirmation" autocomplete="new-password" required minlength="4"></div>
    <button class="btn btn-primary" style="width:100%;height:50px">Reset password</button>
    <p class="small muted mt-3" style="text-align:center"><a class="link" href="{{ route('admin.login') }}">← Back to sign in</a></p>
    @if ($errors->any())<p role="alert" class="small" style="color:#c62828;margin-top:12px">{{ $errors->first() }}</p>@endif
</form>
@endsection
