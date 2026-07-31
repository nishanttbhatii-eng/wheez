@extends('front.layouts.app')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')
  @include('front.partials.header', ['activeNav' => 'about-us'])

  <main>
    <section class="about-hero">
      <div class="about-hero__media" aria-hidden="true">
        <img
          src="{{ asset('Image/about-hero.jpg') }}"
          alt=""
          width="1800"
          height="1200"
          fetchpriority="high"
        >
      </div>
      <div class="about-hero__overlay" aria-hidden="true"></div>

      <div class="container about-hero__inner">
        <div class="about-hero__grid">
          <div class="about-hero__content">
            <p class="about-hero__label">- WHO WE ARE -</p>

            <h1 class="about-hero__title">
              About us
              <span class="about-hero__square" aria-hidden="true"></span>
            </h1>

            <div class="about-hero__text">
              <p>Whizseed is your go-to online hub for all things legal! We've created a special platform that links top-notch lawyers with business clients, making it easy for you to get the legal help you need. Whether you have questions, need advice, or want to discuss legal matters, we've got you covered. Plus, we like to keep you in the loop with legal updates and news snippets.</p>
              <p>At Whizseed, we've gathered a bunch of talented professionals who specialize in various areas like Environmental issues, Business Registrations, Government Licenses, Compliance, Tax filing, and more. These experts are their own bosses, and no one at Whizseed or any other member firm can speak for them or make commitments on their behalf.</p>
              <p>Just so you know, Whizseed isn't a law firm. When our lawyers provide answers to your legal questions, they keep things simple and easy to understand, but remember, these are not full legal opinions. They're here to help you out of goodwill, but it doesn't create a formal lawyer-client relationship. It's important to note that the services we offer are not a replacement for advice from a lawyer.</p>
              <p>One cool thing about Whizseed is that clients like you post your queries or cases on our platform, and you get to choose the lawyer you want to work with. You're in the driver's seat when it comes to picking your lawyer!</p>
            </div>
          </div>

          <aside class="about-hero__aside">
            @include('front.partials.stats-card', [
              'statsCardClass' => 'about-hero__stats',
              'statsCtaLabel' => __('ui.talk_to_expert'),
            ])
          </aside>
        </div>
      </div>
    </section>

    @include('front.partials.trusted-marquee')

    <section class="about-solutions">
      <div class="container about-solutions__grid">
        <div class="about-solutions__content">
          <div class="about-solutions__label">
            <span class="about-solutions__label-dot" aria-hidden="true"></span>
            <span class="about-solutions__label-text">ABOUT WHIZSEED</span>
            <span class="about-solutions__label-line" aria-hidden="true"></span>
          </div>

          <h2 class="about-solutions__heading">
            50,000+ People Choose WHIZSEED For Their Legal Solutions
            <span class="about-solutions__square" aria-hidden="true"></span>
          </h2>

          <div class="about-solutions__cards">
            <article class="about-solutions__card">
              <span class="about-solutions__card-icon" aria-hidden="true">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6M9 13h6M9 17h4"/></svg>
              </span>
              <div class="about-solutions__card-body">
                <h3>India's No.1 Legal Platform</h3>
                <p>Get the legal help from over 10,000+ independent Professionals across India</p>
              </div>
            </article>

            <article class="about-solutions__card">
              <span class="about-solutions__card-icon" aria-hidden="true">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="3"/><path d="M5 20c1.5-3.5 4-5 7-5s5.5 1.5 7 5"/><path d="M19 8v4M17 10h4"/></svg>
              </span>
              <div class="about-solutions__card-body">
                <h3>Get Legal Advice</h3>
                <p>Post your queries and get response from highly experienced professionals within 1 or 2 days.</p>
              </div>
            </article>

            <article class="about-solutions__card">
              <span class="about-solutions__card-icon" aria-hidden="true">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a4 4 0 01-4 4H8l-5 3V7a4 4 0 014-4h10a4 4 0 014 4z"/></svg>
              </span>
              <div class="about-solutions__card-body">
                <h3>Contact a Lawyer</h3>
                <p>Contact &amp; get legal advice from our network of independent professionals for your specific matter.</p>
              </div>
            </article>
          </div>
        </div>

        <div class="about-solutions__visual">
          <img
            src="{{ asset('Image/about-solutions.jpg') }}"
            alt="Professionals collaborating at Whizseed"
            width="900"
            height="1100"
            loading="lazy"
          >
        </div>
      </div>
    </section>

    @include('front.partials.client-reviews')
    @include('front.partials.newsletter')
    @include('front.partials.footer')
  </main>
@endsection
