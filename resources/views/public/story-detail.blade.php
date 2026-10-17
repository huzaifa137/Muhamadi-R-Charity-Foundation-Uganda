@extends('layouts.public')
@section('title', $story->title.' | Stories')
@section('page-key','stories')
@section('content')
<section class="page-hero"><div class="container"><span class="eyebrow">{{ $story->category ?: 'Foundation story' }}</span><h1 class="h1">{{ $story->title }}</h1><p class="lead">{{ $story->excerpt }}</p><p class="muted">{{ $story->published_at ? \Illuminate\Support\Carbon::parse($story->published_at)->format('d M Y') : '' }} @if($story->author_name) · {{ $story->author_name }} @endif</p></div></section>
<section class="section"><div class="container" style="max-width:900px">@if($story->image_path)<img src="{{ str_starts_with($story->image_path, 'http') ? $story->image_path : asset($story->image_path) }}" alt="" style="width:100%;max-height:520px;object-fit:cover;border-radius:18px;margin-bottom:28px">@endif<div style="white-space:pre-line;line-height:1.9;font-size:1.05rem">{{ $story->body }}</div><p style="margin-top:30px"><a class="btn btn-outline" href="{{ route('stories') }}">← All stories</a></p></div></section>
@endsection
