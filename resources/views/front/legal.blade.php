@extends('front.layouts.app')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/legal.css') }}">
@endpush

@section('content')
  @include('front.partials.header')

  <main>
    <section class="legal-hero">
      <div class="legal-hero__glow" aria-hidden="true"></div>
      <div class="container legal-hero__inner">
        <nav class="legal-breadcrumb" aria-label="Breadcrumb">
          <a href="{{ route('home') }}">Home</a>
          <span>/</span>
          <span aria-current="page">{{ $legal['breadcrumb'] }}</span>
        </nav>

        <div class="legal-hero__label">
          <span class="legal-hero__label-text">- {{ $legal['label'] }}</span>
          <span class="legal-hero__label-line"></span>
        </div>

        <h1 class="legal-hero__title">
          {{ $legal['title'] }}
          <span class="legal-hero__square" aria-hidden="true"></span>
        </h1>

        <p class="legal-hero__desc">
          {{ $page?->content ?: $legal['hero_desc'] }}
        </p>
      </div>
    </section>

    <section class="legal-body">
      <div class="container legal-body__layout">
        <aside class="legal-toc" aria-label="On this page">
          <h2 class="legal-toc__title">On this page</h2>
          <ul class="legal-toc__list">
            @foreach ($legal['sections'] as $index => $section)
              <li>
                <a href="#section-{{ $index }}">{{ $section['heading'] }}</a>
              </li>
            @endforeach
          </ul>
          <a href="{{ route('contact') }}" class="btn btn--accent legal-toc__cta">
            Contact Us
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        </aside>

        <article class="legal-content">
          @if (!empty($legal['intro']))
            <p class="legal-content__intro">{{ $legal['intro'] }}</p>
          @endif

          @foreach ($legal['sections'] as $index => $section)
            <section class="legal-section" id="section-{{ $index }}">
              <h2 class="legal-section__heading">
                <span class="legal-section__index">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                {{ $section['heading'] }}
              </h2>

              @foreach ($section['paragraphs'] ?? [] as $paragraph)
                <p class="legal-section__text">{{ $paragraph }}</p>
              @endforeach

              @if (!empty($section['items']))
                <ul class="legal-section__list">
                  @foreach ($section['items'] as $item)
                    <li>
                      <span class="legal-section__check" aria-hidden="true">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L20 7"/></svg>
                      </span>
                      <span>{{ $item }}</span>
                    </li>
                  @endforeach
                </ul>
              @endif
            </section>
          @endforeach

          <div class="legal-content__note">
            <p>
              Need clarification?
              <a href="{{ route('contact') }}">Get in touch with our team</a>
              or email
              <a href="mailto:info@whizseed.com">info@whizseed.com</a>.
            </p>
          </div>
        </article>
      </div>
    </section>

    <section class="legal-cta">
      <div class="container legal-cta__inner">
        <div class="legal-cta__content">
          <h2 class="legal-cta__title">Ready to get started?</h2>
          <p class="legal-cta__text">Explore our services or talk to an expert — we’re here to help your business grow.</p>
        </div>
        <div class="legal-cta__actions">
          <a href="{{ route('services') }}" class="btn btn--accent">
            Explore Services
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
          <a href="{{ route('contact') }}" class="btn btn--outline legal-cta__ghost">Contact Us</a>
        </div>
      </div>
    </section>

    @include('front.partials.footer')
  </main>
@endsection
