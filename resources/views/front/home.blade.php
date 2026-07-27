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
            <a href="{{ route('services') }}" class="btn btn--accent">
              Get Started Now
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17L17 7M17 7H7M17 7v10"/></svg>
            </a>
            <a href="https://wa.me/919625432342" class="btn btn--outline" target="_blank" rel="noopener">
              Talk to Expert
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
          <div class="papers-stack" aria-hidden="true">

            <div class="paper paper--back-3">
              <span class="paper__ghost-label">CERTIFICATE</span>
              <div class="paper__back-divider"></div>
              <div class="paper__back-line"></div>
              <div class="paper__back-line paper__back-line--w60"></div>
              <div class="paper__back-line paper__back-line--w40"></div>
            </div>

            <div class="paper paper--back-2">
              <span class="paper__ghost-label">RECEIPT NO</span>
              <div class="paper__back-divider"></div>
              <div class="paper__back-line"></div>
              <div class="paper__back-line paper__back-line--w55"></div>
              <div class="paper__back-divider"></div>
              <div class="paper__back-line paper__back-line--w70"></div>
              <div class="paper__back-line paper__back-line--w45"></div>
            </div>

            <div class="paper paper--back-1">
              <span class="paper__ghost-label">GST REG</span>
              <div class="paper__back-divider"></div>
              <div class="paper__back-line"></div>
              <div class="paper__back-line paper__back-line--w60"></div>
              <div class="paper__back-divider"></div>
              <div class="paper__back-line paper__back-line--w40"></div>
              <div class="paper__back-line paper__back-line--w75"></div>
            </div>

            <div class="paper paper--front">
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

    <section class="trusted-marquee" aria-label="Trusted by brands">
      <div class="trusted-marquee__track">
        <div class="trusted-marquee__group">
          <img src="{{ asset('Image/cmplogo.png') }}" alt="BlueStone, Fastrack, Croma, iBELL, LG, Exide, Corporal" class="trusted-marquee__logos" width="1398" height="129" loading="lazy">
        </div>
        <div class="trusted-marquee__group" aria-hidden="true">
          <img src="{{ asset('Image/cmplogo.png') }}" alt="" class="trusted-marquee__logos" width="1398" height="129" loading="lazy">
        </div>
      </div>
    </section>

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

          <article class="features__card features__card--dark">
            <div class="features__stat">
              <span class="features__stat-label">BUSINESS EMPOWERED</span>
              <span class="features__stat-value">70+</span>
            </div>
            <div class="features__stat">
              <span class="features__stat-label">OF INDUSTRY EXPERIENCE</span>
              <span class="features__stat-value">5+ Year</span>
            </div>
            <div class="features__stat">
              <span class="features__stat-label">CLIENT SATISFACTION</span>
              <span class="features__stat-value">98%</span>
            </div>
          </article>
        </div>
      </div>
    </section>

    <section class="services">
      <div class="container">
        <div class="services__label">
          <span class="services__label-text">- SERVICES</span>
          <span class="services__label-line"></span>
        </div>
        <h2 class="services__heading">
          We Provide Best Quality
          <span class="services__heading-row">
            Services
            <span class="services__heading-square"></span>
          </span>
        </h2>
        <div class="services__grid">
          <div class="services__left">
            <div class="services__image">
              <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=600&h=500&fit=crop&auto=format" alt="Services">
            </div>
          </div>
          <div class="services__right">
            <p class="services__desc">
              From your first incorporation to your hundredth filing, Whizseed handles the paperwork, deadlines, and regulatory complexity — so you can stay focused on building.
            </p>
            <ul class="services__icon-list">
              <li><span class="services__icon-check">✓</span> Company Registration</li>
              <li><span class="services__icon-check">✓</span> GST &amp; Tax Filing</li>
              <li><span class="services__icon-check">✓</span> Trademark &amp; IP</li>
              <li><span class="services__icon-check">✓</span> FSSAI License</li>
              <li><span class="services__icon-check">✓</span> ISO Certification</li>
              <li><span class="services__icon-check">✓</span> Annual Compliance</li>
              <li><span class="services__icon-check">✓</span> Import Export Code</li>
              <li><span class="services__icon-check">✓</span> NGO Registration</li>
            </ul>
            <a href="{{ route('services') }}" class="btn btn--accent services__btn">
              Get Started Now
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
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
            <div class="process__illustration">
              <svg width="180" height="160" viewBox="0 0 180 160" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="50" y="80" width="80" height="50" rx="6" fill="currentColor" opacity="0.12"/>
                <rect x="55" y="100" width="15" height="10" rx="2" fill="currentColor" opacity="0.15"/>
                <rect x="110" y="100" width="15" height="10" rx="2" fill="currentColor" opacity="0.15"/>
                <rect x="55" y="85" width="70" height="8" rx="2" fill="currentColor" opacity="0.1"/>
                <circle cx="70" cy="55" r="22" fill="currentColor" opacity="0.1"/>
                <circle cx="70" cy="55" r="14" fill="currentColor" opacity="0.06"/>
                <rect x="55" y="68" width="30" height="14" rx="7" fill="currentColor" opacity="0.08"/>
                <rect x="130" y="50" width="36" height="50" rx="4" fill="currentColor" opacity="0.08"/>
                <rect x="134" y="54" width="4" height="4" rx="1" fill="currentColor" opacity="0.12"/>
                <rect x="142" y="54" width="4" height="4" rx="1" fill="currentColor" opacity="0.12"/>
                <rect x="150" y="54" width="4" height="4" rx="1" fill="currentColor" opacity="0.12"/>
                <rect x="134" y="62" width="20" height="3" rx="1" fill="currentColor" opacity="0.1"/>
                <rect x="134" y="68" width="16" height="3" rx="1" fill="currentColor" opacity="0.1"/>
                <rect x="134" y="74" width="24" height="3" rx="1" fill="currentColor" opacity="0.1"/>
                <rect x="134" y="80" width="18" height="3" rx="1" fill="currentColor" opacity="0.1"/>
                <rect x="134" y="86" width="22" height="3" rx="1" fill="currentColor" opacity="0.1"/>
                <rect x="134" y="92" width="14" height="3" rx="1" fill="currentColor" opacity="0.1"/>
              </svg>
            </div>
            <h3 class="process__title">Choose Your<br>Service</h3>
            <p class="process__desc">Browse our comprehensive list of services and select what your business needs — from registration to compliance.</p>
          </div>
          <div class="process__card">
            <span class="process__number">02</span>
            <div class="process__illustration">
              <svg width="180" height="160" viewBox="0 0 180 160" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="30" y="50" width="60" height="70" rx="6" fill="currentColor" opacity="0.08"/>
                <rect x="36" y="60" width="48" height="6" rx="2" fill="currentColor" opacity="0.12"/>
                <rect x="36" y="72" width="40" height="4" rx="1" fill="currentColor" opacity="0.1"/>
                <rect x="36" y="82" width="44" height="4" rx="1" fill="currentColor" opacity="0.1"/>
                <rect x="36" y="92" width="36" height="4" rx="1" fill="currentColor" opacity="0.1"/>
                <rect x="36" y="102" width="42" height="4" rx="1" fill="currentColor" opacity="0.1"/>
                <circle cx="60" cy="38" r="16" fill="currentColor" opacity="0.08"/>
                <rect x="120" y="55" width="40" height="40" rx="6" fill="currentColor" opacity="0.09"/>
                <rect x="126" y="62" width="28" height="4" rx="1" fill="currentColor" opacity="0.13"/>
                <rect x="126" y="70" width="22" height="4" rx="1" fill="currentColor" opacity="0.11"/>
                <rect x="126" y="78" width="26" height="4" rx="1" fill="currentColor" opacity="0.11"/>
                <circle cx="140" cy="45" r="14" fill="currentColor" opacity="0.07"/>
                <rect x="124" y="46" width="32" height="8" rx="4" fill="currentColor" opacity="0.1"/>
                <rect x="130" y="32" width="20" height="12" rx="3" fill="currentColor" opacity="0.08"/>
              </svg>
            </div>
            <h3 class="process__title">Share Your<br>Details</h3>
            <p class="process__desc">Fill in a simple form with your business information. Our experts will review and guide you through the requirements.</p>
          </div>
          <div class="process__card">
            <span class="process__number">03</span>
            <div class="process__illustration">
              <svg width="180" height="160" viewBox="0 0 180 160" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="55" cy="52" r="14" fill="currentColor" opacity="0.08"/>
                <rect x="40" y="66" width="30" height="50" rx="8" fill="currentColor" opacity="0.08"/>
                <circle cx="95" cy="52" r="14" fill="currentColor" opacity="0.09"/>
                <rect x="80" y="66" width="30" height="50" rx="8" fill="currentColor" opacity="0.09"/>
                <circle cx="135" cy="52" r="14" fill="currentColor" opacity="0.07"/>
                <rect x="120" y="66" width="30" height="50" rx="8" fill="currentColor" opacity="0.07"/>
                <rect x="50" y="122" width="80" height="8" rx="3" fill="currentColor" opacity="0.06"/>
                <rect x="60" y="134" width="60" height="6" rx="3" fill="currentColor" opacity="0.05"/>
                <rect x="38" y="118" width="104" height="2" fill="currentColor" opacity="0.04"/>
              </svg>
            </div>
            <h3 class="process__title">We Handle<br>The Rest</h3>
            <p class="process__desc">Our team of professionals takes care of all documentation, filings, and government interactions on your behalf.</p>
          </div>
          <div class="process__card">
            <span class="process__number">04</span>
            <div class="process__illustration">
              <svg width="180" height="160" viewBox="0 0 180 160" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="55" y="40" width="70" height="50" rx="6" fill="currentColor" opacity="0.09"/>
                <rect x="60" y="45" width="60" height="36" rx="3" fill="currentColor" opacity="0.05"/>
                <rect x="62" y="48" width="56" height="3" rx="1" fill="currentColor" opacity="0.12"/>
                <rect x="62" y="55" width="40" height="2" rx="1" fill="currentColor" opacity="0.1"/>
                <rect x="62" y="61" width="48" height="2" rx="1" fill="currentColor" opacity="0.1"/>
                <rect x="62" y="67" width="36" height="2" rx="1" fill="currentColor" opacity="0.1"/>
                <rect x="55" y="90" width="70" height="16" rx="3" fill="currentColor" opacity="0.06"/>
                <rect x="60" y="94" width="60" height="4" rx="1" fill="currentColor" opacity="0.1"/>
                <rect x="60" y="100" width="40" height="3" rx="1" fill="currentColor" opacity="0.08"/>
                <circle cx="90" cy="28" r="14" fill="currentColor" opacity="0.07"/>
                <rect x="76" y="30" width="28" height="8" rx="4" fill="currentColor" opacity="0.09"/>
                <rect x="82" y="18" width="16" height="10" rx="3" fill="currentColor" opacity="0.07"/>
              </svg>
            </div>
            <h3 class="process__title">Track &amp;<br>Receive</h3>
            <p class="process__desc">Monitor progress through your dashboard and receive all certificates and documents delivered digitally.</p>
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
            <a href="#" class="btn btn--accent global__btn">
              Get Started Now
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          </div>
        </div>
      </div>
    </section>

    <section class="testimonials">
      <div class="testimonials__bg-text" aria-hidden="true">WHIZSEED</div>
      <div class="container">
        <div class="testimonials__label">
          <span class="testimonials__label-dash">—</span>
          <span class="testimonials__label-text">CLIENT REVIEWS</span>
          <span class="testimonials__label-line"></span>
        </div>
        <h2 class="testimonials__heading">
          <span class="testimonials__heading-row">
            Here's What Our
          </span>
          <span class="testimonials__heading-row">
            Amazing Clients
            <span class="testimonials__heading-star">★</span>
          </span>
          <span class="testimonials__heading-row">
            Are Saying
          </span>
        </h2>
      </div>
      <div class="testimonials__wrapper">
        <div class="testimonials__track" id="testimonialsTrack">

          <div class="testimonial-card">
            <div class="testimonial-card__bg">
              <div class="testimonial-card__overlay"></div>
              <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=520&fit=crop&auto=format" alt="Client" loading="lazy">
            </div>
            <div class="testimonial-card__content">
              <p class="testimonial-card__text">"WhizSeed made company registration effortless. Their team guided us through every step with professionalism."</p>
              <div class="testimonial-card__divider"></div>
              <div class="testimonial-card__footer">
                <div class="testimonial-card__footer-left">
                  <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=48&h=48&fit=crop&auto=format" alt="" class="testimonial-card__avatar" loading="lazy">
                  <div class="testimonial-card__info">
                    <span class="testimonial-card__name">Rahul Sharma</span>
                    <span class="testimonial-card__role">Founder, TechVentures</span>
                  </div>
                </div>
                <div class="testimonial-card__footer-right">
                  <span class="testimonial-card__badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="#34a853"><path d="M21.35 11.1h-9.17v2.73h5.51a6.19 6.19 0 01-2.68 4.05v3.37h4.34a10.91 10.91 0 003.97-8.5c0-.57-.05-1.13-.14-1.66z"/><path d="M12.18 21.3a10.8 10.8 0 007.4-2.72l-4.34-3.37a6.84 6.84 0 01-10.22-3.59H4.6v3.48a10.8 10.8 0 007.58 6.2z"/><path d="M5.02 13.62a6.72 6.72 0 010-4.28V5.86H4.6a10.8 10.8 0 000 9.48l.42-1.72z"/><path d="M12.18 4.78a6.1 6.1 0 014.3 1.68l3.23-3.23A10.8 10.8 0 0012.18 1 10.8 10.8 0 004.6 5.86l.42 3.48a6.72 6.72 0 017.16-4.56z"/></svg>
                    Google
                  </span>
                  <span class="testimonial-card__rating">★★★★★</span>
                </div>
              </div>
            </div>
          </div>

          <div class="testimonial-card">
            <div class="testimonial-card__bg">
              <div class="testimonial-card__overlay"></div>
              <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=520&fit=crop&auto=format" alt="Client" loading="lazy">
            </div>
            <div class="testimonial-card__content">
              <p class="testimonial-card__text">"The GST filing process used to be a nightmare. WhizSeed automated everything and saved us hours of work."</p>
              <div class="testimonial-card__divider"></div>
              <div class="testimonial-card__footer">
                <div class="testimonial-card__footer-left">
                  <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=48&h=48&fit=crop&auto=format" alt="" class="testimonial-card__avatar" loading="lazy">
                  <div class="testimonial-card__info">
                    <span class="testimonial-card__name">Priya Patel</span>
                    <span class="testimonial-card__role">CEO, GreenEarth Co.</span>
                  </div>
                </div>
                <div class="testimonial-card__footer-right">
                  <span class="testimonial-card__badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="#34a853"><path d="M21.35 11.1h-9.17v2.73h5.51a6.19 6.19 0 01-2.68 4.05v3.37h4.34a10.91 10.91 0 003.97-8.5c0-.57-.05-1.13-.14-1.66z"/><path d="M12.18 21.3a10.8 10.8 0 007.4-2.72l-4.34-3.37a6.84 6.84 0 01-10.22-3.59H4.6v3.48a10.8 10.8 0 007.58 6.2z"/><path d="M5.02 13.62a6.72 6.72 0 010-4.28V5.86H4.6a10.8 10.8 0 000 9.48l.42-1.72z"/><path d="M12.18 4.78a6.1 6.1 0 014.3 1.68l3.23-3.23A10.8 10.8 0 0012.18 1 10.8 10.8 0 004.6 5.86l.42 3.48a6.72 6.72 0 017.16-4.56z"/></svg>
                    Google
                  </span>
                  <span class="testimonial-card__rating">★★★★★</span>
                </div>
              </div>
            </div>
          </div>

          <div class="testimonial-card">
            <div class="testimonial-card__bg">
              <div class="testimonial-card__overlay"></div>
              <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&h=520&fit=crop&auto=format" alt="Client" loading="lazy">
            </div>
            <div class="testimonial-card__content">
              <p class="testimonial-card__text">"Outstanding support for trademark registration. They handled everything from search to filing seamlessly."</p>
              <div class="testimonial-card__divider"></div>
              <div class="testimonial-card__footer">
                <div class="testimonial-card__footer-left">
                  <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=48&h=48&fit=crop&auto=format" alt="" class="testimonial-card__avatar" loading="lazy">
                  <div class="testimonial-card__info">
                    <span class="testimonial-card__name">Arjun Mehta</span>
                    <span class="testimonial-card__role">Director, InnovateLabs</span>
                  </div>
                </div>
                <div class="testimonial-card__footer-right">
                  <span class="testimonial-card__badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="#34a853"><path d="M21.35 11.1h-9.17v2.73h5.51a6.19 6.19 0 01-2.68 4.05v3.37h4.34a10.91 10.91 0 003.97-8.5c0-.57-.05-1.13-.14-1.66z"/><path d="M12.18 21.3a10.8 10.8 0 007.4-2.72l-4.34-3.37a6.84 6.84 0 01-10.22-3.59H4.6v3.48a10.8 10.8 0 007.58 6.2z"/><path d="M5.02 13.62a6.72 6.72 0 010-4.28V5.86H4.6a10.8 10.8 0 000 9.48l.42-1.72z"/><path d="M12.18 4.78a6.1 6.1 0 014.3 1.68l3.23-3.23A10.8 10.8 0 0012.18 1 10.8 10.8 0 004.6 5.86l.42 3.48a6.72 6.72 0 017.16-4.56z"/></svg>
                    Google
                  </span>
                  <span class="testimonial-card__rating">★★★★★</span>
                </div>
              </div>
            </div>
          </div>

          <div class="testimonial-card">
            <div class="testimonial-card__bg">
              <div class="testimonial-card__overlay"></div>
              <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&h=520&fit=crop&auto=format" alt="Client" loading="lazy">
            </div>
            <div class="testimonial-card__content">
              <p class="testimonial-card__text">"WhizSeed's compliance monitoring saved us from a major regulatory pitfall. Highly recommend their annual retainer."</p>
              <div class="testimonial-card__divider"></div>
              <div class="testimonial-card__footer">
                <div class="testimonial-card__footer-left">
                  <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=48&h=48&fit=crop&auto=format" alt="" class="testimonial-card__avatar" loading="lazy">
                  <div class="testimonial-card__info">
                    <span class="testimonial-card__name">Ananya Reddy</span>
                    <span class="testimonial-card__role">COO, MedTech Solutions</span>
                  </div>
                </div>
                <div class="testimonial-card__footer-right">
                  <span class="testimonial-card__badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="#34a853"><path d="M21.35 11.1h-9.17v2.73h5.51a6.19 6.19 0 01-2.68 4.05v3.37h4.34a10.91 10.91 0 003.97-8.5c0-.57-.05-1.13-.14-1.66z"/><path d="M12.18 21.3a10.8 10.8 0 007.4-2.72l-4.34-3.37a6.84 6.84 0 01-10.22-3.59H4.6v3.48a10.8 10.8 0 007.58 6.2z"/><path d="M5.02 13.62a6.72 6.72 0 010-4.28V5.86H4.6a10.8 10.8 0 000 9.48l.42-1.72z"/><path d="M12.18 4.78a6.1 6.1 0 014.3 1.68l3.23-3.23A10.8 10.8 0 0012.18 1 10.8 10.8 0 004.6 5.86l.42 3.48a6.72 6.72 0 017.16-4.56z"/></svg>
                    Google
                  </span>
                  <span class="testimonial-card__rating">★★★★★</span>
                </div>
              </div>
            </div>
          </div>

          <div class="testimonial-card">
            <div class="testimonial-card__bg">
              <div class="testimonial-card__overlay"></div>
              <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=520&fit=crop&auto=format" alt="Client" loading="lazy">
            </div>
            <div class="testimonial-card__content">
              <p class="testimonial-card__text">"Setting up our subsidiary in India was complex. WhizSeed made it simple with expert legal and tax guidance."</p>
              <div class="testimonial-card__divider"></div>
              <div class="testimonial-card__footer">
                <div class="testimonial-card__footer-left">
                  <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=48&h=48&fit=crop&auto=format" alt="" class="testimonial-card__avatar" loading="lazy">
                  <div class="testimonial-card__info">
                    <span class="testimonial-card__name">Vikram Joshi</span>
                    <span class="testimonial-card__role">VP, GlobalOps Inc.</span>
                  </div>
                </div>
                <div class="testimonial-card__footer-right">
                  <span class="testimonial-card__badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="#34a853"><path d="M21.35 11.1h-9.17v2.73h5.51a6.19 6.19 0 01-2.68 4.05v3.37h4.34a10.91 10.91 0 003.97-8.5c0-.57-.05-1.13-.14-1.66z"/><path d="M12.18 21.3a10.8 10.8 0 007.4-2.72l-4.34-3.37a6.84 6.84 0 01-10.22-3.59H4.6v3.48a10.8 10.8 0 007.58 6.2z"/><path d="M5.02 13.62a6.72 6.72 0 010-4.28V5.86H4.6a10.8 10.8 0 000 9.48l.42-1.72z"/><path d="M12.18 4.78a6.1 6.1 0 014.3 1.68l3.23-3.23A10.8 10.8 0 0012.18 1 10.8 10.8 0 004.6 5.86l.42 3.48a6.72 6.72 0 017.16-4.56z"/></svg>
                    Google
                  </span>
                  <span class="testimonial-card__rating">★★★★★</span>
                </div>
              </div>
            </div>
          </div>

          <div class="testimonial-card">
            <div class="testimonial-card__bg">
              <div class="testimonial-card__overlay"></div>
              <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=400&h=520&fit=crop&auto=format" alt="Client" loading="lazy">
            </div>
            <div class="testimonial-card__content">
              <p class="testimonial-card__text">"From incorporation to trademark, WhizSeed handled our entire IP portfolio. Their dashboard is incredibly intuitive."</p>
              <div class="testimonial-card__divider"></div>
              <div class="testimonial-card__footer">
                <div class="testimonial-card__footer-left">
                  <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=48&h=48&fit=crop&auto=format" alt="" class="testimonial-card__avatar" loading="lazy">
                  <div class="testimonial-card__info">
                    <span class="testimonial-card__name">Neha Kapoor</span>
                    <span class="testimonial-card__role">Founder, StyleCraft</span>
                  </div>
                </div>
                <div class="testimonial-card__footer-right">
                  <span class="testimonial-card__badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="#34a853"><path d="M21.35 11.1h-9.17v2.73h5.51a6.19 6.19 0 01-2.68 4.05v3.37h4.34a10.91 10.91 0 003.97-8.5c0-.57-.05-1.13-.14-1.66z"/><path d="M12.18 21.3a10.8 10.8 0 007.4-2.72l-4.34-3.37a6.84 6.84 0 01-10.22-3.59H4.6v3.48a10.8 10.8 0 007.58 6.2z"/><path d="M5.02 13.62a6.72 6.72 0 010-4.28V5.86H4.6a10.8 10.8 0 000 9.48l.42-1.72z"/><path d="M12.18 4.78a6.1 6.1 0 014.3 1.68l3.23-3.23A10.8 10.8 0 0012.18 1 10.8 10.8 0 004.6 5.86l.42 3.48a6.72 6.72 0 017.16-4.56z"/></svg>
                    Google
                  </span>
                  <span class="testimonial-card__rating">★★★★★</span>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="testimonials__controls">
          <button class="testimonials__arrow testimonials__arrow--prev" aria-label="Previous">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
          </button>
          <div class="testimonials__dots"></div>
          <button class="testimonials__arrow testimonials__arrow--next" aria-label="Next">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
          </button>
        </div>
      </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter">
      <div class="newsletter__bg-text" aria-hidden="true">WHIZSEED</div>
      <div class="newsletter__divider"></div>
      <div class="container">
        <div class="newsletter__inner">
          <div class="newsletter__left">
            <div class="newsletter__icon">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="4" width="20" height="16" rx="2"/>
                <path d="M22 7l-10 7L2 7"/>
              </svg>
            </div>
            <h2 class="newsletter__heading">Subscribe to our Newsletter</h2>
            <p class="newsletter__desc">Stay updated with all the latest legal updates. Just enter your email address and subscribe for free!</p>
          </div>
          <div class="newsletter__right">
            <form class="newsletter__form">
              <input type="email" class="newsletter__input" placeholder="Enter your email address" required>
              <button type="submit" class="newsletter__btn">
                Subscribe
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M5 12h14M12 5l7 7-7 7"/>
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

