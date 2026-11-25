@extends('layouts.app')
@section('title', 'Insights')
@section('content')
<div class="page-hero"><div class="wrap"><h1>Field Insights</h1></div></div>
<section>
    <div class="wrap grid-3">
        @foreach($posts as $post)
            <a class="tile" href="{{ url('/blog/'.$post->slug) }}">
                @if($post->cover_image)<img src="{{ $post->cover_image }}" alt="{{ $post->title }}">@endif
                <div class="tile-body">
                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->excerpt }}</p>
                </div>
            </a>
        @endforeach
    </div>
    <div class="wrap" style="margin-top:2rem;">{{ $posts->links() }}</div>
</section>
@endsection
