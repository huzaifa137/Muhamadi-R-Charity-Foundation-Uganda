@extends('layouts.public')
@section('title', $title.' | Muhamadi R Charity Foundation Uganda')
@section('page-key', $kind)
@section('content')
<section class="page-hero"><div class="container"><span class="eyebrow">{{ $kind==='impact' ? 'Evidence & progress' : ($kind==='stories' ? 'Stories & field notes' : 'Field gallery') }}</span><h1 class="h1">{{ $title }}</h1><p class="lead">{{ $intro }}</p></div></section>
@if(session('status'))<section class="section-sm"><div class="container"><div class="notice" role="status">{{ session('status') }}</div></div></section>@endif
<section class="section"><div class="container">
@if($records->isEmpty())<div class="form-card"><h2 class="h2">Updates will appear here</h2><p class="muted">The foundation team has not published any records in this section yet. No sample statistics or unverified outcomes are shown.</p></div>
@elseif($kind==='gallery')
<div class="grid-3">@foreach($records as $item)<article class="value-card" style="padding:0;overflow:hidden"><img src="{{ str_starts_with($item->image_path, 'http') ? $item->image_path : asset($item->image_path) }}" alt="{{ $item->alt_text }}" loading="lazy" style="width:100%;aspect-ratio:4/3;object-fit:cover"><div style="padding:18px"><span class="eyebrow">{{ $item->category ?: 'Community' }}</span><h3>{{ $item->title }}</h3>@if($item->caption)<p>{{ $item->caption }}</p>@endif</div></article>@endforeach</div>
@else
<div class="grid-3">@foreach($records as $item)<article class="value-card" style="overflow:hidden">
@if($item->image_path)<img src="{{ str_starts_with($item->image_path, 'http') ? $item->image_path : asset($item->image_path) }}" alt="" loading="lazy" style="width:100%;aspect-ratio:16/9;object-fit:cover;margin:-24px -24px 20px;max-width:calc(100% + 48px)">@endif
<span class="eyebrow">{{ $item->category ?: ($kind==='impact' ? 'Project update' : 'Foundation update') }}</span><h3>{{ $item->title }}</h3><p>{{ $kind==='impact' ? $item->summary : $item->excerpt }}</p>
@if($kind==='impact')
@if($item->beneficiaries_count !== null)<p><strong>Verified beneficiaries recorded:</strong> {{ number_format($item->beneficiaries_count) }}</p>@endif
@if($item->outcome)<p><strong>Outcome:</strong> {{ $item->outcome }}</p>@endif
@if($item->location)<p class="muted">{{ $item->location }}</p>@endif
@else<a class="btn btn-outline btn-sm" href="{{ route('stories.show', $item->slug) }}">Read story →</a>@endif
@if($item->published_at)<p class="muted" style="font-size:.78rem;margin-top:12px">{{ \Illuminate\Support\Carbon::parse($item->published_at)->format('d M Y') }}</p>@endif
</article>@endforeach</div>
@endif
</div></section>
@endsection
