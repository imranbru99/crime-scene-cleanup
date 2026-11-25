@extends('layouts.app')

@section('title', 'About SteriPath')
@section('meta_description', 'SteriPath Biohazard Cleanup is a Dallas–Fort Worth SME focused on discreet trauma and biohazard remediation with OSHA-aligned protocols.')

@section('content')
<section class="section">
    <div class="wrap grid-2">
        <div>
            <h2>Built for hard moments</h2>
            <p class="lede">SteriPath Biohazard Cleanup is a Dallas–Fort Worth SME focused on trauma scene cleanup, bloodborne pathogen remediation, and infectious disinfection. We grew out of technicians who refused cosmetic wipe-downs over unresolved contamination — and that discipline still defines every job packet.</p>
            <p class="lede">Families, property managers, insurers, and facilities teams trust us for discreet arrival, documented disposal, and spaces returned to safe occupancy standards.</p>
            <a class="btn btn-dark" href="{{ route('contact') }}">Talk to dispatch</a>
        </div>
        <div>
            <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=1400&q=80" alt="SteriPath response team coordinating" style="width:100%;height:360px;object-fit:cover;">
        </div>
    </div>
</section>
@endsection
