@extends('layouts.app')
@section('title', 'Knowledge Base')
@section('content')
<div class="page-hero"><div class="wrap"><h1>Knowledge Base</h1><p style="opacity:.85;">Guides, common issues, admin manual, and troubleshooting for Ironspan operations.</p></div></div>
<section>
    <div class="wrap" style="display:grid;gap:2rem;">
        @foreach($articles as $category => $items)
            <div>
                <h2 class="section-title" style="font-size:1.8rem;">{{ str_replace('_',' ', ucfirst($category)) }}</h2>
                <div class="grid-3">
                    @foreach($items as $article)
                        <a class="tile" href="{{ url('/knowledge/'.$article->slug) }}">
                            <div class="tile-body">
                                <h3>{{ $article->title }}</h3>
                                <p>{{ $article->summary }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection
