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

          <h1 class="hn-hero__title">MSME Registration</h1>
          <p class="hn-hero__desc">
            Unlock government schemes, easier credit, and compliance benefits with Udyam / MSME registration. Whizseed handles the paperwork end-to-end so you can focus on growing your business.
          </p>

          <div class="hn-hero__process">
            <p class="hn-hero__process-label">- MSME Process</p>
            <div class="hn-hero__steps">
              <div class="hn-hero__step">
                <div class="hn-hero__step-icon" aria-hidden="true">
                  <svg width="48" height="48" viewBox="0 0 48 48" fill="none"><rect x="8" y="14" width="22" height="16" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M12 28V34H26V28" stroke="currentColor" stroke-width="1.6"/><circle cx="34" cy="18" r="6" stroke="currentColor" stroke-width="1.6"/><path d="M28 32c1.5-3 4-4.5 6-4.5s4.5 1.5 6 4.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                </div>
                <p class="hn-hero__step-text">Get in touch with our experts</p>
              </div>
              <div class="hn-hero__step">
                <div class="hn-hero__step-icon" aria-hidden="true">
                  <svg width="48" height="48" viewBox="0 0 48 48" fill="none"><path d="M16 10h12l8 8v20a2 2 0 01-2 2H16a2 2 0 01-2-2V12a2 2 0 012-2z" stroke="currentColor" stroke-width="1.6"/><path d="M28 10v8h8M20 24h12M20 30h12M20 36h8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                </div>
                <p class="hn-hero__step-text">Provide all the details and we will prepare all your documents</p>
              </div>
              <div class="hn-hero__step">
                <div class="hn-hero__step-icon" aria-hidden="true">
                  <svg width="48" height="48" viewBox="0 0 48 48" fill="none"><rect x="12" y="8" width="24" height="32" rx="2" stroke="currentColor" stroke-width="1.6"/><circle cx="24" cy="22" r="6" stroke="currentColor" stroke-width="1.6"/><path d="M18 34h12M21 18l2 2 4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <p class="hn-hero__step-text">Finally submit your application and get your MSME Registration.</p>
              </div>
            </div>
          </div>

          <div class="hn-hero__features-wrap">
            <div class="hn-hero__features js-hero-features-slider">
              <div class="hn-hero__feature">
                <span class="hn-hero__feature-icon" aria-hidden="true">✦</span>
                <div>
                  <strong>Support</strong>
                  <span>99% of services will be delivered on time</span>
                </div>
              </div>
              <div class="hn-hero__feature">
                <span class="hn-hero__feature-icon" aria-hidden="true">✦</span>
                <div>
                  <strong>4.8/5 Google Rating</strong>
                  <span>Customers rated us 5 star in Google</span>
                </div>
              </div>
              <div class="hn-hero__feature">
                <span class="hn-hero__feature-icon" aria-hidden="true">✦</span>
                <div>
                  <strong>18+ Experience</strong>
                  <span>Every Experience Tells a Story</span>
                </div>
              </div>
              <div class="hn-hero__feature">
                <span class="hn-hero__feature-icon" aria-hidden="true">✦</span>
                <div>
                  <strong>Reasonable</strong>
                  <span>Competitive Price, quality service</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <aside class="hn-hero__aside">
          <form class="hn-consult hn-consult--hero" action="{{ route('contact.submit') }}" method="post" novalidate>
            @csrf
            <input type="hidden" name="redirect_to" value="home.new">
            <h2 class="hn-consult__title">Consultation by Expert</h2>

            @if(session('contact_success'))
              <div class="hn-consult__success" role="status">{{ session('contact_success') }}</div>
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
                @foreach(config('indian_states') as $state)
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
          <a href="#overview" class="hn-tabs__item hn-tabs__item--active" data-tab="overview">Overview</a>
          <a href="#key-points" class="hn-tabs__item" data-tab="key-points">Key Points</a>
          <a href="#documents" class="hn-tabs__item" data-tab="documents">Documents</a>
          <a href="#faq" class="hn-tabs__item" data-tab="faq">FAQ</a>
          <a href="#pricing" class="hn-tabs__item" data-tab="pricing">Pricing</a>
        </nav>
      </div>
    </section>

    {{-- Main + Sidebar --}}
    <section class="hn-body">
      <div class="container hn-body__grid">

        <div class="hn-main">

          <article class="hn-card" id="overview">
            <h1 class="hn-card__title">Overview of MSME Registration</h1>
            <div class="hn-card__body">
              <p>Micro, Small, and Medium-Sized Enterprises (MSMEs) form the backbone of India's economy. They contribute significantly to employment generation, industrial output, and exports across manufacturing and service sectors.</p>
              <p>MSME Registration (Udyam Registration) is a government recognition that helps businesses access subsidies, easier credit, tax benefits, and preferential treatment in public procurement.</p>
              <h3>Key Points</h3>
              <ul>
                <li>Visit the Udyam Registration portal and create an account with Aadhaar-linked mobile.</li>
                <li>Provide PAN, GSTIN (if applicable), and business activity details.</li>
                <li>Declare investment and turnover as per the latest MSME classification.</li>
                <li>Download and save your Udyam Registration Certificate instantly.</li>
              </ul>
            </div>
          </article>

          <article class="hn-card">
            <h2 class="hn-card__title">What do you Understand through MSME Registration?</h2>
            <div class="hn-card__body">
              <p>MSME Registration under the MSMED Act, 2006 provides official recognition to micro, small, and medium enterprises. It validates your enterprise category based on investment in plant &amp; machinery / equipment and annual turnover.</p>
              <p>Once registered, businesses become eligible for priority sector lending, reduced interest rates, protection against delayed payments, and multiple central &amp; state government schemes.</p>
            </div>
          </article>

          <article class="hn-card">
            <h2 class="hn-card__title">MSMEs' Maximum Turnover Limit in India</h2>
            <div class="hn-card__body">
              <p>As per the revised classification, Micro enterprises can have turnover up to ₹5 crore, Small enterprises up to ₹50 crore, and Medium enterprises up to ₹250 crore — subject to corresponding investment limits.</p>
              <p>These thresholds apply uniformly to both manufacturing and service enterprises, making the classification simpler and more inclusive.</p>
            </div>
          </article>

          {{-- MSME Categories --}}
          <article class="hn-card" id="key-points">
            <h2 class="hn-card__title">Categories of Micro Small and Medium Enterprises in India</h2>
            <div class="hn-card__body">
              <p>According to their annually revenues and the amount they invest in machinery, plants, or machinery, MSMEs in India are divided into three distinct groups:</p>
            </div>
            <div class="hn-categories js-category-slider">
              <article class="hn-category-card">
                <span class="hn-category-card__icon" aria-hidden="true">
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 21h18"/>
                    <path d="M5 21V8l7-4 7 4v13"/>
                    <path d="M9 21v-6h6v6"/>
                    <path d="M9 10h.01M15 10h.01M9 14h.01M15 14h.01"/>
                  </svg>
                </span>
                <h3 class="hn-category-card__title">Micro Companies:</h3>
                <p class="hn-category-card__text">These are the companies whose yearly sales are under ₹5 crore and whose machinery, plants, or equipment investments are up to ₹1 crore.</p>
              </article>
              <article class="hn-category-card">
                <span class="hn-category-card__icon" aria-hidden="true">
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 21h18"/>
                    <path d="M5 21V8l7-4 7 4v13"/>
                    <path d="M9 21v-6h6v6"/>
                    <path d="M9 10h.01M15 10h.01M9 14h.01M15 14h.01"/>
                  </svg>
                </span>
                <h3 class="hn-category-card__title">Small-scale Enterprises:</h3>
                <p class="hn-category-card__text">These companies or enterprises are those that have an annual revenue of more than ₹50 crores and up to ₹10 crores in plants, devices, or technology.</p>
              </article>
              <article class="hn-category-card">
                <span class="hn-category-card__icon" aria-hidden="true">
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 21h18"/>
                    <path d="M5 21V8l7-4 7 4v13"/>
                    <path d="M9 21v-6h6v6"/>
                    <path d="M9 10h.01M15 10h.01M9 14h.01M15 14h.01"/>
                  </svg>
                </span>
                <h3 class="hn-category-card__title">Medium-sized Firms:</h3>
                <p class="hn-category-card__text">They are those that have a yearly income of slightly more than ₹250 crores and commit up to ₹50 crores in plants, machines, or technology.</p>
              </article>
            </div>
          </article>

          {{-- Checklist --}}
          <article class="hn-card" id="checklist">
            <h2 class="hn-card__title">Checklist for doing MSME Registration in India</h2>
            <div class="hn-card__body">
              <p>Any company can apply for registration as an MSME in India if it meets its investment and turnover criteria and falls under the category of a micro, small, or medium enterprise. This covers companies in both the production and service sectors. The corporation is a corporation, partnership, sole proprietorship, private limited company, or any other type of organization authorized by law. In order to register as MSME in India you must check the following things described or given below:</p>
              <ul class="hn-checklist">
                <li>
                  <span class="hn-checklist__icon" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <span>Check investment in plants and machinery for manufacturing.</span>
                </li>
                <li>
                  <span class="hn-checklist__icon" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <span>Investment in equipment for service enterprises.</span>
                </li>
                <li>
                  <span class="hn-checklist__icon" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <span>Micro, small, and medium enterprise classifications.</span>
                </li>
                <li>
                  <span class="hn-checklist__icon" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <span>Turnover criteria for medium-sized businesses.</span>
                </li>
                <li>
                  <span class="hn-checklist__icon" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <span>Limited to Indian entities.</span>
                </li>
                <li>
                  <span class="hn-checklist__icon" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <span>Exclusion of trading activities.</span>
                </li>
                <li>
                  <span class="hn-checklist__icon" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <span>Self-declaration of investment and turnover.</span>
                </li>
              </ul>
            </div>
          </article>

          {{-- Documents required --}}
          <article class="hn-card hn-docs" id="documents">
            <h2 class="hn-card__title">Documents Required in Order to Register an MSME in India</h2>
            <div class="hn-card__body">
              <p>The following papers are needed in India to register an MSME, hence before starting the registration procedure make sure you are having the following papers in your hand:</p>
            </div>
            <div class="hn-docs__grid">
              <ul class="hn-docs__list">
                <li>
                  <span class="hn-docs__check" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <div>
                    <strong>Aadhaar Card:</strong>
                    <span>The firm owner's Aadhaar card is required for confirmation.</span>
                  </div>
                </li>
                <li>
                  <span class="hn-docs__check" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <div>
                    <strong>PAN Card:</strong>
                    <span>The business's or the owner's PAN card.</span>
                  </div>
                </li>
                <li>
                  <span class="hn-docs__check" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <div>
                    <strong>Bank Account Details:</strong>
                    <span>Data on a company's bank account, comprising the account information and the address of the bank that holds it.</span>
                  </div>
                </li>
                <li>
                  <span class="hn-docs__check" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <div>
                    <strong>Additional Business Details:</strong>
                    <span>Specifics regarding the nature, location, and functioning of a company. In the business details evidence of business address proof may also be required.</span>
                  </div>
                </li>
                <li>
                  <span class="hn-docs__check" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <div>
                    <strong>Entity Documents:</strong>
                    <span>Depending on the type of entity these documents may vary like for LLPs LLP Deed will be needed, for partnership firms partnership deed will be required and similarly for corporate entities MOA, AOA, CIN, DSC, DIN etc will be required.</span>
                  </div>
                </li>
                <li>
                  <span class="hn-docs__check" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <div>
                    <strong>Contact Details:</strong>
                    <span>Make sure to obtain contact details like phone number and e-mail address of the applicant.</span>
                  </div>
                </li>
              </ul>
              <div class="hn-docs__media">
                <img
                  src="{{ asset('Image/vectorpng.png') }}"
                  alt="Business team reviewing MSME registration documents"
                  width="420"
                  height="360"
                  loading="lazy"
                >
              </div>
            </div>
          </article>
          <article class="hn-card" id="checklist">
            <h2 class="hn-card__title">Checklist for doing MSME Registration in India</h2>
            <div class="hn-card__body">
              <p>Any company can apply for registration as an MSME in India if it meets its investment and turnover criteria and falls under the category of a micro, small, or medium enterprise. This covers companies in both the production and service sectors. The corporation is a corporation, partnership, sole proprietorship, private limited company, or any other type of organization authorized by law. In order to register as MSME in India you must check the following things described or given below:</p>
              <ul class="hn-checklist">
                <li>
                  <span class="hn-checklist__icon" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <span>Check investment in plants and machinery for manufacturing.</span>
                </li>
                <li>
                  <span class="hn-checklist__icon" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <span>Investment in equipment for service enterprises.</span>
                </li>
                <li>
                  <span class="hn-checklist__icon" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <span>Micro, small, and medium enterprise classifications.</span>
                </li>
                <li>
                  <span class="hn-checklist__icon" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <span>Turnover criteria for medium-sized businesses.</span>
                </li>
                <li>
                  <span class="hn-checklist__icon" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <span>Limited to Indian entities.</span>
                </li>
                <li>
                  <span class="hn-checklist__icon" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <span>Exclusion of trading activities.</span>
                </li>
                <li>
                  <span class="hn-checklist__icon" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <span>Self-declaration of investment and turnover.</span>
                </li>
              </ul>
            </div>
          </article>
          {{-- Download certificate --}}
          <article class="hn-dark-card">
            <h2 class="hn-dark-card__title">How to Download Certificate of MSME Registration?</h2>
            <p class="hn-dark-card__desc">Follow these simple steps to download your Udyam Registration Certificate after successful filing.</p>
            <ul class="hn-dark-steps">
              <li>
                <span class="hn-dark-steps__icon" aria-hidden="true">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <span>Log in to the Udyam Registration portal with your registered credentials.</span>
              </li>
              <li>
                <span class="hn-dark-steps__icon" aria-hidden="true">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <span>Open your Udyam dashboard and select Print / Download Certificate.</span>
              </li>
              <li>
                <span class="hn-dark-steps__icon" aria-hidden="true">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <span>Verify enterprise details shown on the certificate preview.</span>
              </li>
              <li>
                <span class="hn-dark-steps__icon" aria-hidden="true">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <span>Download the PDF certificate and keep a digital &amp; printed copy.</span>
              </li>
            </ul>
          </article>

          {{-- Distinctions --}}
          <article class="hn-card">
            <h2 class="hn-card__title">Key Distinctions Between Startups and MSMEs</h2>
            <div class="hn-card__body">
              <p>Both startups and MSMEs are vital to India's economic growth, yet they differ in several important ways:</p>
              <ul class="hn-checklist">
                <li>
                  <span class="hn-checklist__icon" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <div>
                    <strong>Generation of the Business:</strong>
                    <span>Startups are typically founded by entrepreneurs chasing innovative ideas, while MSMEs often grow from traditional family or local businesses.</span>
                  </div>
                </li>
                <li>
                  <span class="hn-checklist__icon" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <div>
                    <strong>Goal:</strong>
                    <span>MSMEs usually aim for stability and steady income, whereas startups focus on innovation, disruption, and rapid growth.</span>
                  </div>
                </li>
                <li>
                  <span class="hn-checklist__icon" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <div>
                    <strong>Licensing and Help:</strong>
                    <span>Startups may receive recognition and benefits under Startup India, while MSMEs access federal programs, subsidies, and priority lending schemes.</span>
                  </div>
                </li>
                <li>
                  <span class="hn-checklist__icon" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                  </span>
                  <div>
                    <strong>Scale and Description:</strong>
                    <span>MSMEs often serve local or regional markets, while startups are built to scale nationally or globally with technology-led models.</span>
                  </div>
                </li>
              </ul>
            </div>
          </article>

          <article class="hn-card">
            <h2 class="hn-card__title">Are MSME and Udyam Registration Same?</h2>
            <div class="hn-card__body">
              <p>Yes. MSME registration and Udyam registration refer to the same government process. Udyam is the official online portal through which enterprises register as Micro, Small, or Medium Enterprises and receive their Udyam Registration Certificate.</p>
            </div>
          </article>

          <article class="hn-card hn-card--media">
            <img
              src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=1200&h=640&fit=crop&auto=format"
              alt="Worker operating machinery in a manufacturing unit"
              class="hn-media-img"
              width="1200"
              height="640"
              loading="lazy"
            >
          </article>

          <article class="hn-card">
            <h2 class="hn-card__title">Is Registration as an MSME Mandatory for Businesses?</h2>
            <div class="hn-card__body">
              <p>MSME registration is not mandatory, but it is strongly advised. Without Udyam registration, businesses may miss out on government incentives, collateral-free loans, tender advantages, and delayed-payment safeguards under the MSMED Act.</p>
            </div>
          </article>

          <article class="hn-card">
            <h2 class="hn-card__title">Why Choose Whizseed for MSME?</h2>
            <div class="hn-card__body">
              <p>Whizseed makes MSME registration simple, accurate, and fast. From classification and documentation to portal filing and certificate delivery, our experts handle the process end-to-end so you can focus on growing your business.</p>
            </div>
            <img
              src="{{ asset('frontend/assets/images1/groupconttt.jpg') }}"
              alt="Whizseed team collaborating in office"
              class="hn-media-img hn-media-img--inset"
              width="1200"
              height="560"
              loading="lazy"
            >
            <div class="hn-why">
              <div class="hn-why__stats">
                <div class="hn-why__stat">
                  <span class="hn-why__stat-label">BUSINESS EMPOWERED</span>
                  <strong class="hn-why__stat-value">1800+</strong>
                </div>
                <div class="hn-why__stat">
                  <span class="hn-why__stat-label">OF INDUSTRY EXPERIENCE</span>
                  <strong class="hn-why__stat-value">3+ Year</strong>
                </div>
                <div class="hn-why__stat">
                  <span class="hn-why__stat-label">CLIENT SATISFACTION</span>
                  <strong class="hn-why__stat-value">98%</strong>
                </div>
              </div>
              <div class="hn-why__features">
                <article class="hn-why__feature">
                  <span class="hn-why__feature-icon" aria-hidden="true">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="4" width="18" height="14" rx="2"/><path d="M7 8h4M7 12h10M7 16h6"/><path d="M3 20h18"/></svg>
                  </span>
                  <h3>Simplified Dashboard Experience</h3>
                </article>
                <article class="hn-why__feature">
                  <span class="hn-why__feature-icon" aria-hidden="true">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M9 18h6M10 21h4"/><path d="M12 3a6 6 0 00-3.5 10.8c.7.5 1.1 1.2 1.2 2.2h4.6c.1-1 .5-1.7 1.2-2.2A6 6 0 0012 3z"/></svg>
                  </span>
                  <h3>Your Questions, Our Priority</h3>
                </article>
                <article class="hn-why__feature">
                  <span class="hn-why__feature-icon" aria-hidden="true">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="9"/><path d="M12 7v10M9.5 9.5c.5-1 1.5-1.5 2.5-1.5s2 .6 2.5 1.5c.4.8 0 1.5-1 2l-3 1.5c-1 .5-1.4 1.2-1 2 .5 1 1.5 1.5 2.5 1.5s2-.5 2.5-1.5"/></svg>
                  </span>
                  <h3>Premium Expertise, Budget-Friendly Rates</h3>
                </article>
                <article class="hn-why__feature">
                  <span class="hn-why__feature-icon" aria-hidden="true">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M16 21v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2"/><circle cx="9.5" cy="7" r="3.5"/><path d="M20 21v-2a3.5 3.5 0 00-2.5-3.3M16 3.5a3.5 3.5 0 010 7"/></svg>
                  </span>
                  <h3>A Comprehensive Hub of Legal Experts</h3>
                </article>
              </div>
            </div>

            <ul class="hn-checklist hn-checklist--plain">
              <li>
                <span class="hn-checklist__icon" aria-hidden="true">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <span>Expertise in MSME registration process.</span>
              </li>
              <li>
                <span class="hn-checklist__icon" aria-hidden="true">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <span>Dedicated support for clients.</span>
              </li>
              <li>
                <span class="hn-checklist__icon" aria-hidden="true">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <span>Streamlined registration procedure.</span>
              </li>
              <li>
                <span class="hn-checklist__icon" aria-hidden="true">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <span>Experienced professionals.</span>
              </li>
              <li>
                <span class="hn-checklist__icon" aria-hidden="true">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <span>Timely completion of registrations.</span>
              </li>
              <li>
                <span class="hn-checklist__icon" aria-hidden="true">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <span>Compliance with MSME regulations.</span>
              </li>
              <li>
                <span class="hn-checklist__icon" aria-hidden="true">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <span>Access to government benefits.</span>
              </li>
              <li>
                <span class="hn-checklist__icon" aria-hidden="true">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <span>Transparent communication.</span>
              </li>
            </ul>
          </article>

          {{-- FAQ --}}
          <article class="hn-card hn-faq" id="faq">
            <h2 class="hn-card__title">Frequently Asked Questions</h2>
            <div class="hn-faq__list">
              <div class="hn-faq__item is-open">
                <button type="button" class="hn-faq__question" aria-expanded="true">
                  <span>What are some of the benefits of signing up for MSMEs?</span>
                  <span class="hn-faq__icon" aria-hidden="true">+</span>
                </button>
                <div class="hn-faq__answer">
                  <p>MSMEs get easier access to credit, subsidies, tax benefits, delayed-payment protection, and preference in government tenders.</p>
                </div>
              </div>
              <div class="hn-faq__item">
                <button type="button" class="hn-faq__question" aria-expanded="false">
                  <span>Is it free to register for MSME?</span>
                  <span class="hn-faq__icon" aria-hidden="true">+</span>
                </button>
                <div class="hn-faq__answer">
                  <p>Yes. Udyam Registration on the official government portal is completely free of cost.</p>
                </div>
              </div>
              <div class="hn-faq__item">
                <button type="button" class="hn-faq__question" aria-expanded="false">
                  <span>Can I change the information I provided during filing the application for MSME later?</span>
                  <span class="hn-faq__icon" aria-hidden="true">+</span>
                </button>
                <div class="hn-faq__answer">
                  <p>Yes. You can update most enterprise details later through the Udyam portal using your registration credentials.</p>
                </div>
              </div>
              <div class="hn-faq__item">
                <button type="button" class="hn-faq__question" aria-expanded="false">
                  <span>Is MSME registration necessary for all companies?</span>
                  <span class="hn-faq__icon" aria-hidden="true">+</span>
                </button>
                <div class="hn-faq__answer">
                  <p>It is not mandatory, but strongly recommended for eligible businesses that want scheme benefits and compliance advantages.</p>
                </div>
              </div>
              <div class="hn-faq__item">
                <button type="button" class="hn-faq__question" aria-expanded="false">
                  <span>How much time will it take to get MSME status?</span>
                  <span class="hn-faq__icon" aria-hidden="true">+</span>
                </button>
                <div class="hn-faq__answer">
                  <p>Udyam registration is usually instantaneous after successful submission and OTP verification.</p>
                </div>
              </div>
              <div class="hn-faq__item">
                <button type="button" class="hn-faq__question" aria-expanded="false">
                  <span>How Whizseed helps while getting this MSME Registration?</span>
                  <span class="hn-faq__icon" aria-hidden="true">+</span>
                </button>
                <div class="hn-faq__answer">
                  <p>Whizseed handles classification, documentation, portal filing, and certificate delivery so you can focus on running your business.</p>
                </div>
              </div>
            </div>
          </article>

          {{-- About author --}}
          <article class="hn-author">
            <div class="hn-author__media">
              <img
                src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=240&h=240&fit=crop&auto=format"
                alt="Maya Chen"
                width="120"
                height="120"
                loading="lazy"
              >
              <span class="hn-author__badge">Content Writer</span>
            </div>
            <div class="hn-author__content">
              <h3 class="hn-author__name">
                Maya Chen
                <a href="#" class="hn-author__linkedin" aria-label="LinkedIn" rel="noopener">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>
              </h3>
              <p class="hn-author__meta">Written by Maya Chen · Last updated on May 4 2026, 02:33 PM</p>
              <p class="hn-author__bio">Maya specializes in Indian business compliance, company law, and startup documentation. She writes practical guides that help founders navigate registrations, filings, and growth-ready legal foundations.</p>
            </div>
          </article>

          {{-- Client reviews (Slick) --}}
          <section class="hn-reviews" id="pricing" aria-label="Client reviews">
            <div class="hn-reviews__label">
              <span>— CLIENT REVIEWS —</span>
            </div>
            <h2 class="hn-reviews__heading">
              Clients Are Saying
              <span class="hn-reviews__square" aria-hidden="true"></span>
            </h2>
            <div class="hn-reviews__slider js-reviews-slider">
              <div class="hn-review-card">
                <div class="hn-review-card__bg">
                  <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=520&fit=crop&auto=format" alt="" loading="lazy">
                  <div class="hn-review-card__overlay"></div>
                </div>
                <div class="hn-review-card__content">
                  <p class="hn-review-card__text">"I had a great experience getting my FSSAI license in Noida. The team was highly professional, guided me through the entire process. Their expertise made the registration quick and hassle-free. Thank you"</p>
                  <div class="hn-review-card__divider"></div>
                  <div class="hn-review-card__footer">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=64&h=64&fit=crop&auto=format" alt="" class="hn-review-card__avatar" loading="lazy">
                    <div>
                      <span class="hn-review-card__badge">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="#34a853"><path d="M21.35 11.1h-9.17v2.73h5.51a6.19 6.19 0 01-2.68 4.05v3.37h4.34a10.91 10.91 0 003.97-8.5c0-.57-.05-1.13-.14-1.66z"/><path d="M12.18 21.3a10.8 10.8 0 007.4-2.72l-4.34-3.37a6.84 6.84 0 01-10.22-3.59H4.6v3.48a10.8 10.8 0 007.58 6.2z"/><path d="M5.02 13.62a6.72 6.72 0 010-4.28V5.86H4.6a10.8 10.8 0 000 9.48l.42-1.72z"/><path d="M12.18 4.78a6.1 6.1 0 014.3 1.68l3.23-3.23A10.8 10.8 0 0012.18 1 10.8 10.8 0 004.6 5.86l.42 3.48a6.72 6.72 0 017.16-4.56z"/></svg>
                        Google
                      </span>
                      <span class="hn-review-card__name">Neha Roop</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="hn-review-card">
                <div class="hn-review-card__bg">
                  <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&h=520&fit=crop&auto=format" alt="" loading="lazy">
                  <div class="hn-review-card__overlay"></div>
                </div>
                <div class="hn-review-card__content">
                  <p class="hn-review-card__text">"I had a great experience getting my FSSAI license in Noida. The team was highly professional, guided me through the entire process. Their expertise made the registration quick and hassle-free. Thank you"</p>
                  <div class="hn-review-card__divider"></div>
                  <div class="hn-review-card__footer">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=64&h=64&fit=crop&auto=format" alt="" class="hn-review-card__avatar" loading="lazy">
                    <div>
                      <span class="hn-review-card__badge">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="#34a853"><path d="M21.35 11.1h-9.17v2.73h5.51a6.19 6.19 0 01-2.68 4.05v3.37h4.34a10.91 10.91 0 003.97-8.5c0-.57-.05-1.13-.14-1.66z"/><path d="M12.18 21.3a10.8 10.8 0 007.4-2.72l-4.34-3.37a6.84 6.84 0 01-10.22-3.59H4.6v3.48a10.8 10.8 0 007.58 6.2z"/><path d="M5.02 13.62a6.72 6.72 0 010-4.28V5.86H4.6a10.8 10.8 0 000 9.48l.42-1.72z"/><path d="M12.18 4.78a6.1 6.1 0 014.3 1.68l3.23-3.23A10.8 10.8 0 0012.18 1 10.8 10.8 0 004.6 5.86l.42 3.48a6.72 6.72 0 017.16-4.56z"/></svg>
                        Google
                      </span>
                      <span class="hn-review-card__name">Hardeep Singh</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="hn-review-card">
                <div class="hn-review-card__bg">
                  <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&h=520&fit=crop&auto=format" alt="" loading="lazy">
                  <div class="hn-review-card__overlay"></div>
                </div>
                <div class="hn-review-card__content">
                  <p class="hn-review-card__text">"I had a great experience getting my FSSAI license in Noida. The team was highly professional, guided me through the entire process. Their expertise made the registration quick and hassle-free. Thank you"</p>
                  <div class="hn-review-card__divider"></div>
                  <div class="hn-review-card__footer">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=64&h=64&fit=crop&auto=format" alt="" class="hn-review-card__avatar" loading="lazy">
                    <div>
                      <span class="hn-review-card__badge">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="#34a853"><path d="M21.35 11.1h-9.17v2.73h5.51a6.19 6.19 0 01-2.68 4.05v3.37h4.34a10.91 10.91 0 003.97-8.5c0-.57-.05-1.13-.14-1.66z"/><path d="M12.18 21.3a10.8 10.8 0 007.4-2.72l-4.34-3.37a6.84 6.84 0 01-10.22-3.59H4.6v3.48a10.8 10.8 0 007.58 6.2z"/><path d="M5.02 13.62a6.72 6.72 0 010-4.28V5.86H4.6a10.8 10.8 0 000 9.48l.42-1.72z"/><path d="M12.18 4.78a6.1 6.1 0 014.3 1.68l3.23-3.23A10.8 10.8 0 0012.18 1 10.8 10.8 0 004.6 5.86l.42 3.48a6.72 6.72 0 017.16-4.56z"/></svg>
                        Google
                      </span>
                      <span class="hn-review-card__name">Sumitra Mahato</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="hn-review-card">
                <div class="hn-review-card__bg">
                  <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=520&fit=crop&auto=format" alt="" loading="lazy">
                  <div class="hn-review-card__overlay"></div>
                </div>
                <div class="hn-review-card__content">
                  <p class="hn-review-card__text">"I had a great experience getting my FSSAI license in Noida. The team was highly professional, guided me through the entire process. Their expertise made the registration quick and hassle-free. Thank you"</p>
                  <div class="hn-review-card__divider"></div>
                  <div class="hn-review-card__footer">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=64&h=64&fit=crop&auto=format" alt="" class="hn-review-card__avatar" loading="lazy">
                    <div>
                      <span class="hn-review-card__badge">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="#34a853"><path d="M21.35 11.1h-9.17v2.73h5.51a6.19 6.19 0 01-2.68 4.05v3.37h4.34a10.91 10.91 0 003.97-8.5c0-.57-.05-1.13-.14-1.66z"/><path d="M12.18 21.3a10.8 10.8 0 007.4-2.72l-4.34-3.37a6.84 6.84 0 01-10.22-3.59H4.6v3.48a10.8 10.8 0 007.58 6.2z"/><path d="M5.02 13.62a6.72 6.72 0 010-4.28V5.86H4.6a10.8 10.8 0 000 9.48l.42-1.72z"/><path d="M12.18 4.78a6.1 6.1 0 014.3 1.68l3.23-3.23A10.8 10.8 0 0012.18 1 10.8 10.8 0 004.6 5.86l.42 3.48a6.72 6.72 0 017.16-4.56z"/></svg>
                        Google
                      </span>
                      <span class="hn-review-card__name">Arun Gupta</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

        </div>

        {{-- Sticky Sidebar --}}
        <aside class="hn-side">
          <div class="hn-side__sticky">

            <form class="hn-consult" action="{{ route('contact.submit') }}" method="post" novalidate>
              @csrf
              <input type="hidden" name="redirect_to" value="home.new">
              <h2 class="hn-consult__title">Consultation by Expert</h2>

              @if(session('contact_success'))
                <div class="hn-consult__success" role="status">{{ session('contact_success') }}</div>
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
                  @foreach(config('indian_states') as $state)
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
                  alt="Khushi"
                  class="hn-agent__avatar"
                  width="52"
                  height="52"
                  loading="lazy"
                >
                <div class="hn-agent__info">
                  <div class="hn-agent__name-row">
                    <span class="hn-agent__name">Khushi</span>
                    <span class="hn-agent__status"><i></i> Online</span>
                  </div>
                  <div class="hn-agent__rating" aria-label="Rated 4.0 out of 5">
                    <span>★★★★</span>
                    <span class="hn-agent__rating-value">(4.0)</span>
                  </div>
                </div>
              </div>
              <div class="hn-agent__actions">
                <a href="tel:9625432342" class="hn-agent__btn">
                  <span class="hn-agent__btn-icon hn-agent__btn-icon--call" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                  </span>
                  Call US Now
                </a>
                <a href="https://wa.me/919625432342" class="hn-agent__btn" target="_blank" rel="noopener">
                  <span class="hn-agent__btn-icon hn-agent__btn-icon--chat" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                  </span>
                  Chat With Us
                </a>
              </div>
            </div>

            <div class="hn-other">
              <h3 class="hn-other__title">Other Services</h3>
              <div class="hn-other__tags">
                <a href="{{ route('services') }}" class="hn-other__tag">MSME Registration</a>
                <a href="{{ route('services') }}" class="hn-other__tag">Private Limited</a>
                <a href="{{ route('services') }}" class="hn-other__tag">Company Registration</a>
                <a href="{{ route('services') }}" class="hn-other__tag">Trademark Assignment</a>
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
