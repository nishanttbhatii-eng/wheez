@extends('front.layouts.app')

@push('styles')
  <link rel="stylesheet" href="{{ asset('vendor/slick/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/slick/slick-theme.css') }}">
  <link rel="stylesheet" href="{{ asset('css/home-new.css') }}">
@endpush

@section('content')
  @include('front.partials.header', ['activeNav' => $activeNav ?? 'home'])

  <main class="hn-page">

    {{-- Hero Banner --}}
    <section class="hn-hero">
      <div class="hn-hero__bg" aria-hidden="true"></div>
      <div class="container hn-hero__grid">
        <div class="hn-hero__content">
          <div class="hn-hero__ratings">
            <div class="hn-hero__avatars" aria-hidden="true">
              <img src="https://i.pravatar.cc/44?img=11" alt="" class="hn-hero__avatar">
              <img src="https://i.pravatar.cc/44?img=12" alt="" class="hn-hero__avatar">
              <img src="https://i.pravatar.cc/44?img=13" alt="" class="hn-hero__avatar">
              <img src="https://i.pravatar.cc/44?img=32" alt="" class="hn-hero__avatar">
            </div>
            <div class="hn-hero__stars" aria-hidden="true">★★★★★</div>
            <span class="hn-hero__rating-text">4.9 (1,200 reviews)</span>
          </div>

          <h1 class="hn-hero__title">{{ $service->name }}</h1>
          <p class="hn-hero__desc">
            {{ $service->heroDescription() }}
          </p>

          <div class="hn-hero__process">
            <p class="hn-hero__process-label">- {{ $service->processLabel() }}</p>
            <div class="hn-hero__steps">
              @foreach($processSteps as $step)
                <div class="hn-hero__step">
                  <div class="hn-hero__step-icon" aria-hidden="true">{!! $step['icon'] !!}</div>
                  <p class="hn-hero__step-text">{{ $step['text'] }}</p>
                </div>
              @endforeach
            </div>
          </div>

          <div class="hn-hero__features-wrap">
            <div class="hn-hero__features js-hero-features-slider">
              @foreach($heroFeatures as $feature)
                <div class="hn-hero__feature">
                  <span class="hn-hero__feature-icon" aria-hidden="true">✦</span>
                  <div>
                    <strong>{{ $feature['title'] }}</strong>
                    <span>{{ $feature['text'] }}</span>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>

        <aside class="hn-hero__aside">
          <form class="hn-consult hn-consult--hero" action="{{ route('services.enquire', $service->slug) }}" method="post" novalidate>
            @csrf
            <h2 class="hn-consult__title">Consultation by Expert</h2>

            @if(session('service_enquiry_success'))
              <div class="hn-consult__success" role="status">{{ session('service_enquiry_success') }}</div>
            @endif

            <div class="hn-consult__field">
              <input type="text" name="name" value="{{ old('name') }}" placeholder="Your Name" required>
              @error('name') <span class="hn-consult__error">{{ $message }}</span> @enderror
            </div>

            <div class="hn-consult__field">
              <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
              @error('email') <span class="hn-consult__error">{{ $message }}</span> @enderror
            </div>

            <div class="hn-consult__field">
              <div class="hn-consult__phone">
                <span class="hn-consult__phone-code" aria-hidden="true">🇮🇳 +91</span>
                <input type="tel" name="mobile" value="{{ old('mobile') }}" placeholder="Mobile Number" inputmode="numeric" maxlength="10" pattern="[0-9]{10}" required>
              </div>
              @error('mobile') <span class="hn-consult__error">{{ $message }}</span> @enderror
            </div>

            <div class="hn-consult__field">
              <select name="state" required>
                <option value="">Select State</option>
                @foreach($states as $state)
                  <option value="{{ $state }}" @selected(old('state') === $state)>{{ $state }}</option>
                @endforeach
              </select>
              @error('state') <span class="hn-consult__error">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn--accent hn-consult__submit">
              Get Started Now
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17L17 7"/><path d="M7 7h10v10"/></svg>
            </button>
            <p class="hn-consult__privacy">We'll never share your details with third parties. we won't spam you</p>
          </form>
        </aside>
      </div>
    </section>

    {{-- Trusted By (Slick) --}}
    <section class="hn-trusted" aria-label="Trusted by brands">
      <div class="container hn-trusted__inner">
        <span class="hn-trusted__label">- TRUSTED BY</span>
        <div class="hn-trusted__slider hn-trusted__slider--strip js-trusted-slider">
          @foreach([1, 2, 3, 4] as $i)
            <div class="hn-trusted__slide">
              <img
                src="{{ asset('Image/cmplogo.png') }}"
                alt="Trusted brands including Croma, iBELL, LG, Exide, BlueStone, Fastrack"
                width="1398"
                height="129"
                loading="lazy"
              >
            </div>
          @endforeach
        </div>
      </div>
    </section>

    {{-- Section Tabs --}}
    <section class="hn-tabs-wrap">
      <div class="container">
        <nav class="hn-tabs" aria-label="Page sections">
          @foreach($tabs as $index => $tab)
            <a
              href="#{{ $tab['id'] }}"
              class="hn-tabs__item {{ $index === 0 ? 'hn-tabs__item--active' : '' }}"
              data-tab="{{ $tab['id'] }}"
            >{{ $tab['label'] }}</a>
          @endforeach
        </nav>
      </div>
    </section>

    {{-- Main + Sidebar --}}
    <section class="hn-body">
      <div class="container hn-body__grid">

        <div class="hn-main">

          {{-- Overview content --}}
          <article class="hn-card" id="overview">
            <h1 class="hn-card__title">Overview of {{ $service->name }}</h1>
            <div class="hn-card__body hn-card__body--rich">
              {!! $overviewHtml !!}
            </div>
          </article>

          @if(!empty($extraHtml))
            <article class="hn-card">
              <h2 class="hn-card__title">More about {{ $service->name }}</h2>
              <div class="hn-card__body hn-card__body--rich">
                {!! $extraHtml !!}
              </div>
            </article>
          @endif

          @if(!empty($categories))
          {{-- Category cards --}}
          <div class="hn-categories js-category-slider" id="key-points">
            @foreach($categories as $category)
              <article class="hn-category-card">
                <h3 class="hn-category-card__title">{{ $category['title'] }}</h3>
                <p class="hn-category-card__text">{{ $category['text'] }}</p>
              </article>
            @endforeach
          </div>
          @else
            <div id="key-points"></div>
          @endif

          @if(!empty($checklist))
          {{-- Checklist --}}
          <article class="hn-card" id="documents">
            <h2 class="hn-card__title">Checklist for {{ $service->name }}</h2>
            <div class="hn-card__body">
              <ul class="hn-checklist">
                @foreach($checklist as $item)
                  <li>
                    <span class="hn-checklist__icon" aria-hidden="true">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                    </span>
                    <span>{{ $item }}</span>
                  </li>
                @endforeach
              </ul>
            </div>
          </article>
          @else
            <div id="documents"></div>
          @endif

          @if(!empty($downloadSteps))
          {{-- Download certificate --}}
          <article class="hn-dark-card">
            <h2 class="hn-dark-card__title">How to complete {{ $service->name }}?</h2>
            <p class="hn-dark-card__desc">Follow these steps with Whizseed expert support.</p>
            <ul class="hn-dark-steps">
              @foreach($downloadSteps as $step)
                <li>
                  <span class="hn-dark-steps__icon" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <span>{{ $step }}</span>
                </li>
              @endforeach
            </ul>
          </article>
          @endif

          @if($service->price > 0)
          <article class="hn-card" id="pricing">
            <h2 class="hn-card__title">Pricing</h2>
            <div class="hn-card__body">
              <p>
                Starting at
                <strong>₹{{ number_format((float) $service->price, 0) }}</strong>
                @if($service->mrp_price > $service->price)
                  <span style="text-decoration:line-through;opacity:.6;margin-left:.35rem">₹{{ number_format((float) $service->mrp_price, 0) }}</span>
                @endif
              </p>
            </div>
          </article>
          @endif

          {{-- FAQ --}}
          <article class="hn-card hn-faq" id="faq">
            <h2 class="hn-card__title">Frequently Asked Questions</h2>
            <div class="hn-faq__list">
              @foreach($faqs as $index => $faq)
                <div class="hn-faq__item {{ $index === 0 ? 'is-open' : '' }}">
                  <button type="button" class="hn-faq__question" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                    <span>{{ $faq['q'] }}</span>
                    <span class="hn-faq__icon" aria-hidden="true">+</span>
                  </button>
                  <div class="hn-faq__answer">
                    <p>{{ $faq['a'] }}</p>
                  </div>
                </div>
              @endforeach
            </div>
          </article>

          {{-- About author --}}
          <article class="hn-author">
            <div class="hn-author__media">
              <img
                src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=240&h=240&fit=crop&auto=format"
                alt="Whizseed Expert"
                width="120"
                height="120"
                loading="lazy"
              >
              <span class="hn-author__badge">Expert Guide</span>
            </div>
            <div class="hn-author__content">
              <h3 class="hn-author__name">Whizseed Content Team</h3>
              <p class="hn-author__meta">Updated {{ optional($service->updated_at)->format('M j, Y') }}</p>
              <p class="hn-author__bio">Practical guidance on Indian business registrations, compliance, and growth-ready legal foundations.</p>
            </div>
          </article>

          {{-- Client reviews (Slick) --}}
          <section class="hn-reviews" aria-label="Client reviews">
            <div class="hn-reviews__label">
              <span>— CLIENT REVIEWS —</span>
            </div>
            <h2 class="hn-reviews__heading">
              Clients Are Saying
              <span class="hn-reviews__square" aria-hidden="true"></span>
            </h2>
            <div class="hn-reviews__slider js-reviews-slider">
              @foreach($reviews as $review)
                <div class="hn-review-card">
                  <div class="hn-review-card__bg">
                    <img src="{{ $review['image'] }}" alt="" loading="lazy">
                    <div class="hn-review-card__overlay"></div>
                  </div>
                  <div class="hn-review-card__content">
                    <p class="hn-review-card__text">"{{ $review['text'] }}"</p>
                    <div class="hn-review-card__divider"></div>
                    <div class="hn-review-card__footer">
                      <img src="{{ $review['avatar'] }}" alt="" class="hn-review-card__avatar" loading="lazy">
                      <div>
                        <span class="hn-review-card__badge">
                          <svg width="12" height="12" viewBox="0 0 24 24" fill="#34a853"><path d="M21.35 11.1h-9.17v2.73h5.51a6.19 6.19 0 01-2.68 4.05v3.37h4.34a10.91 10.91 0 003.97-8.5c0-.57-.05-1.13-.14-1.66z"/><path d="M12.18 21.3a10.8 10.8 0 007.4-2.72l-4.34-3.37a6.84 6.84 0 01-10.22-3.59H4.6v3.48a10.8 10.8 0 007.58 6.2z"/><path d="M5.02 13.62a6.72 6.72 0 010-4.28V5.86H4.6a10.8 10.8 0 000 9.48l.42-1.72z"/><path d="M12.18 4.78a6.1 6.1 0 014.3 1.68l3.23-3.23A10.8 10.8 0 0012.18 1 10.8 10.8 0 004.6 5.86l.42 3.48a6.72 6.72 0 017.16-4.56z"/></svg>
                          Google
                        </span>
                        <span class="hn-review-card__name">{{ $review['name'] }}</span>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </section>

        </div>

        {{-- Sticky Sidebar --}}
        <aside class="hn-side">
          <div class="hn-side__sticky">

            <form class="hn-consult" action="{{ route('services.enquire', $service->slug) }}" method="post" novalidate>
              @csrf
              <h2 class="hn-consult__title">Consultation by Expert</h2>

              @if(session('service_enquiry_success'))
                <div class="hn-consult__success" role="status">{{ session('service_enquiry_success') }}</div>
              @endif

              <div class="hn-consult__field">
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Your Name" required>
                @error('name') <span class="hn-consult__error">{{ $message }}</span> @enderror
              </div>

              <div class="hn-consult__field">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
                @error('email') <span class="hn-consult__error">{{ $message }}</span> @enderror
              </div>

              <div class="hn-consult__field">
                <div class="hn-consult__phone">
                  <span class="hn-consult__phone-code" aria-hidden="true">🇮🇳 +91</span>
                  <input type="tel" name="mobile" value="{{ old('mobile') }}" placeholder="Mobile Number" inputmode="numeric" maxlength="10" pattern="[0-9]{10}" required>
                </div>
                @error('mobile') <span class="hn-consult__error">{{ $message }}</span> @enderror
              </div>

              <div class="hn-consult__field">
                <select name="state" required>
                  <option value="">Select State</option>
                  @foreach($states as $state)
                    <option value="{{ $state }}" @selected(old('state') === $state)>{{ $state }}</option>
                  @endforeach
                </select>
                @error('state') <span class="hn-consult__error">{{ $message }}</span> @enderror
              </div>

              <button type="submit" class="btn btn--accent hn-consult__submit">
                Get Started Now
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17L17 7"/><path d="M7 7h10v10"/></svg>
              </button>
              <p class="hn-consult__privacy">We'll never share your details with third parties. we won't spam you</p>
            </form>

            <div class="hn-agent">
              <div class="hn-agent__top">
                <img
                  src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=96&h=96&fit=crop&auto=format"
                  alt="{{ $callerName }}"
                  class="hn-agent__avatar"
                  width="48"
                  height="48"
                  loading="lazy"
                >
                <div class="hn-agent__info">
                  <div class="hn-agent__name-row">
                    <span class="hn-agent__name">{{ $callerName }}</span>
                    <span class="hn-agent__status"><i></i> Online</span>
                  </div>
                  <div class="hn-agent__rating" aria-label="Rated 4.0 out of 5">
                    <span>★★★★</span><span class="hn-agent__rating-empty">★</span>
                    <span class="hn-agent__rating-value">(4.0)</span>
                  </div>
                </div>
              </div>
              @if(!empty($callerDescription))
                <p class="hn-agent__desc" style="font-size:.85rem;color:#666;margin:.75rem 0 0">{!! strip_tags($callerDescription, '<br><strong><em><p>') !!}</p>
              @endif
              <div class="hn-agent__actions">
                <a href="tel:9625432342" class="hn-agent__btn">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="#e91e63"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                  Call US Now
                </a>
                <a href="https://wa.me/919625432342" class="hn-agent__btn" target="_blank" rel="noopener">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="#25d366"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                  Chat With Us
                </a>
              </div>
            </div>

            <div class="hn-other">
              <h3 class="hn-other__title">Other Services</h3>
              <div class="hn-other__tags">
                @foreach($otherServices as $related)
                  <a href="{{ route('services.show', $related->slug) }}" class="hn-other__tag">{{ $related->name }}</a>
                @endforeach
              </div>
            </div>

          </div>
        </aside>
      </div>
    </section>

    {{-- Newsletter --}}
    <section class="newsletter hn-newsletter">
      <div class="newsletter__bg-text" aria-hidden="true">WHIZSEED</div>
      <div class="newsletter__divider"></div>
      <div class="container">
        <div class="newsletter__inner hn-newsletter__inner">
          <div class="hn-newsletter__left">
            <div class="hn-newsletter__icon" aria-hidden="true">
              <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                <path d="M6 14h28v18a2 2 0 01-2 2H8a2 2 0 01-2-2V14z" stroke="currentColor" stroke-width="2"/>
                <path d="M6 14l14 10L34 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14 8h12M16 4h8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </div>
            <div class="hn-newsletter__copy">
              <h2 class="newsletter__heading">Subscribe to our Newsletter</h2>
              <p class="newsletter__desc">Stay updated with all the latest legal updates. Just enter your email address and subscribe for free!</p>
            </div>
          </div>
          <div class="newsletter__right">
            <form class="newsletter__form">
              <input type="email" class="newsletter__input" placeholder="Enter your email address" required>
              <button type="submit" class="newsletter__btn">
                Subscribe
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M7 17L17 7"/><path d="M7 7h10v10"/>
                </svg>
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>

    @include('front.partials.footer')
  </main>
@endsection

@push('scripts')
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/slick/slick.min.js') }}"></script>
  <script src="{{ asset('js/home-new.js') }}"></script>
@endpush
