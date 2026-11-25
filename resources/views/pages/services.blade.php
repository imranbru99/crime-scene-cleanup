@extends('layouts.app')

@section('title', 'Biohazard Services')
@section('meta_description', 'Trauma scene cleanup, bloodborne pathogen remediation, infectious disinfection, hoarding biohazards, vehicle cleanup, and medical waste packaging by SteriPath.')

@section('content')
<section class="section">
    <div class="wrap">
        <h2>All services</h2>
        <p class="lede">SteriPath remediates trauma scenes, bloodborne pathogens, infectious contamination, and related biohazards across Dallas–Fort Worth.</p>
        <div class="grid-3">
            @foreach([
                ['trauma-scene-cleanup','Trauma Scene Cleanup','https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=1200&q=80'],
                ['bloodborne-pathogen-remediation','Bloodborne Pathogen Remediation','https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=1200&q=80'],
                ['infectious-disease-disinfection','Infectious Disease Disinfection','https://images.unsplash.com/photo-1631549916768-4119b2e5f926?auto=format&fit=crop&w=1200&q=80'],
                ['hoarding-biohazard-cleanup','Hoarding Biohazard Cleanup','https://images.unsplash.com/photo-1563453392212-326f5e854473?auto=format&fit=crop&w=1200&q=80'],
                ['vehicle-biohazard-cleanup','Vehicle Biohazard Cleanup','https://images.unsplash.com/photo-1527515637462-cff97d7f3eba?auto=format&fit=crop&w=1200&q=80'],
                ['sharps-medical-waste','Sharps & Medical Waste','https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1200&q=80'],
            ] as [$slug,$title,$img])
                <a class="service-tile" href="{{ route('services.show', $slug) }}">
                    <img src="{{ $img }}" alt="{{ $title }}">
                    <div class="pad">
                        <h3>{{ $title }}</h3>
                        <p>View scope & process →</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
