@extends('front.layouts.app')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/services.css') }}">
@endpush

@section('content')
  @include('front.partials.header', ['activeNav' => 'services'])

  <main>
    <section class="svc-hero">
      <div class="svc-hero__glow" aria-hidden="true"></div>
      <div class="container svc-hero__inner">
        <nav class="svc-breadcrumb" aria-label="Breadcrumb">
          <a href="{{ route('home') }}">Home</a>
          <span>/</span>
          <span aria-current="page">Services</span>
        </nav>

        <div class="svc-hero__label">
          <span class="svc-hero__label-text">- SERVICES</span>
          <span class="svc-hero__label-line"></span>
        </div>

        <h1 class="svc-hero__title">
          We Provide Best Quality
          <span class="svc-hero__title-row">
            Services
            <span class="svc-hero__square" aria-hidden="true"></span>
          </span>
        </h1>

        <p class="svc-hero__desc">
          {{ $page?->content ?: 'From your first incorporation to your hundredth filing, Whizseed handles the paperwork, deadlines, and regulatory complexity — so you can stay focused on building.' }}
        </p>

        <form class="svc-search" id="svcSearchForm" role="search">
          <div class="svc-search__field">
            <svg class="svc-search__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
            <input type="search" class="svc-search__input" id="svcSearchInput" placeholder="Search for services..." autocomplete="off">
          </div>
          <button type="submit" class="btn btn--accent svc-search__btn">
            Go For Services
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </button>
        </form>
      </div>
    </section>

    <section class="svc-filters">
      <div class="container">
        <div class="svc-filters__track" id="svcFilters">
          @foreach ($filters as $filter)
            <button type="button" class="svc-filter {{ $loop->first ? 'svc-filter--active' : '' }}" data-filter="{{ $filter['id'] }}">
              {{ $filter['label'] }}
            </button>
          @endforeach
        </div>
      </div>
    </section>

    <section class="svc-recommended">
      <div class="container">
        <h2 class="svc-recommended__title">Recommended Services</h2>
        <div class="svc-recommended__grid">
          @foreach ($recommended as $item)
            @php $slug = $serviceSlugs[$item['title']] ?? null; @endphp
            <a href="{{ $slug ? route('services.show', $slug) : '#' }}" class="svc-recommended__card">
              <span class="svc-recommended__tag">{{ $item['tag'] }}</span>
              <span class="svc-recommended__name">{{ $item['title'] }}</span>
              <span class="svc-recommended__arrow" aria-hidden="true">→</span>
            </a>
          @endforeach
        </div>
      </div>
    </section>

    <section class="svc-catalog">
      <div class="container">
        @foreach ($categories as $category)
          <article class="svc-category" id="category-{{ $category['id'] }}" data-category="{{ $category['id'] }}">
            <div class="svc-category__head">
              <div>
                <h2 class="svc-category__title">{{ $category['title'] }}</h2>
                <p class="svc-category__desc">{{ $category['description'] }}</p>
              </div>
              <span class="svc-category__count">{{ count($category['services']) }} Services</span>
            </div>

            <div class="svc-category__grid">
              @foreach (array_chunk($category['services'], (int) ceil(count($category['services']) / 2)) as $column)
                <ul class="svc-category__list">
                  @foreach ($column as $service)
                    @php $slug = $serviceSlugs[$service] ?? null; @endphp
                    <li class="svc-item" data-name="{{ strtolower($service) }}">
                      <a href="{{ $slug ? route('services.show', $slug) : '#' }}" class="svc-item__link">
                        <span class="svc-item__plus">+</span>
                        <span class="svc-item__title">{{ $service }}</span>
                        <span class="svc-item__arrow" aria-hidden="true">→</span>
                      </a>
                    </li>
                  @endforeach
                </ul>
              @endforeach
            </div>
          </article>
        @endforeach

        <p class="svc-empty" id="svcEmpty" hidden>No services match your search. Try a different keyword.</p>
      </div>
    </section>

    <section class="svc-cta">
      <div class="container svc-cta__inner">
        <div class="svc-cta__content">
          <h2 class="svc-cta__title">Ready to get started?</h2>
          <p class="svc-cta__text">Talk to our experts and find the right service for your business in minutes.</p>
        </div>
        <a href="#consult" class="btn btn--accent svc-cta__btn js-open-consult">
          {{ __('ui.get_started') }}
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
    </section>

    @include('front.partials.footer')
  </main>
@endsection

@push('scripts')
  <script src="{{ asset('js/services.js') }}"></script>
@endpush
