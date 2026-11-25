@extends('layouts.app')
@section('title', $post->title)
@section('content')
<div class="page-hero"><div class="wrap"><h1>{{ $post->title }}</h1></div></div>
<section>
    <div class="wrap prose">
        @if($post->cover_image)
            <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" style="border-radius:10px;margin-bottom:1.5rem;max-height:420px;width:100%;object-fit:cover;">
        @endif
        <div style="white-space:pre-line;">{!! nl2br(e($post->body)) !!}</div>
    </div>
</section>
@endsection
