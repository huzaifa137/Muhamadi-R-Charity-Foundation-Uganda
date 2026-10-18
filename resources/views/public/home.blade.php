@extends('layouts.public')

@section('title', 'Home | Muhamadi R Charity Foundation Uganda')
@section('page-key', 'home')

@section('content')

<section class="hero">
<div class="hero-media"><img alt="Community members gathered together during a foundation field activity" src="{{ asset('assets/images/hero-community.webp') }}"/></div>
<div class="hero-overlay"></div>
<div class="container hero-content">
<span class="eyebrow">Muhamadi R Charity Foundation Uganda</span>
<h1 class="display">{{ $page->hero_heading ?: 'Compassion in action. Hope in community.' }}</h1>
<p class="lead">{{ $page->hero_intro ?: 'We are committed to community-centered support that protects dignity, responds to practical needs and helps people move forward with hope.' }}</p>
<div class="hero-actions">
<a class="btn btn-primary" href="{{ route('get-involved') }}">Support Our Work <svg class="" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14"></path><path d="m13 6 6 6-6 6"></path></svg></a>
<a class="btn btn-outline" href="{{ route('programs') }}" style="background:rgba(255,255,255,.08);border-color:rgba(255,255,255,.3);color:#fff">Explore Our Work <svg class="" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14"></path><path d="m13 6 6 6-6 6"></path></svg></a>
</div>
<div class="hero-meta">
<div class="meta-chip"><strong>01</strong><span>People first</span></div>
<div class="meta-chip"><strong>02</strong><span>Community centered</span></div>
<div class="meta-chip"><strong>03</strong><span>Dignity driven</span></div>
</div>
</div>
<a class="hero-scroll" href="#who-we-are">Scroll to explore</a>
</section>
<section class="trust-strip">
<div class="container trust-grid">
<div class="trust-item"><div class="trust-icon"><svg class="" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24"><path d="M20.8 8.8c0 5.2-8.8 10.3-8.8 10.3S3.2 14 3.2 8.8A4.6 4.6 0 0 1 12 6.5a4.6 4.6 0 0 1 8.8 2.3Z"></path></svg></div><div><strong>Compassion</strong><span>Human needs at the center</span></div></div>
<div class="trust-item"><div class="trust-icon"><svg class="" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"></path><circle cx="9.5" cy="7" r="4"></circle><path d="M17 3.5a4 4 0 0 1 0 7.8M21 21v-2a4 4 0 0 0-3-3.9"></path></svg></div><div><strong>Community</strong><span>Local relationships matter</span></div></div>
<div class="trust-item"><div class="trust-icon"><svg class="" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24"><path d="M12 3 20 6v5c0 5.2-3.4 8.6-8 10-4.6-1.4-8-4.8-8-10V6l8-3Z"></path><path d="m8.5 12 2.2 2.2 4.8-5"></path></svg></div><div><strong>Accountability</strong><span>Transparent, responsible action</span></div></div>
<div class="trust-item"><div class="trust-icon"><svg class="" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24"><path d="M20.5 3.5C12 3.7 5 6.3 5 13.5c0 3.8 2.6 6 6 6 7.2 0 9.8-7 10-15.5Z"></path><path d="M4 21c2.5-5.3 6.1-8.9 11.5-11.5"></path></svg></div><div><strong>Long-term hope</strong><span>Support that can grow with communities</span></div></div>
</div>
</section>
<section aria-label="Muhamadi R Charity Foundation field activities" class="home-carousel">
<div class="container">
<div class="carousel-head reveal">
<div>
<span class="eyebrow">In the community</span>
<h2 class="h2">People, action and hope in motion.</h2>
</div>
<p class="lead">A glimpse of the people and community-centered work represented in the foundation's field photographs.</p>
</div>
<div class="image-carousel" data-carousel="" tabindex="0">
<div class="carousel-track">
<article class="carousel-slide is-active">
<img alt="Community members gathered during a foundation activity" loading="lazy" src="{{ asset('assets/images/community-support.webp') }}"/>
<div class="carousel-caption">
<span class="pill">Community</span>
<h3>Support begins with people.</h3>
<p>Creating space for practical support, connection and dignity within the community.</p>
</div>
</article>
<article class="carousel-slide">
<img alt="Food and essential support activity" loading="lazy" src="{{ asset('assets/images/food-support.webp') }}"/>
<div class="carousel-caption">
<span class="pill">Essential support</span>
<h3>Responding to practical needs.</h3>
<p>Meeting immediate needs with care, respect and a human-centered approach.</p>
</div>
</article>
<article class="carousel-slide">
<img alt="Women participating in a community activity" loading="lazy" src="{{ asset('assets/images/women-community.webp') }}"/>
<div class="carousel-caption">
<span class="pill">Community voice</span>
<h3>Participation strengthens communities.</h3>
<p>Encouraging people to be part of the conversations and actions that shape support.</p>
</div>
</article>
<article class="carousel-slide">
<img alt="People participating in community field work" loading="lazy" src="{{ asset('assets/images/field-work.webp') }}"/>
<div class="carousel-caption">
<span class="pill">Field work</span>
<h3>Turning compassion into action.</h3>
<p>Working alongside communities through practical, responsive and respectful support.</p>
</div>
</article>
</div>
<button aria-label="Previous image" class="carousel-arrow carousel-prev" type="button">
<svg fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><path d="m15 18-6-6 6-6"></path></svg>
</button>
<button aria-label="Next image" class="carousel-arrow carousel-next" type="button">
<svg fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><path d="m9 18 6-6-6-6"></path></svg>
</button>
<div aria-label="Choose a slide" class="carousel-dots">
<button aria-current="true" aria-label="Show slide 1" class="carousel-dot is-active" type="button"></button>
<button aria-label="Show slide 2" class="carousel-dot" type="button"></button>
<button aria-label="Show slide 3" class="carousel-dot" type="button"></button>
<button aria-label="Show slide 4" class="carousel-dot" type="button"></button>
</div>
</div>
</div>
</section>
<section class="section" id="who-we-are">
<div class="container intro-grid">
<div class="image-stack reveal">
<div class="image-main"><img alt="Community gathering in Uganda" src="{{ asset('assets/images/community-support.webp') }}"/></div>
<div class="image-small"><img alt="Children participating in a community activity" loading="lazy" src="{{ asset('assets/images/children.webp') }}"/></div>
<div class="image-tag">Real people. Real communities. Real work.</div>
</div>
<div class="reveal delay-1">
<span class="eyebrow">Who we are</span>
<h2 class="h2">A charity built around people, not statistics.</h2>
<p class="lead">Muhamadi R Charity Foundation Uganda works from a simple conviction: practical support is most meaningful when it protects dignity and responds to the realities people face.</p>
<p class="muted">The supplied field photographs show community gatherings, food and essential support, outreach and people working together. The website therefore presents the organization through a broad, factually safe lens rather than inventing projects, partnerships or achievements that have not yet been documented.</p>
<ul class="check-list">
<li><svg class="" fill="none" stroke="currentColor" stroke-width="2.3" viewbox="0 0 24 24"><path d="m5 12 4 4L19 6"></path></svg> <span>Listen to community needs before shaping support.</span></li>
<li><svg class="" fill="none" stroke="currentColor" stroke-width="2.3" viewbox="0 0 24 24"><path d="m5 12 4 4L19 6"></path></svg> <span>Deliver assistance with dignity and respect.</span></li>
<li><svg class="" fill="none" stroke="currentColor" stroke-width="2.3" viewbox="0 0 24 24"><path d="m5 12 4 4L19 6"></path></svg> <span>Build relationships that can strengthen local action.</span></li>
</ul>
<div style="margin-top:28px"><a class="btn btn-dark" href="{{ route('about') }}">Discover our story <svg class="" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14"></path><path d="m13 6 6 6-6 6"></path></svg></a></div>
</div>
</div>
</section>
<section class="section bg-cream">
<div class="container">
<div class="section-head reveal">
<div><span class="eyebrow">What we do</span><h2 class="h2">Practical support with a human face.</h2></div>
<p class="lead">Broad areas of work reflected in the supplied materials. Exact program names, locations and objectives can be refined as official information is added.</p>
</div>
<div class="grid-4">
<article class="program-card reveal"><div class="card-media"><img alt="Food and essential support activity" loading="lazy" src="{{ asset('assets/images/food-support.webp') }}"/></div><div class="card-body"><span class="pill">Focus area</span><h3>Food &amp; Essential Support</h3><p>Responding to practical needs with care, respect and community participation.</p><a class="card-link" href="{{ route('programs') }}"#essential-support>Explore focus area <svg class="" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14"></path><path d="m13 6 6 6-6 6"></path></svg></a></div></article>
<article class="program-card reveal delay-1"><div class="card-media"><img alt="Children in a community setting" loading="lazy" src="{{ asset('assets/images/children.webp') }}"/></div><div class="card-body"><span class="pill">Focus area</span><h3>Children &amp; Families</h3><p>Keeping children and families visible within community-centered support efforts.</p><a class="card-link" href="{{ route('programs') }}"#children-families>Explore focus area <svg class="" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14"></path><path d="m13 6 6 6-6 6"></path></svg></a></div></article>
<article class="program-card reveal delay-2"><div class="card-media"><img alt="Community outreach activity" loading="lazy" src="{{ asset('assets/images/outreach.webp') }}"/></div><div class="card-body"><span class="pill">Focus area</span><h3>Community Outreach</h3><p>Connecting with people where they are and creating space for shared action.</p><a class="card-link" href="{{ route('programs') }}"#outreach>Explore focus area <svg class="" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14"></path><path d="m13 6 6 6-6 6"></path></svg></a></div></article>
<article class="program-card reveal delay-3"><div class="card-media"><img alt="People participating in field work" loading="lazy" src="{{ asset('assets/images/field-work.webp') }}"/></div><div class="card-body"><span class="pill">Focus area</span><h3>Community Development</h3><p>Supporting practical, community-led efforts that can contribute to stronger local resilience.</p><a class="card-link" href="{{ route('programs') }}"#development>Explore focus area <svg class="" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14"></path><path d="m13 6 6 6-6 6"></path></svg></a></div></article>
</div>
</div>
</section>
<section class="stats-band">
<div class="container stats-grid">
<div class="stat reveal">
<div class="stat-number">1000+</div>
<div class="stat-label">People reached</div>
</div>
<div class="stat reveal delay-1">
<div class="stat-number">400+</div>
<div class="stat-label">Families supported</div>
</div>
<div class="stat reveal delay-2">
<div class="stat-number">500+</div>
<div class="stat-label">Communities served</div>
</div>
<div class="stat reveal delay-3">
<div class="stat-number">10+</div>
<div class="stat-label">Projects / initiatives</div>
</div>
</div>
</section>
<section class="section">
<div class="container">
<div class="section-head reveal">
<div><span class="eyebrow">Our field work</span><h2 class="h2">The story is in the people.</h2></div>
<a class="btn btn-outline" href="{{ route('gallery') }}">View full gallery <svg class="" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14"></path><path d="m13 6 6 6-6 6"></path></svg></a>
</div>
<div class="editorial">
<article class="editorial-main reveal"><img alt="Large community gathering" loading="lazy" src="{{ asset('assets/images/community-group.webp') }}"/><div class="editorial-copy"><span class="pill" style="background:rgba(255,255,255,.14);color:#fff">Field story</span><h3 style="font-size:clamp(1.6rem,3vw,2.6rem);margin:10px 0">Community is where meaningful support begins.</h3><p style="color:rgba(255,255,255,.78);max-width:650px;margin:0">From gatherings and outreach to practical assistance, the supplied photographs show people coming together around shared needs and shared humanity.</p></div></article>
<div class="editorial-side">
<article class="editorial-mini reveal delay-1"><img alt="Community support activity" loading="lazy" src="{{ asset('assets/images/support-action.webp') }}"/><div>Support that meets people where they are.</div></article>
<article class="editorial-mini reveal delay-2"><img alt="Women participating in a community activity" loading="lazy" src="{{ asset('assets/images/women-community.webp') }}"/><div>Participation, dignity and community voice.</div></article>
</div>
</div>
</div>
</section>
<section class="section bg-cream">
<div class="container">
<div class="section-head reveal">
<div><span class="eyebrow">How we make a difference</span><h2 class="h2">A simple, accountable way of working.</h2></div>
<p class="lead">A clear framework for turning compassion into practical community support.</p>
</div>
<div class="process">
<div class="process-item reveal"><div class="process-no">01</div><h3>Listen</h3><p>Understand the needs and priorities people identify.</p></div>
<div class="process-item reveal delay-1"><div class="process-no">02</div><h3>Mobilize</h3><p>Bring people, resources and relationships together.</p></div>
<div class="process-item reveal delay-2"><div class="process-no">03</div><h3>Respond</h3><p>Deliver practical support with dignity and care.</p></div>
<div class="process-item reveal delay-3"><div class="process-no">04</div><h3>Empower</h3><p>Create room for participation, agency and local action.</p></div>
<div class="process-item reveal"><div class="process-no">05</div><h3>Learn</h3><p>Document what works and improve future support.</p></div>
</div>
</div>
</section>
<section class="section">
<div class="container">
<div class="grid-2">
<div class="quote reveal"><div class="quote-mark">“</div><p>Service becomes meaningful when people are treated not as numbers, but as neighbors whose dignity matters.</p></div>
<div class="reveal delay-1" style="display:flex;flex-direction:column;justify-content:center"><span class="eyebrow">Get involved</span><h2 class="h2">There is a place for you in the work.</h2><p class="lead">Whether you want to support a community initiative, volunteer time, explore a partnership or simply help amplify the mission, start the conversation.</p><div style="margin-top:20px"><a class="btn btn-primary" href="{{ route('get-involved') }}">Explore ways to help <svg class="" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14"></path><path d="m13 6 6 6-6 6"></path></svg></a></div></div>
</div>
</div>
</section>
<section class="section-sm">
<div class="container">
<div class="cta-panel reveal"><div class="cta-inner"><div><span class="eyebrow" style="color:#b8efbd">Take the next step</span><h2 class="h2" style="color:#fff;margin-bottom:8px">Together, practical support can become lasting hope.</h2><p>Use the contact page to start a conversation. Donation details, official addresses and verified organizational information can be added as they become available.</p></div><div class="cta-actions"><a class="btn btn-primary" href="{{ route('contact') }}">Contact Us <svg class="" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14"></path><path d="m13 6 6 6-6 6"></path></svg></a><a class="btn btn-outline" href="{{ route('get-involved') }}">Get Involved</a></div></div></div>
</div>
</section>

@include('public.page-content-sections')

@endsection
