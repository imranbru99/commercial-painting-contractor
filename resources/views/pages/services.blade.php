@extends('layouts.app')
@section('title', 'Services')
@section('content')
<div class="page-hero"><div class="wrap"><h1>Commercial Painting Services</h1></div></div>
<section>
    <div class="wrap grid-3">
        @foreach([
            ['warehouse-interiors','Warehouse Interior Coatings','https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=900&q=80'],
            ['plant-exteriors','Plant & Facility Exteriors','https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?auto=format&fit=crop&w=900&q=80'],
            ['high-rise-facades','High-Rise Facade Recoats','https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=900&q=80'],
            ['structural-steel','Structural Steel & Pipe','https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=900&q=80'],
            ['epoxy-floor-prep','Epoxy Floor Prep Coatings','https://images.unsplash.com/photo-1565793298595-6a879b1d9492?auto=format&fit=crop&w=900&q=80'],
            ['occupied-facility','Occupied Facility Programs','https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=900&q=80'],
        ] as [$slug,$title,$img])
            <a class="tile" href="{{ url('/services/'.$slug) }}">
                <img src="{{ $img }}" alt="{{ $title }}">
                <div class="tile-body"><h3>{{ $title }}</h3><p>View scope, prep, and typical scheduling.</p></div>
            </a>
        @endforeach
    </div>
</section>
@endsection
