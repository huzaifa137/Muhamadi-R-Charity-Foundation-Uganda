<!doctype html>
<html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Muhamadi R Charity Foundation Uganda — community-centered charitable support, outreach and human dignity.">
<meta name="theme-color" content="#075a35"><meta property="og:type" content="website">
<meta property="og:title" content="Muhamadi R Charity Foundation Uganda"><meta property="og:description" content="Building practical pathways to hope, dignity and stronger communities.">
<meta property="og:image" content="{{ asset('assets/images/hero-community.webp') }}"><link rel="icon" href="{{ asset('assets/images/favicon.webp') }}">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}"><title>@yield('title', 'Muhamadi R Charity Foundation Uganda')</title>@stack('styles')
</head><body data-page="@yield('page-key', 'home')">
@include('components.shared.public-header')
<main>@yield('content')</main>
@include('components.shared.public-footer')
<script src="{{ asset('js/gallery-data.js') }}"></script><script src="{{ asset('js/main.js') }}"></script>@stack('scripts')
</body></html>