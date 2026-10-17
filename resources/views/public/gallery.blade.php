@extends('layouts.public')

@section('title', 'Gallery | Muhamadi R Charity Foundation Uganda')
@section('page-key', 'gallery')

@section('content')

<section class="page-hero"><div class="container"><span class="eyebrow">Field gallery</span><h1 class="h1">Real photographs. Real community moments.</h1><p class="lead">A visual archive built from the supplied photographs. Open any image for a larger view.</p></div></section>
<section class="section"><div class="container"><div class="gallery-toolbar"><div><strong style="font-size:.9rem">Field archive</strong><span class="muted" style="font-size:.76rem;margin-left:8px">101 supplied photographs</span></div><div class="filters"><button class="filter-btn active" data-filter="all">All</button><button class="filter-btn" data-filter="Community">Community</button><button class="filter-btn" data-filter="Support">Support</button><button class="filter-btn" data-filter="Outreach">Outreach</button><button class="filter-btn" data-filter="Field Work">Field Work</button></div></div><div class="gallery" data-gallery=""></div></div></section>


@if(isset($galleryItems) && $galleryItems->isNotEmpty())
<section class="section bg-cream"><div class="container"><div class="section-head"><div><span class="eyebrow">Latest additions</span><h2 class="h2">Recently published photographs</h2></div><p class="lead">Images added and approved by the foundation's content team.</p></div><div class="grid-3">
@foreach($galleryItems as $item)<article class="value-card" style="padding:0;overflow:hidden"><img src="{{ str_starts_with($item->image_path, 'http') ? $item->image_path : asset($item->image_path) }}" alt="{{ $item->alt_text }}" loading="lazy" style="width:100%;aspect-ratio:4/3;object-fit:cover"><div style="padding:18px"><span class="eyebrow">{{ $item->category ?: 'Community' }}</span><h3>{{ $item->title }}</h3>@if($item->caption)<p>{{ $item->caption }}</p>@endif</div></article>@endforeach
</div></div></section>
@endif

<div class="lightbox" role="dialog" aria-modal="true" aria-label="Gallery image viewer">
    <button class="lightbox-close" type="button" data-close aria-label="Close image viewer">&times;</button>
    <button class="lightbox-prev" type="button" data-prev aria-label="Previous image">&#10094;</button>
    <img src="" alt="" />
    <button class="lightbox-next" type="button" data-next aria-label="Next image">&#10095;</button>
    <div class="lightbox-caption"></div>
</div>

@endsection
