@extends('layouts.public')

@section('title', 'Get Involved | Muhamadi R Charity Foundation Uganda')
@section('page-key', 'get-involved')

@section('content')
@if(session('status'))<div class="container" style="padding-top:18px"><div class="notice" role="status">{{ session('status') }}</div></div>@endif
@if($errors->any())<div class="container" style="padding-top:18px"><div class="notice" role="alert">@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div></div>@endif

<section class="page-hero">
<div class="container"><span class="eyebrow">Get involved</span>
<h1 class="h1">{{ $page->hero_heading ?: 'Support the work in a way that fits you.' }}</h1>
<p class="lead">{{ $page->hero_intro ?: 'Donate, volunteer, partner or help amplify the mission. The structures below use clearly marked placeholders wherever official payment or organizational details are not yet available.' }}</p>
</div>
</section>
<section class="section" id="donate">
<div class="container grid-2">
<div class="reveal"><span class="eyebrow">Donate / support</span>
<h2 class="h2">Make practical support possible.</h2>
<p class="lead">Your support can help the foundation respond to identified community needs. Official donation
            channels should be inserted here once confirmed.</p>
</div>
<div class="form-card reveal delay-1">
<h3>Donation details — editable</h3>
<div class="check-list">
<li><svg class="" fill="none" stroke="currentColor" stroke-width="2.3" viewbox="0 0 24 24">
<path d="m5 12 4 4L19 6"></path>
</svg> <span><strong>Mobile Money:</strong> [ADD VERIFIED NUMBER / ACCOUNT NAME]</span></li>
<li><svg class="" fill="none" stroke="currentColor" stroke-width="2.3" viewbox="0 0 24 24">
<path d="m5 12 4 4L19 6"></path>
</svg> <span><strong>Bank:</strong> [ADD VERIFIED BANK DETAILS]</span></li>
<li><svg class="" fill="none" stroke="currentColor" stroke-width="2.3" viewbox="0 0 24 24">
<path d="m5 12 4 4L19 6"></path>
</svg> <span><strong>International giving:</strong> [ADD VERIFIED METHOD]</span></li>
<li><svg class="" fill="none" stroke="currentColor" stroke-width="2.3" viewbox="0 0 24 24">
<path d="m5 12 4 4L19 6"></path>
</svg> <span><strong>Donation instructions:</strong> [ADD APPROVED INSTRUCTIONS]</span></li>
</div>
<p class="form-note" style="margin-top:20px">To replace the bracketed text before publishing donation
            instructions.</p>
</div>
</div>
</section>
<section class="section bg-cream" id="volunteer">
<div class="container">
<div class="section-head">
<div><span class="eyebrow">Volunteer</span>
<h2 class="h2">Give your time, skills or energy.</h2>
</div>
<p class="lead">Volunteer opportunities can be published here once the foundation defines current needs,
            safeguarding requirements and application steps.</p>
</div>
<div class="grid-3">
<div class="value-card">
<div class="value-icon"><svg class="" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24">
<path d="M16 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"></path>
<circle cx="9.5" cy="7" r="4"></circle>
<path d="M17 3.5a4 4 0 0 1 0 7.8M21 21v-2a4 4 0 0 0-3-3.9"></path>
</svg></div>
<h3>Community activities</h3>
<p>Support approved outreach, community events and practical activities.</p>
</div>
<div class="value-card">
<div class="value-icon"><svg class="" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24">
<path d="M20.5 3.5C12 3.7 5 6.3 5 13.5c0 3.8 2.6 6 6 6 7.2 0 9.8-7 10-15.5Z"></path>
<path d="M4 21c2.5-5.3 6.1-8.9 11.5-11.5"></path>
</svg></div>
<h3>Skills &amp; expertise</h3>
<p>Offer professional, creative or technical skills that strengthen the work.</p>
</div>
<div class="value-card">
<div class="value-icon"><svg class="" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24">
<path d="M20.8 8.8c0 5.2-8.8 10.3-8.8 10.3S3.2 14 3.2 8.8A4.6 4.6 0 0 1 12 6.5a4.6 4.6 0 0 1 8.8 2.3Z"></path>
</svg></div>
<h3>Advocacy &amp; awareness</h3>
<p>Help share verified stories and opportunities with your networks.</p>
</div>
</div>
<div style="margin-top:28px"><a class="btn btn-dark" href="{{ route('contact') }}">Ask about volunteering <svg class="" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M5 12h14"></path>
<path d="m13 6 6 6-6 6"></path>
</svg></a></div>
</div>
</section>
<section class="section" id="partner">
<div class="container intro-grid">
<div class="image-stack reveal">
<div class="image-main"><img alt="Community outreach activity" src="{{ asset('assets/images/outreach.webp') }}"/></div>
<div class="image-small"><img alt="Community group" loading="lazy" src="{{ asset('assets/images/community-group.webp') }}"/>
</div>
<div class="image-tag">Partnership starts with a conversation.</div>
</div>
<div class="reveal delay-1"><span class="eyebrow">Partner with us</span>
<h2 class="h2">Build practical collaboration around real community needs.</h2>
<p class="muted">Organizations, companies, institutions and individuals can explore collaboration through
            project support, technical expertise, resources, communications or other agreed forms of assistance.</p>
<ul class="check-list">
<li><svg class="" fill="none" stroke="currentColor" stroke-width="2.3" viewbox="0 0 24 24">
<path d="m5 12 4 4L19 6"></path>
</svg> <span>Share your area of interest and what you can contribute.</span></li>
<li><svg class="" fill="none" stroke="currentColor" stroke-width="2.3" viewbox="0 0 24 24">
<path d="m5 12 4 4L19 6"></path>
</svg> <span>Discuss community needs and appropriate scope.</span></li>
<li><svg class="" fill="none" stroke="currentColor" stroke-width="2.3" viewbox="0 0 24 24">
<path d="m5 12 4 4L19 6"></path>
</svg> <span>Agree on roles, expectations and reporting.</span></li>
</ul>
<div style="margin-top:28px"><a class="btn btn-primary" href="{{ route('contact') }}">Discuss a partnership <svg class="" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M5 12h14"></path>
<path d="m13 6 6 6-6 6"></path>
</svg></a></div>
</div>
</div>
</section>
<section class="section-sm">
<div class="container">
<div class="cta-panel">
<div class="cta-inner">
<div><span class="eyebrow" style="color:#b8efbd">Fundraise / campaign</span>
<h2 class="h2" style="color:#fff">Support a cause you can explain clearly.</h2>
<p>Campaign pages can be added when a specific, verified fundraising need and target have been approved by
                the foundation.</p>
</div><a class="btn btn-primary" href="{{ route('contact') }}">Discuss a campaign <svg class="" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M5 12h14"></path>
<path d="m13 6 6 6-6 6"></path>
</svg></a>
</div>
</div>
</div>
</section>


<section class="section bg-cream" id="donation-pledge"><div class="container"><div class="form-layout"><div><span class="eyebrow">Donation pledge</span><h2 class="h2">Record your intention to support.</h2><p class="lead">This form records a pledge only. It does not process payments. An administrator must verify payment before it is marked paid or a receipt becomes available.</p></div><form class="form-card" method="POST" action="{{ route('donate.submit') }}">@csrf<input type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true" style="position:absolute;left:-10000px;width:1px;height:1px"><div class="form-grid"><div class="field full"><label for="donor_name">Full name *</label><input id="donor_name" name="donor_name" autocomplete="name" required maxlength="160" value="{{ old('donor_name') }}"></div><div class="field"><label for="donor_email">Email</label><input id="donor_email" type="email" name="email" autocomplete="email" value="{{ old('email') }}"></div><div class="field"><label for="donor_phone">Phone</label><input id="donor_phone" name="phone" autocomplete="tel" value="{{ old('phone') }}"></div><div class="field"><label for="donation_amount">Amount (UGX) *</label><input id="donation_amount" type="number" name="amount" min="1" step="0.01" required value="{{ old('amount') }}"></div><div class="field"><label for="payment_method">Intended payment method *</label><select id="payment_method" name="payment_method" required><option value="">Choose method</option>@foreach(['Mobile Money','Bank transfer','Cash','Other'] as $method)<option value="{{ $method }}" @selected(old('payment_method')===$method)>{{ $method }}</option>@endforeach</select></div></div><div class="form-actions"><button class="btn btn-primary" type="submit">Submit pledge</button></div></form></div></div></section>
<section class="section" id="volunteer-application"><div class="container"><div class="form-layout"><div><span class="eyebrow">Volunteer application</span><h2 class="h2">Tell us how you would like to help.</h2><p class="lead">Applications are stored for review. Submission is not confirmation of a volunteer placement.</p></div><form class="form-card" method="POST" action="{{ route('volunteer.submit') }}">@csrf<input type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true" style="position:absolute;left:-10000px;width:1px;height:1px"><div class="form-grid"><div class="field"><label for="vol_name">Full name *</label><input id="vol_name" name="name" required maxlength="160" value="{{ old('name') }}"></div><div class="field"><label for="vol_email">Email *</label><input id="vol_email" type="email" name="email" required value="{{ old('email') }}"></div><div class="field"><label for="vol_phone">Phone</label><input id="vol_phone" name="phone" value="{{ old('phone') }}"></div><div class="field"><label for="vol_interest">Area of interest *</label><input id="vol_interest" name="area_of_interest" required value="{{ old('area_of_interest') }}" placeholder="e.g. community outreach"></div><div class="field full"><label for="vol_availability">Availability</label><input id="vol_availability" name="availability" value="{{ old('availability') }}" placeholder="e.g. weekends"></div><div class="field full"><label for="vol_experience">Experience / skills</label><textarea id="vol_experience" name="experience">{{ old('experience') }}</textarea></div><div class="field full"><label for="vol_motivation">Why would you like to volunteer? *</label><textarea id="vol_motivation" name="motivation" required>{{ old('motivation') }}</textarea></div><div class="field full"><label><input type="checkbox" name="consent" value="1" required @checked(old('consent'))> I agree that the foundation may use these details to review my volunteer application.</label></div></div><div class="form-actions"><button class="btn btn-primary" type="submit">Submit application</button></div></form></div></div></section>

@include('public.page-content-sections')

@endsection
