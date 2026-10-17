@extends('layouts.public')

@section('title', 'Gallery | Muhamadi R Charity Foundation Uganda')
@section('page-key', 'gallery')

@section('content')

<section class="page-hero"><div class="container"><span class="eyebrow">Field gallery</span><h1 class="h1">Real photographs. Real community moments.</h1><p class="lead">A visual archive built from the supplied photographs. Open any image for a larger view.</p></div></section>
<section class="section"><div class="container"><div class="gallery-toolbar"><div><strong style="font-size:.9rem">Field archive</strong><span class="muted" style="font-size:.76rem;margin-left:8px">101 supplied photographs</span></div><div class="filters"><button class="filter-btn active" data-filter="all">All</button><button class="filter-btn" data-filter="Community">Community</button><button class="filter-btn" data-filter="Support">Support</button><button class="filter-btn" data-filter="Outreach">Outreach</button><button class="filter-btn" data-filter="Field Work">Field Work</button></div></div><div class="gallery" data-gallery=""></div></div></section>


<div class="lightbox" role="dialog" aria-modal="true" aria-label="Gallery image viewer">
    <button class="lightbox-close" type="button" data-close aria-label="Close image viewer">&times;</button>
    <button class="lightbox-prev" type="button" data-prev aria-label="Previous image">&#10094;</button>
    <img src="" alt="" />
    <button class="lightbox-next" type="button" data-next aria-label="Next image">&#10095;</button>
    <div class="lightbox-caption"></div>
</div>

@endsection
