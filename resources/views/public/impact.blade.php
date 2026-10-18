@extends('layouts.public')

@section('title', 'Our Impact | Muhamadi R Charity Foundation Uganda')
@section('page-key', 'impact')

@section('content')

<section class="page-hero">
<div class="container"><span class="eyebrow">Our impact</span>
<h1 class="h1">{{ $page->hero_heading ?: 'Make the impact visible. Keep the evidence honest.' }}</h1>
<p class="lead">{{ $page->hero_intro ?: 'This page is designed for verified figures, project records and community stories. No statistics are presented as fact until the organization supplies and approves them.' }}</p>
</div>
</section>
<section class="stats-band">
<div class="container stats-grid">
<div class="stat">
<div class="stat-number">1000+</div>
<div class="stat-label">People reached</div>
</div>
<div class="stat">
<div class="stat-number">400+</div>
<div class="stat-label">Families supported</div>
</div>
<div class="stat">
<div class="stat-number">500+</div>
<div class="stat-label">Communities served</div>
</div>
<div class="stat">
<div class="stat-number">10+</div>
<div class="stat-label">Years / initiatives</div>
</div>
</div>
</section>
<section class="section">
<div class="container">
<div class="section-head">
<div><span class="eyebrow">Impact framework</span>
<h2 class="h2">From activity to evidence.</h2>
</div>
<p class="lead">A future impact report can connect resources, activities, outputs and longer-term outcomes
            without overstating what the evidence shows.</p>
</div>
<div class="process">
<div class="process-item">
<div class="process-no">01</div>
<h3>Need</h3>
<p>Document the problem and who is affected.</p>
</div>
<div class="process-item">
<div class="process-no">02</div>
<h3>Action</h3>
<p>Record what support or activity took place.</p>
</div>
<div class="process-item">
<div class="process-no">03</div>
<h3>Reach</h3>
<p>Track verified people, households or communities reached.</p>
</div>
<div class="process-item">
<div class="process-no">04</div>
<h3>Outcome</h3>
<p>Describe changes supported by credible evidence.</p>
</div>
<div class="process-item">
<div class="process-no">05</div>
<h3>Learn</h3>
<p>Use findings to improve future work.</p>
</div>
</div>
</div>
</section>
<section class="section bg-cream">
<div class="container">
<div class="section-head">
<div><span class="eyebrow">Stories from the field</span>
<h2 class="h2">Evidence also has a human voice.</h2>
</div>
</div>
<div class="grid-3">
<article class="story-card reveal">
<div class="card-media"><img alt="Community gathering" loading="lazy" src="{{ asset('assets/images/community-group.webp') }}"/></div>
<div class="card-body">
<div class="story-meta"><span>Field note</span><span class="dot"></span><span>Date to add</span></div>
<h3>Community comes together</h3>
<p>A visual record of people gathering, participating and sharing a common community space.</p>
</div>
</article>
<article class="story-card reveal delay-1">
<div class="card-media"><img alt="Community support activity" loading="lazy" src="{{ asset('assets/images/support-action.webp') }}"/></div>
<div class="card-body">
<div class="story-meta"><span>Field note</span><span class="dot"></span><span>Date to add</span></div>
<h3>Practical support in action</h3>
<p>Photographs document hands-on support and community engagement around practical needs.</p>
</div>
</article>
<article class="story-card reveal delay-2">
<div class="card-media"><img alt="Women participating in a community activity" loading="lazy" src="{{ asset('assets/images/women-community.webp') }}"/></div>
<div class="card-body">
<div class="story-meta"><span>Field note</span><span class="dot"></span><span>Date to add</span></div>
<h3>Participation matters</h3>
<p>A reminder that meaningful community work is strengthened when people participate and are seen.</p>
</div>
</article>
</div>
</div>
</section>
<section class="section">
<div class="container grid-2">
<div class="reveal"><span class="eyebrow">Ready for real reporting</span>
<h2 class="h2">Turn this page into an annual impact report.</h2>
<p class="muted">Add verified totals, project locations, beneficiary definitions, dates, methodology, stories
            and approved testimonials. The structure is ready to hold them.</p><a class="btn btn-dark" href="{{ route('contact') }}">Send verified information <svg class="" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M5 12h14"></path>
<path d="m13 6 6 6-6 6"></path>
</svg></a>
</div>
<div class="form-card reveal delay-1">
<h3>Impact data checklist</h3>
<table class="mini-table">
<tr>
<th>Data point</th>
<th>Status</th>
</tr>
<tr>
<td>People reached</td>
<td>1000+</td>
</tr>
<tr>
<td>Families supported</td>
<td>400+</td>
</tr>
<tr>
<td>Communities served</td>
<td>500+</td>
</tr>
<tr>
<td>Projects / initiatives</td>
<td>10+</td>
</tr>
<tr>
<td>Testimonials</td>
<td>Supply approved quotes</td>
</tr>
</table>
</div>
</div>
</section>

@include('public.page-content-sections')

@endsection
