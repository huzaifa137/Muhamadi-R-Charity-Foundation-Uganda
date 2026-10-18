@if(isset($page) && is_array($page->sections))
    @foreach($page->sections as $index => $section)
        <section class="section {{ $index % 2 === 1 ? 'bg-cream' : '' }}">
            <div class="container">
                <div class="section-head">
                    <div>
                        @if(!empty($section['eyebrow']))<span class="eyebrow">{{ $section['eyebrow'] }}</span>@endif
                        <h2 class="h2">{{ $section['title'] }}</h2>
                    </div>
                    <p class="lead">{{ $section['body'] }}</p>
                </div>
                @if(!empty($section['image_path']))
                    <div class="image-stack" style="max-width:760px;margin:20px auto 30px"><div class="image-main"><img src="{{ asset($section['image_path']) }}" alt="{{ $section['title'] }}" loading="lazy"></div></div>
                @endif
                @if(!empty($section['items']))
                    <div class="grid-3">
                        @foreach($section['items'] as $item)
                            <article class="story-card reveal">
                                <div class="card-body"><h3>{{ $item['title'] ?? '' }}</h3><p>{{ $item['description'] ?? '' }}</p></div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endforeach
@endif
