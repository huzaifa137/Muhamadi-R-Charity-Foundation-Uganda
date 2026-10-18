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
                            <article class="story-card reveal"><div class="card-body"><h3>{{ $item['title'] ?? '' }}</h3><p>{{ $item['description'] ?? '' }}</p></div></article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endforeach
@endif

@if(isset($records) && $records->isNotEmpty() && isset($page) && in_array($page->page_key, ['impact', 'stories'], true))
    <section class="section bg-cream">
        <div class="container">
            <div class="section-head">
                <div><span class="eyebrow">{{ $page->page_key === 'impact' ? 'Published project records' : 'Published stories' }}</span><h2 class="h2">{{ $page->page_key === 'impact' ? 'Projects and impact updates' : 'Stories from the foundation' }}</h2></div>
                <p class="lead">{{ $page->page_key === 'impact' ? 'Approved progress updates and evidence from published projects.' : 'Articles and field updates approved for public viewing.' }}</p>
            </div>
            <div class="grid-3">
                @foreach($records as $record)
                    <article class="story-card reveal">
                        @if($record->image_path)<div class="card-media"><img src="{{ asset($record->image_path) }}" alt="{{ $record->title }}" loading="lazy"></div>@endif
                        <div class="card-body">
                            <span class="pill">{{ $record->category ?: ($page->page_key === 'impact' ? 'Project update' : 'Foundation story') }}</span>
                            <h3>{{ $record->title }}</h3>
                            <p>{{ $page->page_key === 'impact' ? $record->summary : $record->excerpt }}</p>
                            @if($page->page_key === 'impact' && $record->beneficiaries_count !== null)<p class="muted">Verified beneficiaries: {{ number_format($record->beneficiaries_count) }}</p>@endif
                            @if($page->page_key === 'stories')<a class="card-link" href="{{ route('stories.show', $record->slug) }}">Read story <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14"></path><path d="m13 6 6 6-6 6"></path></svg></a>@endif
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif
