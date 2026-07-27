@extends('front.layouts.app')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endpush

@section('content')
  @include('front.partials.header', ['activeNav' => 'contact-us'])

  <main>
    <section class="contact-hero">
      <div class="contact-hero__glow" aria-hidden="true"></div>
      <div class="container contact-hero__inner">
        <nav class="contact-breadcrumb" aria-label="Breadcrumb">
          <a href="{{ route('home') }}">Home</a>
          <span>/</span>
          <span aria-current="page">Contact Us</span>
        </nav>

        <div class="contact-hero__label">
          <span class="contact-hero__label-text">- CONTACT</span>
          <span class="contact-hero__label-line"></span>
        </div>

        <h1 class="contact-hero__title">
          Get in Touch
          <span class="contact-hero__title-row">
            With Us
            <span class="contact-hero__square" aria-hidden="true"></span>
          </span>
        </h1>

        <p class="contact-hero__desc">
          {{ $page?->content ?: 'We serve many customers, ranging from small businesses, medium entrepreneurs, to world-renowned companies.' }}
        </p>
      </div>
    </section>

    <section class="contact-intro">
      <div class="container contact-intro__grid">
        <div class="contact-intro__content">
          <div class="contact-intro__label">
            <span class="contact-intro__label-text">- REACH OUT</span>
            <span class="contact-intro__label-line"></span>
          </div>
          <h2 class="contact-intro__title">Contact Us</h2>
          <p class="contact-intro__text">
            At WhizSeed, we're dedicated to fueling your entrepreneurial fire. Our services and expert guidance empower startups and entrepreneurs across India to build, grow, and prosper.
          </p>
        </div>
        <div class="contact-intro__visual">
          <img
            src="{{ asset('Image/contact-illustration.png') }}"
            alt="Contact Whizseed"
            width="697"
            height="521"
            loading="lazy"
          >
        </div>
      </div>
    </section>

    <section class="contact-main">
      <div class="container contact-main__grid">
        <div class="contact-details">
          <h2 class="contact-details__title">Contact Details</h2>
          <p class="contact-details__lead">Want to get in touch? Reach us through any of the channels below — we're here to help.</p>

          <ul class="contact-details__list">
            <li class="contact-details__item">
              <span class="contact-details__icon" aria-hidden="true">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
              </span>
              <div>
                <h3>Head Office</h3>
                <p>H-213, Sector 63, Noida, Uttar Pradesh, 201301</p>
              </div>
            </li>
            <li class="contact-details__item">
              <span class="contact-details__icon" aria-hidden="true">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
              </span>
              <div>
                <h3>For Quick Inquiries</h3>
                <p>
                  <a href="tel:9625432342">+91-9625432342</a>
                  <span class="contact-details__sep">·</span>
                  <a href="https://wa.me/919625432342" target="_blank" rel="noopener">WhatsApp</a>
                </p>
              </div>
            </li>
            <li class="contact-details__item">
              <span class="contact-details__icon" aria-hidden="true">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><path d="M22 6l-10 7L2 6"/></svg>
              </span>
              <div>
                <h3>Email Us</h3>
                <p>
                  <span>Info</span> <a href="mailto:info@whizseed.com">info@whizseed.com</a><br>
                  <span>HR</span> <a href="mailto:hr@whizseed.com">hr@whizseed.com</a><br>
                  <span>Support</span> <a href="mailto:support@whizseed.com">support@whizseed.com</a>
                </p>
              </div>
            </li>
          </ul>

          <div class="contact-details__card">
            <h3>Prefer to message us?</h3>
            <p>Fill out the form and our team will get back to you within 1–2 business days.</p>
            <div class="contact-details__social">
              <a href="#" aria-label="Facebook">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3V2z"/></svg>
              </a>
              <a href="#" aria-label="X (Twitter)">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
              </a>
              <a href="#" aria-label="LinkedIn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
              </a>
              <a href="#" aria-label="Instagram">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
              </a>
            </div>
          </div>
        </div>

        <div class="contact-form-wrap">
          @if(session('contact_success'))
            <div class="contact-form__success" role="status">
              {{ session('contact_success') }}
            </div>
          @endif

          <form class="contact-form" action="{{ route('contact.submit') }}" method="post" novalidate>
            @csrf
            <h2 class="contact-form__title">Send a Request</h2>
            <p class="contact-form__subtitle">Tell us how we can help — we’ll respond shortly.</p>

            <div class="contact-form__row">
              <div class="contact-form__field">
                <label for="contact_name">Full Name <span>*</span></label>
                <input type="text" id="contact_name" name="name" value="{{ old('name') }}" placeholder="What is your name" required>
                @error('name') <span class="contact-form__error">{{ $message }}</span> @enderror
              </div>
              <div class="contact-form__field">
                <label for="contact_email">Email Address <span>*</span></label>
                <input type="email" id="contact_email" name="email" value="{{ old('email') }}" placeholder="yourname@gmail.com" required>
                @error('email') <span class="contact-form__error">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="contact-form__row">
              <div class="contact-form__field">
                <label for="contact_mobile">Mobile Number <span>*</span></label>
                <div class="contact-form__phone">
                  <span class="contact-form__code">+91</span>
                  <input type="tel" id="contact_mobile" name="mobile" value="{{ old('mobile') }}" placeholder="Mobile number" inputmode="numeric" maxlength="10" pattern="[0-9]{10}" required>
                </div>
                @error('mobile') <span class="contact-form__error">{{ $message }}</span> @enderror
              </div>
              <div class="contact-form__field">
                <label for="contact_state">State <span>*</span></label>
                <select id="contact_state" name="state" required>
                  <option value="">Select state</option>
                  @foreach($states as $state)
                    <option value="{{ $state }}" @selected(old('state') === $state)>{{ $state }}</option>
                  @endforeach
                </select>
                @error('state') <span class="contact-form__error">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="contact-form__field">
              <label for="contact_message">How can we help you?</label>
              <textarea id="contact_message" name="message" rows="5" placeholder="Type your query here">{{ old('message') }}</textarea>
              @error('message') <span class="contact-form__error">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn--accent contact-form__submit">
              Submit Now
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </button>
          </form>
        </div>
      </div>
    </section>

    <section class="contact-map">
      <div class="container">
        <div class="contact-map__frame">
          <iframe
            title="Whizseed office location"
            src="https://www.google.com/maps?q=H-213,+Sector+63,+Noida,+Uttar+Pradesh+201301&output=embed"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            allowfullscreen
          ></iframe>
        </div>
      </div>
    </section>

    <section class="contact-elevate">
      <div class="container">
        <div class="contact-elevate__intro">
          <div class="contact-elevate__label">
            <span class="contact-elevate__label-text">- WHAT WE DO</span>
            <span class="contact-elevate__label-line"></span>
          </div>
          <h2 class="contact-elevate__title">Elevate Your Business with WhizSeed</h2>
        </div>
        <div class="contact-elevate__grid">
          <article class="contact-elevate__card">
            <h3>Elevate Your Business with WhizSeed</h3>
            <p>As a leading technology-driven legal services and advisory firm, we empower SMEs and entrepreneurs on their business journey. Our expert team covers business registration, legal compliance, tax filing, IPR registration, and more.</p>
          </article>
          <article class="contact-elevate__card">
            <h3>Navigating Regulatory Affairs</h3>
            <p>We simplify RBI, SEBI, and IRDAI licensing by connecting you with legal professionals who understand your needs and deliver the registrations you require.</p>
          </article>
          <article class="contact-elevate__card">
            <h3>Business Registration Expertise</h3>
            <p>From private limited and OPC to Section 8, LLP, and Nidhi company — our consultancy covers setup from scratch through ongoing compliance.</p>
          </article>
        </div>
      </div>
    </section>

    <section class="contact-cta">
      <div class="container contact-cta__inner">
        <div class="contact-cta__content">
          <h2 class="contact-cta__title">Ready to get started?</h2>
          <p class="contact-cta__text">Explore our services or talk to an expert — we’ll guide you every step of the way.</p>
        </div>
        <a href="{{ route('services') }}" class="btn btn--accent contact-cta__btn">
          Explore Services
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
    </section>

    @include('front.partials.footer')
  </main>
@endsection
