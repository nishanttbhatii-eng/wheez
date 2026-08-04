@extends('front.layouts.app')

@section('content')
  @include('front.partials.header', ['activeNav' => $activeNav ?? 'home'])

  <main>

    <section class="hero">
      <div class="container hero__grid">

        <div class="hero__content">
          <div class="hero__heading">
            <h1 class="hero__title">
              <span class="hero__title-line hero__title-line--1">One-Stop Destination</span>
              <span class="hero__title-line hero__title-line--2">
                For All Your
                <span class="hero__title-highlight-wrapper">
                  <span class="hero__title-highlight-bg"></span>
                  <span class="hero__title-highlight">Business</span>
                </span>
              </span>
            </h1>
          </div>
          <p class="hero__desc">
            {{ $heroDescription }}
          </p>
          <div class="hero__cta">
            <a href="#consult" class="btn btn--accent js-open-consult">
              {{ __('ui.get_started') }}
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17L17 7M17 7H7M17 7v10"/></svg>
            </a>
            <a href="https://wa.me/919625432342?text={{ urlencode(__('ui.wa_prefill')) }}" class="btn btn--outline" target="_blank" rel="noopener">
              {{ __('ui.talk_to_expert') }}
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17L17 7M17 7H7M17 7v10"/></svg>
            </a>
          </div>
          <div class="hero__ratings">
            <div class="hero__avatars">
              <img src="https://i.pravatar.cc/44?img=11" alt="" class="hero__avatar">
              <img src="https://i.pravatar.cc/44?img=12" alt="" class="hero__avatar">
              <img src="https://i.pravatar.cc/44?img=13" alt="" class="hero__avatar">
              <img src="https://i.pravatar.cc/44?img=32" alt="" class="hero__avatar">
            </div>
            <div class="hero__stars" aria-hidden="true">
              <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
            </div>
            <span class="hero__rating-text">4.9 (1,200 reviews)</span>
          </div>
          <div class="hero__pills">
            <span class="pill">MSME Registration</span>
            <span class="pill">Private Limited</span>
            <span class="pill">Company Registration</span>
            <span class="pill">Trademark Assignment</span>
          </div>
        </div>

        <div class="hero__visual">
          <div class="hero__glow"></div>
          <div class="papers-stack js-papers-stack" aria-hidden="true">

            <div class="paper paper--cert" data-pos="3">
              <div class="paper__top-row">
                <div class="paper__badge">CERT</div>
                <div class="paper__approved">
                  <span class="paper__approved-text">ISSUED</span>
                  <span class="paper__approved-year">2024</span>
                </div>
              </div>
              <div class="paper__center">
                <span class="paper__title">ISO</span>
                <span class="paper__subtitle">CERTIFICATE</span>
              </div>
              <div class="paper__divider"></div>
              <div class="paper__meta">
                <span>Status: <strong class="paper__status-active">Active</strong></span>
                <span>Processing: <strong>10 Days</strong></span>
              </div>
            </div>

            <div class="paper paper--cert" data-pos="2">
              <div class="paper__top-row">
                <div class="paper__badge">RCP</div>
                <div class="paper__approved">
                  <span class="paper__approved-text">PAID</span>
                  <span class="paper__approved-year">2024</span>
                </div>
              </div>
              <div class="paper__center">
                <span class="paper__title">RECEIPT</span>
                <span class="paper__subtitle">NO. 4821</span>
              </div>
              <div class="paper__divider"></div>
              <div class="paper__meta">
                <span>Status: <strong class="paper__status-active">Active</strong></span>
                <span>Processing: <strong>2 Days</strong></span>
              </div>
            </div>

            <div class="paper paper--cert" data-pos="1">
              <div class="paper__top-row">
                <div class="paper__badge">GST</div>
                <div class="paper__approved">
                  <span class="paper__approved-text">APPROVED</span>
                  <span class="paper__approved-year">2024</span>
                </div>
              </div>
              <div class="paper__center">
                <span class="paper__title">GST</span>
                <span class="paper__subtitle">REGISTRATION</span>
              </div>
              <div class="paper__divider"></div>
              <div class="paper__meta">
                <span>Status: <strong class="paper__status-active">Active</strong></span>
                <span>Processing: <strong>7 Days</strong></span>
              </div>
            </div>

            <div class="paper paper--cert" data-pos="0">
              <div class="paper__top-row">
                <div class="paper__badge">INC</div>
                <div class="paper__approved">
                  <span class="paper__approved-text">APPROVED</span>
                  <span class="paper__approved-year">2024</span>
                </div>
              </div>
              <div class="paper__center">
                <span class="paper__title">PVT LTD</span>
                <span class="paper__subtitle">COMPANY</span>
              </div>
              <div class="paper__divider"></div>
              <div class="paper__meta">
                <span>Status: <strong class="paper__status-active">Active</strong></span>
                <span>Processing: <strong>14 Days</strong></span>
              </div>
            </div>

          </div>
        </div>

      </div>
    </section>

    @include('front.partials.trusted-marquee')

    <section class="why-choose">
      <div class="why-choose__glow"></div>
      <div class="container">
        <div class="why-choose__inner">
          <p class="why-choose__label">
            <span class="why-choose__dash" aria-hidden="true"></span>
            WHY CHOOSE WHIZSEED
            <span class="why-choose__dash" aria-hidden="true"></span>
          </p>
          <h2 class="why-choose__heading">
            Choose WhizSeed for all your business needs in India because we are your trusted partner in entrepreneurial success. Here's how we can help you
          </h2>
        </div>
      </div>
    </section>

    <section class="features">
      <div class="container">
        <div class="features__grid">
          <div class="features__cluster">
            <article class="features__card features__card--icon">
              <div class="features__card-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M7 15v-2M12 15V9M17 15v-4"/></svg>
              </div>
              <h3>Simplified Dashboard Experience</h3>
            </article>
            <article class="features__card features__card--icon">
              <div class="features__card-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/><circle cx="12" cy="12" r="3"/></svg>
              </div>
              <h3>Premium Expertise, Budget-Friendly Rates</h3>
            </article>
            <article class="features__card features__card--icon">
              <div class="features__card-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 1a4 4 0 014 4v3a4 4 0 01-8 0V5a4 4 0 014-4z"/><path d="M5 10a7 7 0 0014 0M12 17v4M8 21h8"/></svg>
              </div>
              <h3>Your Questions, Our Priority</h3>
            </article>
            <article class="features__card features__card--icon">
              <div class="features__card-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="3"/><path d="M5 20c1.5-3.5 4-5 7-5s5.5 1.5 7 5"/><path d="M4 10h2M18 10h2M5 4l1.5 1.5M19 4l-1.5 1.5"/></svg>
              </div>
              <h3>A Comprehensive Hub of Legal Experts</h3>
            </article>
          </div>

          <article class="features__card features__card--image features__card--hero-image">
            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=900&h=600&fit=crop&auto=format" alt="Team collaboration">
          </article>

          <article class="features__card features__card--image features__card--meeting">
            <img src="{{ asset('Image/team-meeting.jpg') }}" alt="Team meeting">
          </article>

          <article class="features__card features__card--accent features__card--bullets">
            <ul class="features__bullet-list">
              <li>
                <span class="features__check" aria-hidden="true">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <div>
                  <strong>Expert Guidance</strong>
                  <p>Benefit from our seasoned experts who provide tailored advice for your specific business goals.</p>
                </div>
              </li>
              <li>
                <span class="features__check" aria-hidden="true">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <div>
                  <strong>Comprehensive Services</strong>
                  <p>We offer a wide range of services, from company registration to financial planning, to meet all your business needs.</p>
                </div>
              </li>
              <li>
                <span class="features__check" aria-hidden="true">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <div>
                  <strong>Customized Solutions</strong>
                  <p>Our solutions are designed to address your unique challenges, ensuring your business thrives in the Indian market.</p>
                </div>
              </li>
              <li>
                <span class="features__check" aria-hidden="true">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <div>
                  <strong>Regulatory Compliance</strong>
                  <p>Stay on top of ever-changing regulations with our assistance, minimizing legal hassles for your business.</p>
                </div>
              </li>
              <li>
                <span class="features__check" aria-hidden="true">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <div>
                  <strong>Support at Every Step</strong>
                  <p>WhizSeed is with you from the inception of your business idea to its realization, providing constant support and guidance.</p>
                </div>
              </li>
            </ul>
          </article>

          @include('front.partials.stats-card')
        </div>
      </div>
    </section>

    <section class="services">
      <div class="container">
        <h2 class="services__heading">
          We Provide Best Quality
          <span class="services__heading-row">
            Services
            <span class="services__heading-square"></span>
          </span>
        </h2>
        <div class="services__grid">
          <div class="services__left">
            <div class="services__image js-services-images" aria-hidden="true">
              <img
                class="is-active"
                src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=900&h=720&fit=crop&auto=format"
                alt=""
                data-key="default"
                width="900"
                height="720"
              >
              <img
                src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=900&h=720&fit=crop&auto=format"
                alt=""
                data-key="company"
                width="900"
                height="720"
              >
              <img
                src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=900&h=720&fit=crop&auto=format"
                alt=""
                data-key="gst"
                width="900"
                height="720"
              >
              <img
                src="https://images.unsplash.com/photo-1563986768609-322da13575f3?w=900&h=720&fit=crop&auto=format"
                alt=""
                data-key="trademark"
                width="900"
                height="720"
              >
              <img
                src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=900&h=720&fit=crop&auto=format"
                alt=""
                data-key="fssai"
                width="900"
                height="720"
              >
              <img
                src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=900&h=720&fit=crop&auto=format"
                alt=""
                data-key="iso"
                width="900"
                height="720"
              >
              <img
                src="https://images.unsplash.com/photo-1556761175-b413da4baf72?w=900&h=720&fit=crop&auto=format"
                alt=""
                data-key="compliance"
                width="900"
                height="720"
              >
              <img
                src="https://images.unsplash.com/photo-1578574577315-3fbeb0cecdc2?w=900&h=720&fit=crop&auto=format"
                alt=""
                data-key="iec"
                width="900"
                height="720"
              >
              <img
                src="https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=900&h=720&fit=crop&auto=format"
                alt=""
                data-key="ngo"
                width="900"
                height="720"
              >
            </div>
          </div>
          <div class="services__right">
            <p class="services__desc">
              From your first incorporation to your hundredth filing, Whizseed handles the paperwork, deadlines, and regulatory complexity — so you can stay focused on building.
            </p>
            <ul class="services__list js-services-list">
              <li>
                <button type="button" class="services__item" data-image="company">
                  <span class="services__item-icon" aria-hidden="true">+</span>
                  <span class="services__item-text">Company Registration</span>
                </button>
              </li>
              <li>
                <button type="button" class="services__item" data-image="gst">
                  <span class="services__item-icon" aria-hidden="true">+</span>
                  <span class="services__item-text">GST &amp; Tax Filing</span>
                </button>
              </li>
              <li>
                <button type="button" class="services__item" data-image="trademark">
                  <span class="services__item-icon" aria-hidden="true">+</span>
                  <span class="services__item-text">Trademark &amp; IP</span>
                </button>
              </li>
              <li>
                <button type="button" class="services__item" data-image="fssai">
                  <span class="services__item-icon" aria-hidden="true">+</span>
                  <span class="services__item-text">FSSAI License</span>
                </button>
              </li>
              <li>
                <button type="button" class="services__item" data-image="iso">
                  <span class="services__item-icon" aria-hidden="true">+</span>
                  <span class="services__item-text">ISO Certification</span>
                </button>
              </li>
              <li>
                <button type="button" class="services__item" data-image="ngo">
                  <span class="services__item-icon" aria-hidden="true">+</span>
                  <span class="services__item-text">NGO Registration</span>
                </button>
              </li>
              <li>
                <button type="button" class="services__item" data-image="iec">
                  <span class="services__item-icon" aria-hidden="true">+</span>
                  <span class="services__item-text">Import Export Code</span>
                </button>
              </li>
              <li>
                <button type="button" class="services__item" data-image="compliance">
                  <span class="services__item-icon" aria-hidden="true">+</span>
                  <span class="services__item-text">Annual Compliance</span>
                </button>
              </li>
            </ul>
            <a href="#consult" class="btn btn--accent services__btn js-open-consult">
              {{ __('ui.get_started') }}
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17L17 7"/><path d="M7 7h10v10"/></svg>
            </a>
          </div>
        </div>
      </div>
    </section>

    <section class="how-it-works" id="how-it-works">
      <div class="container">
        <div class="how-it-works__label">
          <span class="how-it-works__label-text">- HOW IT WORKS</span>
          <span class="how-it-works__label-line"></span>
        </div>
        <h2 class="how-it-works__heading">
          Simple Process,
          <span class="how-it-works__heading-row">
            Powerful Results
            <span class="how-it-works__heading-square"></span>
          </span>
        </h2>
        <div class="process__grid">
          <div class="process__card">
            <span class="process__number">01</span>
            
            <h3 class="process__title">Choose Your<br>Service</h3>
            <p class="process__desc">Browse our comprehensive list of services and select what your business needs — from registration to compliance.</p>
            <div class="process__illustration">
              <img src="{{ asset('Image/service-1.png') }}" alt="Choose Your Service">
            </div>
          </div>
          <div class="process__card">
            <span class="process__number">02</span>
            
            <h3 class="process__title">Share Your<br>Details</h3>
            <p class="process__desc">Fill in a simple form with your business information. Our experts will review and guide you through the requirements.</p>
            <div class="process__illustration">
              <img src="{{ asset('Image/service-2.png') }}" alt="Share Your Details">
            </div>
          </div>
          <div class="process__card">
            <span class="process__number">03</span>
         
            <h3 class="process__title">We Handle<br>The Rest</h3>
            <p class="process__desc">Our team of professionals takes care of all documentation, filings, and government interactions on your behalf.</p>
            <div class="process__illustration">
              <img src="{{ asset('Image/service-3.png') }}" alt="We Handle The Rest">
            </div>
          </div>
          <div class="process__card">
            <span class="process__number">04</span>
           
            <h3 class="process__title">Track &amp;<br>Receive</h3>
            <p class="process__desc">Monitor progress through your dashboard and receive all certificates and documents delivered digitally.</p>
            <div class="process__illustration">
              <img src="{{ asset('Image/service-4.png') }}" alt="Track & Receive">
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="global" id="global">
      <div class="global__bg-glow"></div>
      <div class="container">
        <div class="global__label">
          <span class="global__label-text">- GLOBAL PRESENCE</span>
          <span class="global__label-line"></span>
        </div>
        <h2 class="global__heading">
          <span class="global__heading-row">
            The Backbone For
          </span>
          <span class="global__heading-row">
            Global Start Up
            <span class="global__heading-square"></span>
          </span>
        </h2>
        <div class="global__grid">
          <div class="global__left">
            <div class="global__glow-outer"></div>
            <div class="global__glow-inner"></div>
            <div class="global__globe-scene">
              <svg class="global__network" viewBox="0 0 380 380" aria-hidden="true">
                <path class="global__network-line global__network-line--1" d="M236 106 L304 171 L133 221" />
                <path class="global__network-line global__network-line--2" d="M106 144 L209 304" />
                <path class="global__network-line global__network-line--3" d="M296 171 L133 221 L209 304" />
              </svg>
              <div class="global__orbit-ring global__orbit-ring--1"></div>
              <div class="global__orbit-ring global__orbit-ring--2"></div>
              <div class="global__orbit-ring global__orbit-ring--3"></div>

              <span class="global__orbit-dot global__orbit-dot--1"></span>
              <span class="global__orbit-dot global__orbit-dot--2"></span>
              <span class="global__orbit-dot global__orbit-dot--3"></span>

              <div class="global__globe">
                <div class="global__globe-float">
                  <div class="global__globe-spin">
                    <div class="global__sphere" aria-hidden="true">
                      @for ($i = 0; $i < 12; $i++)
                        <div class="global__meridian" style="--rotation: {{ $i * 15 }}deg;"></div>
                      @endfor
                      @foreach ([72, 54, 36, 18, 0, -18, -36, -54, -72] as $lat)
                        <div class="global__parallel" style="--lat: {{ $lat }}deg;"></div>
                      @endforeach
                    </div>
                    <div class="global__globe-core"></div>
                  </div>
                </div>
              </div>

              <div class="global__pins" aria-hidden="true">
                <span class="global__pin global__pin--1"></span>
                <span class="global__pin global__pin--2"></span>
                <span class="global__pin global__pin--3"></span>
                <span class="global__pin global__pin--4"></span>
                <span class="global__pin global__pin--5"></span>
              </div>
            </div>
          </div>
          <div class="global__right">
            <p class="global__desc">
              WHIZSEED is the ultimate platform for aspiring entrepreneurs and startups. You can streamline your startup journey from ideation to execution.
            </p>
            <div class="global__countries">
              <div class="global__country" style="--delay: 0.05s">
                <span class="global__country-name">USA</span>
                <img class="global__country-flag" src="https://flagcdn.com/w40/us.png" alt="USA flag">
              </div>
              <div class="global__country" style="--delay: 0.1s">
                <span class="global__country-name">UK</span>
                <img class="global__country-flag" src="https://flagcdn.com/w40/gb.png" alt="UK flag">
              </div>
              <div class="global__country" style="--delay: 0.15s">
                <span class="global__country-name">CANADA</span>
                <img class="global__country-flag" src="https://flagcdn.com/w40/ca.png" alt="Canada flag">
              </div>
              <div class="global__country" style="--delay: 0.2s">
                <span class="global__country-name">AUSTRALIA</span>
                <img class="global__country-flag" src="https://flagcdn.com/w40/au.png" alt="Australia flag">
              </div>
              <div class="global__country" style="--delay: 0.25s">
                <span class="global__country-name">GERMANY</span>
                <img class="global__country-flag" src="https://flagcdn.com/w40/de.png" alt="Germany flag">
              </div>
              <div class="global__country" style="--delay: 0.3s">
                <span class="global__country-name">SINGAPORE</span>
                <img class="global__country-flag" src="https://flagcdn.com/w40/sg.png" alt="Singapore flag">
              </div>
              <div class="global__country" style="--delay: 0.35s">
                <span class="global__country-name">INDIA</span>
                <img class="global__country-flag" src="https://flagcdn.com/w40/in.png" alt="India flag">
              </div>
              <div class="global__country" style="--delay: 0.4s">
                <span class="global__country-name">UAE</span>
                <img class="global__country-flag" src="https://flagcdn.com/w40/ae.png" alt="UAE flag">
              </div>
              <div class="global__country" style="--delay: 0.45s">
                <span class="global__country-name">NETHERLANDS</span>
                <img class="global__country-flag" src="https://flagcdn.com/w40/nl.png" alt="Netherlands flag">
              </div>
              <div class="global__country" style="--delay: 0.5s">
                <span class="global__country-name">NEW ZEALAND</span>
                <img class="global__country-flag" src="https://flagcdn.com/w40/nz.png" alt="New Zealand flag">
              </div>
            </div>
            <a href="#consult" class="btn btn--accent global__btn js-open-consult">
              {{ __('ui.get_started') }}
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          </div>
        </div>
      </div>
    </section>

    @include('front.partials.client-reviews')

    @include('front.partials.newsletter')

    @include('front.partials.footer')
  </main>
@endsection

