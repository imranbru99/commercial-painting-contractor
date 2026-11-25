@extends('layouts.app')

@section('title', 'Ironspan Commercial Coatings')
@section('meta', 'Houston commercial and industrial painting contractor for warehouses, plants, high-rise facades, and structural steel.')

@section('content')
<section class="hero">
    <div class="wrap">
        <div class="rise" style="font-weight:700;letter-spacing:.12em;text-transform:uppercase;font-size:.85rem;color:var(--amber);margin-bottom:.8rem;">Ironspan Commercial Coatings</div>
        <h1 class="rise rise-delay">Coatings built for working facilities</h1>
        <p class="rise rise-delay-2">Warehouse interiors, plant exteriors, high-rise facade recoats, and structural steel systems — staged around your operations across the Gulf Coast.</p>
        <div class="cta-row rise rise-delay-2">
            <a class="btn btn-amber" href="{{ url('/contact') }}">Request a Site Walk</a>
            <a class="btn btn-ghost" href="{{ url('/services') }}">View Services</a>
        </div>
    </div>
</section>

<section>
    <div class="wrap">
        <div class="section-kicker">Services</div>
        <h2 class="section-title">Industrial-grade painting programs</h2>
        <p class="section-lead">From night-shift warehouse walls to engineered swing-stage tower recoats, Ironspan delivers documented DFT, containment, and cure windows your facility managers can trust.</p>
        <div class="grid-3">
            @foreach([
                ['warehouse-interiors','Warehouse Interiors','https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=900&q=80','Abrasion-ready wall and ceiling systems for distribution centers.'],
                ['plant-exteriors','Plant Exteriors','https://images.unsplash.com/photo-1581094794329-c8112a89af12?auto=format&fit=crop&w=900&q=80','Weather-rated coatings for manufacturing shells and metal panels.'],
                ['high-rise-facades','High-Rise Facades','https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=900&q=80','Swing-stage recoats for Class-A towers and mixed-use exteriors.'],
            ] as [$slug,$title,$img,$copy])
                <a class="tile" href="{{ url('/services/'.$slug) }}">
                    <img src="{{ $img }}" alt="{{ $title }}">
                    <div class="tile-body">
                        <h3>{{ $title }}</h3>
                        <p>{{ $copy }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section style="background:#fff;">
    <div class="wrap split">
        <div>
            <div class="section-kicker">About Ironspan</div>
            <h2 class="section-title">Precision crews for occupied plants</h2>
            <p class="section-lead">Founded in Houston’s industrial corridor, Ironspan Commercial Coatings pairs OSHA-trained applicators with ERP-tracked job packets — so facility directors see schedule, materials, and invoice status in one place.</p>
            <a class="btn btn-teal" href="{{ url('/about') }}">Our Story</a>
        </div>
        <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=1200&q=80" alt="Industrial coating crew on structural steel">
    </div>
</section>

<section>
    <div class="wrap split">
        <div class="dash-preview">
            <div style="font-family:var(--font-display);font-size:1.6rem;text-transform:uppercase;letter-spacing:.04em;">Ops dashboard preview</div>
            <div class="dash-stats">
                <div class="dash-stat"><strong>18</strong><span>Open coating jobs</span></div>
                <div class="dash-stat"><strong>$2.4M</strong><span>Pipeline value</span></div>
                <div class="dash-stat"><strong>94%</strong><span>On-time punch close</span></div>
                <div class="dash-stat"><strong>6</strong><span>Crews in field</span></div>
            </div>
            <p style="margin:0;opacity:.85;font-size:.92rem;">Filament ERP tracks customers, inventory gallons, invoices, and AI-assisted job notes from `/admin`.</p>
        </div>
        <div>
            <div class="section-kicker">ERP + AI</div>
            <h2 class="section-title">Run the shop from one panel</h2>
            <p class="section-lead">Managers schedule site walks, pull coating SKUs, push progress invoices, and draft client updates with the Ironspan AI Studio — without leaving the admin.</p>
            <a class="btn btn-amber" href="{{ url('/admin') }}">Open Admin Login</a>
        </div>
    </div>
</section>

@if($posts->count())
<section style="background:#fff;">
    <div class="wrap">
        <div class="section-kicker">Insights</div>
        <h2 class="section-title">Field notes & coating guides</h2>
        <div class="grid-3">
            @foreach($posts as $post)
                <a class="tile" href="{{ url('/blog/'.$post->slug) }}">
                    @if($post->cover_image)
                        <img src="{{ $post->cover_image }}" alt="{{ $post->title }}">
                    @endif
                    <div class="tile-body">
                        <h3>{{ $post->title }}</h3>
                        <p>{{ $post->excerpt }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
