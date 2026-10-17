@extends('layouts.public')

@section('title', 'What We Do | Muhamadi R Charity Foundation Uganda')
@section('page-key', 'programs')

@section('content')
<section class="page-hero">
    <div class="container">
        <span class="eyebrow">What we do</span>
        <h1 class="h1">Practical support, community outreach and human dignity.</h1>
        <p class="lead">Explore the foundation's areas of work. Each published program is maintained by the foundation team and updated as verified information becomes available.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <div><span class="eyebrow">Our focus areas</span><h2 class="h2">Where compassion becomes action.</h2></div>
            <p class="lead">Our work is centered on practical needs, community participation and support delivered with dignity.</p>
        </div>

        @if($programs->isNotEmpty())
            <div class="grid-2">
                @foreach($programs as $program)
                    <article class="program-card reveal" id="{{ $program->slug }}">
                        <div class="card-media">
                            <img
                                alt="{{ $program->title }}"
                                loading="lazy"
                                src="{{ asset($program->image_path ?: 'assets/images/community-support.webp') }}"
                            >
                        </div>
                        <div class="card-body">
                            @if($program->category)
                                <span class="pill">{{ $program->category }}</span>
                            @endif
                            <h3>{{ $program->title }}</h3>
                            <p>{{ $program->summary }}</p>
                            @if($program->description)
                                <p style="margin-top:12px;white-space:pre-line">{{ $program->description }}</p>
                            @endif
                            @if(is_array($program->objectives) && count($program->objectives))
                                <h4 style="font-size:.78rem;margin:22px 0 8px">Our objectives</h4>
                                <ul class="check-list" style="margin-top:0">
                                    @foreach($program->objectives as $objective)
                                        <li>
                                            <svg fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24"><path d="m5 12 4 4L19 6"></path></svg>
                                            <span>{{ $objective }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="value-card" style="padding:36px;text-align:center">
                <h3>Program information is being prepared</h3>
                <p>Our team is preparing verified information about the foundation's current programs. Please contact us if you would like to learn more about our work.</p>
                <a class="btn btn-primary" style="margin-top:16px" href="{{ route('contact') }}">Contact the foundation</a>
            </div>
        @endif
    </div>
</section>

<section class="section bg-cream">
    <div class="container">
        <div class="section-head"><div><span class="eyebrow">Accountable action</span><h2 class="h2">Clear information. Respectful support.</h2></div></div>
        <div class="grid-4">
            <div class="value-card"><span class="pill">01</span><h3 style="margin-top:15px">Need</h3><p>Understand the community need the program is intended to address.</p></div>
            <div class="value-card"><span class="pill">02</span><h3 style="margin-top:15px">Action</h3><p>Describe the support and activities the foundation actually provides.</p></div>
            <div class="value-card"><span class="pill">03</span><h3 style="margin-top:15px">Evidence</h3><p>Share verified outcomes and stories without overstating impact.</p></div>
            <div class="value-card"><span class="pill">04</span><h3 style="margin-top:15px">Participation</h3><p>Explain how community members and supporters can get involved.</p></div>
        </div>
    </div>
</section>

<section class="section-sm">
    <div class="container"><div class="cta-panel"><div class="cta-inner">
        <div><span class="eyebrow" style="color:#b8efbd">Partner with the work</span><h2 class="h2" style="color:#fff">Let's turn shared purpose into practical support.</h2><p>For partnerships, project support or volunteering, use the contact page to start a conversation.</p></div>
        <div><a class="btn btn-primary" href="{{ route('contact') }}">Start a conversation <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14"></path><path d="m13 6 6 6-6 6"></path></svg></a></div>
    </div></div></div>
</section>
@endsection
