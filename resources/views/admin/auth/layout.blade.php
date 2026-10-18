<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="robots" content="noindex,nofollow">
<title>@yield('title') · Admin | Muhamadi R Charity Foundation Uganda</title>
<link rel="icon" href="{{ asset('assets/images/favicon.webp') }}">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('admin-static/css/admin.css') }}">
</head>
<body>
<svg width="0" height="0" style="position:absolute" aria-hidden="true"><symbol id="i-eye" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></symbol><symbol id="i-lock" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></symbol><symbol id="i-mail" viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 6l-10 7L2 6"/></symbol><symbol id="i-shield" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></symbol></svg>
<div class="login">
  <section class="login-art">
    <a class="row" href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.webp') }}" alt="Logo" style="width:54px;height:54px;border-radius:50%;box-shadow:0 0 0 3px rgba(255,255,255,.15)"><span><b style="display:block;font-size:1rem">Muhamadi R Charity Foundation</b><small style="letter-spacing:.14em;text-transform:uppercase;font-size:.62rem;color:#9fe5a7;font-weight:800">Uganda · Admin Console</small></span></a>
    <div><h2>Manage the work. Share the story.</h2><p>Update your website, track donations, welcome volunteers and keep supporters informed, all from one secure place.</p></div>
    <div class="row" style="gap:22px;font-size:.78rem;color:rgba(255,255,255,.7);font-weight:700"><span class="row" style="gap:8px"><svg class="i i-sm"><use href="#i-shield"/></svg>Secure sign-in</span><span>© 2026 Muhamadi R Charity Foundation Uganda</span></div>
  </section>
  <section class="login-form">@yield('card')</section>
</div>
</body>
</html>
