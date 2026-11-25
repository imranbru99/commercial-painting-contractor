@extends('layouts.app')
@section('title', 'Contact')
@section('content')
<div class="page-hero"><div class="wrap"><h1>Contact / Estimate</h1></div></div>
<section>
    <div class="wrap" style="display:grid;gap:2rem;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));">
        <div>
            <h2 class="section-title" style="font-size:2rem;">Tell us about the facility</h2>
            <p class="section-lead">Warehouse square footage, substrate, operating hours, and desired finish schedule help us price faster.</p>
            <p><strong>Phone:</strong> (713) 555-0148<br><strong>Email:</strong> hello@ironspan.coatings<br><strong>HQ:</strong> 4200 Navigation Blvd, Houston, TX 77003</p>
        </div>
        <div>
            @if(session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif
            <form class="form" method="POST" action="{{ url('/contact') }}">
                @csrf
                <div><label>Name</label><input name="name" value="{{ old('name') }}" required></div>
                <div><label>Email</label><input type="email" name="email" value="{{ old('email') }}" required></div>
                <div><label>Phone</label><input name="phone" value="{{ old('phone') }}"></div>
                <div><label>Company</label><input name="company" value="{{ old('company') }}"></div>
                <div><label>Subject</label><input name="subject" value="{{ old('subject') }}"></div>
                <div><label>Message</label><textarea name="message" rows="5" required>{{ old('message') }}</textarea></div>
                @if($errors->any())
                    <div style="color:#B91C1C;font-size:.9rem;">{{ $errors->first() }}</div>
                @endif
                <button class="btn btn-amber" type="submit">Send Message</button>
            </form>
        </div>
    </div>
</section>
@endsection
