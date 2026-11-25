@extends('layouts.app')

@section('title', 'Knowledge Base')
@section('meta_description', 'Common biohazard issues, step-by-step guides, admin manual, and troubleshooting for SteriPath Biohazard Cleanup.')

@section('content')
<section class="section">
    <div class="wrap">
        <h2>Knowledge base</h2>
        <p class="lede">Common issues, remediation guides, admin manual notes, and troubleshooting for SteriPath biohazard operations.</p>
        @foreach($articles as $category => $items)
            <h3 style="font-family:var(--font-display);text-transform:capitalize;margin:2rem 0 .8rem;">{{ str_replace('_',' ', $category) }}</h3>
            <div class="grid-2">
                @foreach($items as $article)
                    <a class="panel" href="{{ route('knowledge.show', $article->slug) }}">
                        <h3>{{ $article->title }}</h3>
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($article->body), 140) }}</p>
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>
</section>
@endsection
