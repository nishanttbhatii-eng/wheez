@extends('front.layouts.app')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/service-detail.css') }}">
@endpush

@section('content')
  @include('front.partials.header', ['activeNav' => 'services'])

  <main>
    <section class="sp-hero">
      <div class="sp-hero__bg" aria-hidden="true"></div>
      <div class="container sp-hero__grid">
        <div class="sp-hero__content">
          <div class="sp-hero__ratings">
            <div class="sp-hero__avatars" aria-hidden="true">
              <img src="https://i.pravatar.cc/44?img=11" alt="" class="sp-hero__avatar">
              <img src="https://i.pravatar.cc/44?img=12" alt="" class="sp-hero__avatar">
              <img src="https://i.pravatar.cc/44?img=13" alt="" class="sp-hero__avatar">
              <img src="https://i.pravatar.cc/44?img=32" alt="" class="sp-hero__avatar">
            </div>
            <div class="sp-hero__stars" aria-hidden="true">★★★★★</div>
            <span class="sp-hero__rating-text">4.9 (1,200 reviews)</span>
          </div>

          <h1 class="sp-hero__title">{{ $service->name }}</h1>
          <p class="sp-hero__desc">{{ $service->heroDescription() }}</p>

          <div class="sp-hero__process">
            <p class="sp-hero__process-label">- {{ $service->processLabel() }}</p>
            <div class="sp-hero__steps">
              @foreach($service->processSteps() as $step)
                <div class="sp-hero__step">
                  <div class="sp-hero__step-icon">
                    <img src="{{ $step['icon'] }}" alt="" width="56" height="56" loading="lazy">
                  </div>
                  <p class="sp-hero__step-text">{{ $step['text'] }}</p>
                </div>
              @endforeach
            </div>
          </div>

          <div class="sp-hero__features">
            @foreach($heroFeatures as $feature)
              <div class="sp-hero__feature">
                <span class="sp-hero__feature-icon" aria-hidden="true">✦</span>
                <div>
                  <strong>{{ $feature['title'] }}</strong>
                  <span>{{ $feature['text'] }}</span>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <aside class="sp-hero__aside sp-hero__aside--form">
          @include('front.partials.service-consultation-form', [
            'service' => $service,
            'states' => $states,
            'formSuffix' => 'hero',
            'showSuccess' => true,
          ])
        </aside>
      </div>
    </section>

    <section class="sp-trusted" aria-label="Trusted by brands">
      <div class="container sp-trusted__inner">
        <span class="sp-trusted__label">- TRUSTED BY</span>
        <img
          src="{{ asset('Image/cmplogo.png') }}"
          alt="LG, Exide, BlueStone, Fastrack, Croma, iBELL"
          class="sp-trusted__logos"
          width="1398"
          height="129"
          loading="lazy"
        >
      </div>
    </section>

    <section class="sp-tabs-wrap">
      <div class="container">
        <nav class="sp-tabs" aria-label="Service sections">
          @foreach($serviceTabs as $index => $tab)
            <a
              href="#{{ $tab['id'] }}"
              class="sp-tabs__item {{ $index === 0 ? 'sp-tabs__item--active' : '' }}"
              data-tab="{{ $tab['id'] }}"
            >
              {{ $tab['label'] }}
            </a>
          @endforeach
        </nav>
      </div>
    </section>

    <section class="sp-overview" id="overview">
      <div class="container">
        <div class="sp-overview__grid">
          <article class="sp-overview__article">
            <h2 class="sp-overview__title">Overview of {{ $service->name }}</h2>

            @if($service->long_description)
              <div class="sp-overview__body">
                {!! $service->long_description !!}
              </div>
            @endif

            @if($service->too_long_description)
              <div class="sp-overview__body sp-overview__body--extra" id="key-points">
                {!! $service->too_long_description !!}
              </div>
            @endif

            @if(! $service->long_description && ! $service->too_long_description)
              <div class="sp-overview__body">
                <p>{{ $service->heroDescription() }}</p>
              </div>
            @endif
          </article>

          <aside class="sp-overview__side">
            <div class="sp-overview__form-wrap">
              @include('front.partials.service-consultation-form', [
                'service' => $service,
                'states' => $states,
                'formSuffix' => 'sticky',
                'showSuccess' => false,
              ])
            </div>
          </aside>
        </div>
      </div>
    </section>

    @include('front.partials.footer')
  </main>
@endsection

@push('scripts')
  <script>
    document.querySelectorAll('.sp-tabs__item').forEach(function (tab) {
      tab.addEventListener('click', function (event) {
        const target = document.getElementById(this.getAttribute('data-tab'));
        if (!target) {
          return;
        }

        event.preventDefault();
        document.querySelectorAll('.sp-tabs__item').forEach(function (item) {
          item.classList.remove('sp-tabs__item--active');
        });
        this.classList.add('sp-tabs__item--active');
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
    });
  </script>
@endpush
