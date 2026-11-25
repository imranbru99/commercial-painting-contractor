@extends('layouts.app')
@section('title', $service['title'])
@section('content')
<div class="page-hero"><div class="wrap"><h1>{{ $service['title'] }}</h1><p style="opacity:.85;max-width:40rem;">{{ $service['summary'] }}</p></div></div>
<section>
    <div class="wrap split">
        <div class="prose">
            <p>{{ $service['body'] }}</p>
            <p>Request a site walk and Ironspan will return a phased estimate with material system, crew window, and progress billing milestones.</p>
            <a class="btn btn-teal" href="{{ url('/contact') }}">Request Estimate</a>
        </div>
        <img src="{{ $service['image'] }}" alt="{{ $service['title'] }}">
    </div>
</section>
@endsection
