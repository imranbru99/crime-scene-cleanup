@extends('layouts.app')

@section('title', 'Contact SteriPath')
@section('meta_description', 'Contact SteriPath Biohazard Cleanup for emergency biohazard dispatch across Dallas–Fort Worth.')

@section('content')
<section class="section">
    <div class="wrap grid-2">
        <div>
            <h2>Dispatch & intake</h2>
            <p class="lede">Tell us about the situation. We’ll confirm discreet arrival, PPE requirements, and a written remediation scope for Dallas–Fort Worth properties.</p>
            <div class="panel">
                <p><strong>Phone:</strong> (214) 555-0188</p>
                <p><strong>Email:</strong> hello@steripathbio.com</p>
                <p><strong>Service area:</strong> Columbus, Dublin, Westerville & Dallas–Fort Worth</p>
                <p><strong>WhatsApp:</strong> <a href="https://wa.me/12145550188" target="_blank" rel="noopener">Chat now</a></p>
            </div>
        </div>
        <div>
            @if(session('success'))
                <div class="flash">{{ session('success') }}</div>
            @endif
            <form class="stack panel" method="post" action="{{ route('contact.store') }}">
                @csrf
                <div>
                    <label for="name">Name</label>
                    <input id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')<small>{{ $message }}</small>@enderror
                </div>
                <div>
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div>
                    <label for="phone">Phone</label>
                    <input id="phone" name="phone" value="{{ old('phone') }}">
                </div>
                <div>
                    <label for="subject">Subject</label>
                    <input id="subject" name="subject" value="{{ old('subject') }}" placeholder="Trauma cleanup / disinfection / vehicle">
                </div>
                <div>
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                </div>
                <button class="btn btn-primary" type="submit">Send request</button>
            </form>
        </div>
    </div>
</section>
@endsection
