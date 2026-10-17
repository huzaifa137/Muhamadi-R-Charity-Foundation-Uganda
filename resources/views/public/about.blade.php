@extends('layouts.public')

@section('title', 'About Us | Muhamadi R Charity Foundation Uganda')
@section('page-key', 'about')

@section('content')
<section class="page-hero">
    <div class="container">
        <span class="eyebrow">{{ $about->hero_eyebrow }}</span>
        <h1 class="h1">{{ $about->hero_heading }}</h1>
        <p class="lead">{{ $about->hero_intro }}</p>
    </div>
</section>

<section class="section">
    <div class="container intro-grid">
        <div class="reveal">
            <span class="eyebrow">Who we are</span>
            <h2 class="h2">{{ $about->intro_heading }}</h2>
            <p class="lead">{{ $about->intro_body }}</p>
            @if($about->intro_supporting)
                <p class="muted">{{ $about->intro_supporting }}</p>
            @endif
        </div>
        <div class="image-stack reveal delay-1">
            <div class="image-main"><img alt="Foundation community" src="{{ asset($about->hero_image_path ?: 'assets/images/hero-community.webp') }}"></div>
            <div class="image-small"><img alt="Community project setting" loading="lazy" src="{{ asset($about->intro_image_path ?: 'assets/images/project.webp') }}"></div>
            <div class="image-tag">Uganda • Community • Service</div>
        </div>
    </div>
</section>

<section class="section bg-cream">
    <div class="container">
        <div class="section-head"><div><span class="eyebrow">Our purpose</span><h2 class="h2">A purpose grounded in dignity.</h2></div></div>
        <div class="grid-2">
            <article class="value-card reveal">
                <div class="value-icon"><svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M20.8 8.8c0 5.2-8.8 10.3-8.8 10.3S3.2 14 3.2 8.8A4.6 4.6 0 0 1 12 6.5a4.6 4.6 0 0 1 8.8 2.3Z"></path></svg></div>
                <h3>Mission</h3><p>{{ $about->mission }}</p>
            </article>
            <article class="value-card reveal delay-1">
                <div class="value-icon"><svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"></circle><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"></path></svg></div>
                <h3>Vision</h3><p>{{ $about->vision }}</p>
            </article>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head"><div><span class="eyebrow">Our values</span><h2 class="h2">Principles that shape the work.</h2></div></div>
        <div class="grid-4">
            @foreach(($about->values ?? []) as $index => $value)
                <article class="value-card reveal">
                    <div class="value-icon"><svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M12 3 20 6v5c0 5.2-3.4 8.6-8 10-4.6-1.4-8-4.8-8-10V6l8-3Z"></path><path d="m8.5 12 2.2 2.2 4.8-5"></path></svg></div>
                    <h3>{{ $value['title'] ?? '' }}</h3>
                    <p>{{ $value['description'] ?? '' }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section bg-cream">
    <div class="container grid-2">
        <div class="reveal">
            <span class="eyebrow">Our approach</span>
            <h2 class="h2">{{ $about->approach_heading }}</h2>
            <p class="muted">{{ $about->approach_intro }}</p>
            <ul class="check-list">
                @foreach(($about->approach_steps ?? []) as $step)
                    <li><svg fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24"><path d="m5 12 4 4L19 6"></path></svg><span><strong>{{ $step['title'] ?? '' }}:</strong> {{ $step['description'] ?? '' }}</span></li>
                @endforeach
            </ul>
        </div>
        <div class="timeline reveal delay-1">
            @foreach(($about->approach_steps ?? []) as $index => $step)
                <div class="timeline-item"><div class="timeline-dot"></div><div class="timeline-content"><span class="pill">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }} • {{ $step['title'] ?? '' }}</span><p style="margin-top:9px">{{ $step['description'] ?? '' }}</p></div></div>
            @endforeach
        </div>
    </div>
</section>

<section class="section-sm">
    <div class="container"><div class="cta-panel"><div class="cta-inner">
        <div><span class="eyebrow" style="color:#b8efbd">Get involved</span><h2 class="h2" style="color:#fff">Help turn shared purpose into practical support.</h2><p>For partnerships, volunteering or support, contact the foundation to begin a conversation.</p></div>
        <div class="cta-actions"><a class="btn btn-primary" href="{{ route('contact') }}">Contact the foundation <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14"></path><path d="m13 6 6 6-6 6"></path></svg></a></div>
    </div></div></div>
</section>
@endsection
