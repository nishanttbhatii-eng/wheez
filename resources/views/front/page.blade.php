@extends('front.layouts.app')

@section('content')
<main class="container" style="padding: 120px 20px 80px; max-width: 900px; margin: 0 auto;">
    <h1 style="font-size: 2.5rem; margin-bottom: 1rem;">{{ $page->title }}</h1>
    @if($page->content)
        <div style="line-height: 1.8; color: #333;">
            {!! nl2br(e($page->content)) !!}
        </div>
    @endif
    <p style="margin-top: 2rem;">
        <a href="{{ route('home') }}" style="color: #c8c400; font-weight: 600;">&larr; Back to Home</a>
    </p>
</main>
@endsection
