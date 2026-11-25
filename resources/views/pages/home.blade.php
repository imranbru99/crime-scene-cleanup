@extends('layouts.app')

@section('title', 'SteriPath Biohazard Cleanup')
@section('meta_description', 'Discreet trauma scene, bloodborne pathogen, and infectious disease cleanup across Dallas–Fort Worth by SteriPath Biohazard Cleanup.')

@section('content')
<section class="hero">
    <div class="wrap hero-inner">
        <h1>SteriPath<br>Biohazard Cleanup</h1>
        <p>24/7 trauma, bloodborne pathogen, and infectious disease remediation — unmarked vehicles, hospital-grade disinfection, compassionate crews across DFW.</p>
        <div class="hero-ctas">
            <a class="btn btn-primary" href="{{ route('contact') }}">Request emergency dispatch</a>
            <a class="btn btn-ghost" href="{{ route('services') }}">View remediation services</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="wrap">
        <h2>Remediation services</h2>
        <p class="lede">Purpose-built biohazard protocols for homes, multifamily, fleets, and commercial sites — never a surface wipe over saturated materials.</p>
        <div class="grid-3">
            @foreach([
                ['trauma-scene-cleanup','Trauma Scene Cleanup','Discreet trauma remediation with full PPE containment.','https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=1200&q=80'],
                ['bloodborne-pathogen-remediation','Bloodborne Pathogen Remediation','ATP-aware cleaning of blood and OPIM.','https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=1200&q=80'],
                ['infectious-disease-disinfection','Infectious Disease Disinfection','Hospital-grade disinfection after contagious events.','https://images.unsplash.com/photo-1631549916768-4119b2e5f926?auto=format&fit=crop&w=1200&q=80'],
            ] as [$slug,$title,$blurb,$img])
                <a class="service-tile" href="{{ route('services.show', $slug) }}">
                    <img src="{{ $img }}" alt="{{ $title }}">
                    <div class="pad">
                        <h3>{{ $title }}</h3>
                        <p>{{ $blurb }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="section" style="padding-top:0">
    <div class="wrap">
        <h2>Why SteriPath</h2>
        <p class="lede">DFW crews that treat PPE, dwell times, and waste manifests as non-negotiable — because shortcuts leave people at risk.</p>
        <div class="grid-3">
            <div class="panel"><h3>Protocol-first</h3><p>Containment, hospital-grade chemistry, and ATP checks before we declare a space safe.</p></div>
            <div class="panel"><h3>Discreet response</h3><p>Unmarked vehicles and respectful communication for families, HOAs, and property teams.</p></div>
            <div class="panel"><h3>ERP-run jobs</h3><p>Quotes, crew schedules, PPE inventory, and invoices live in one operations stack.</p></div>
        </div>
    </div>
</section>

<section class="section" style="padding-top:0">
    <div class="wrap">
        <h2>Ops dashboard preview</h2>
        <p class="lede">A glimpse of the SteriPath ERP used to dispatch crews, track PPE kits, and close invoices.</p>
        <div class="dash-preview">
            <div>
                <div class="grid-3" style="grid-template-columns:repeat(3,1fr)">
                    <div class="metric"><strong>18</strong> Active jobs</div>
                    <div class="metric"><strong>$96k</strong> Pipeline</div>
                    <div class="metric"><strong>24/7</strong> Dispatch</div>
                </div>
                <div class="bars">
                    <span style="height:45%"></span><span style="height:70%"></span><span style="height:55%"></span>
                    <span style="height:85%"></span><span style="height:60%"></span><span style="height:92%"></span>
                    <span style="height:68%"></span>
                </div>
            </div>
            <div>
                <h3 style="font-family:var(--font-display);margin-top:0">Live modules</h3>
                <ul style="line-height:1.9;padding-left:1.1rem;color:rgba(255,255,255,.86)">
                    <li>Jobs & scheduling</li>
                    <li>PPE / disinfectant inventory</li>
                    <li>Invoices & payments</li>
                    <li>AI content + troubleshooting</li>
                </ul>
                <a class="btn btn-primary" style="margin-top:1rem" href="/admin">Open admin ERP</a>
            </div>
        </div>
    </div>
</section>

<section class="section" style="padding-top:0">
    <div class="wrap">
        <h2>From the field</h2>
        <p class="lede">Guides for families, property managers, and insurers across DFW.</p>
        <div class="grid-3">
            @forelse($posts as $post)
                <a class="panel" href="{{ route('blog.show', $post->slug) }}">
                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->excerpt }}</p>
                </a>
            @empty
                <div class="panel"><p>Blog posts will appear after seeding.</p></div>
            @endforelse
        </div>
    </div>
</section>
@endsection