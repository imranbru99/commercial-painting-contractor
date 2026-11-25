@extends('layouts.app')
@section('title', $article->title)
@section('content')
<div class="page-hero"><div class="wrap"><h1>{{ $article->title }}</h1><p style="opacity:.8;">{{ ucfirst($article->category) }}</p></div></div>
<section>
    <div class="wrap prose">
        <p style="color:var(--steel);">{{ $article->summary }}</p>
        <div style="white-space:pre-line;">{!! nl2br(e($article->body)) !!}</div>
        <p style="margin-top:2rem;"><a class="btn btn-teal" href="{{ url('/knowledge') }}">Back to Knowledge Base</a></p>
    </div>
</section>
@endsection
