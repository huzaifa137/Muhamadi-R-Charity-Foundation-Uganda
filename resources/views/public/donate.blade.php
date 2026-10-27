@extends('layouts.public')

@section('title', 'Donate | Muhamadi R Charity Foundation Uganda')
@section('page-key', 'donate')

@section('content')
<section class="page-hero">
<div class="container"><span class="eyebrow">Donate</span>
<h1 class="h1">Your gift becomes practical support.</h1>
<p class="lead">Every contribution helps the foundation respond to real needs in the communities it serves. Give securely online in a few minutes.</p>
</div>
</section>

<section class="section">
<div class="container give-layout">
<div class="reveal">
<span class="eyebrow">Why give</span>
<h2 class="h2">Compassion in action, with accountability.</h2>
<p class="lead">The foundation records and reviews every donation, so your support can be traced and acknowledged properly. You can read about the work your gift supports on our <a class="text-green" href="{{ route('programs') }}"><strong>programmes</strong></a> and <a class="text-green" href="{{ route('impact') }}"><strong>impact</strong></a> pages, and hear from the people involved in <a class="text-green" href="{{ route('stories') }}"><strong>stories</strong></a>.</p>
<p class="muted">Prefer to arrange your gift another way, or have a question first? You can <a class="text-green" href="{{ route('get-involved') }}#donation-pledge"><strong>record a pledge</strong></a> or <a class="text-green" href="{{ route('contact') }}"><strong>contact the team</strong></a>.</p>
</div>
<div class="reveal delay-1">@include('components.shared.flutterwave-donate-card')</div>
</div>
</section>

<section class="section bg-cream">
<div class="container">
<div class="section-head">
<div><span class="eyebrow">How it works</span>
<h2 class="h2">Three simple steps.</h2></div>
<p class="lead">Giving takes only a few minutes and you stay in control of the amount.</p>
</div>
<div class="grid-3">
<div class="value-card give-step reveal"><div class="value-icon">1</div><h3>Choose to give</h3><p>Select "Donate securely" to open Flutterwave's payment page in a new tab.</p></div>
<div class="value-card give-step reveal delay-1"><div class="value-icon">2</div><h3>Complete your payment</h3><p>Enter your details and the amount you wish to give, then follow the checkout steps.</p></div>
<div class="value-card give-step reveal delay-2"><div class="value-icon">3</div><h3>We confirm and thank you</h3><p>The team verifies your payment before issuing a receipt, so every gift is properly acknowledged.</p></div>
</div>
</div>
</section>
@endsection
