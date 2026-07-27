@extends('front.layouts.app')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')
  @include('front.partials.header', ['activeNav' => 'about-us'])

  <main>
    <section class="about-hero">
      <div class="about-hero__glow" aria-hidden="true"></div>
      <div class="container about-hero__inner">
        <nav class="about-breadcrumb" aria-label="Breadcrumb">
          <a href="{{ route('home') }}">Home</a>
          <span>/</span>
          <span aria-current="page">About Us</span>
        </nav>

        <div class="about-hero__label">
          <span class="about-hero__label-text">- ABOUT</span>
          <span class="about-hero__label-line"></span>
        </div>

        <h1 class="about-hero__title">
          Who We
          <span class="about-hero__title-row">
            Are
            <span class="about-hero__square" aria-hidden="true"></span>
          </span>
        </h1>

        <p class="about-hero__desc">
          {{ $page?->content ?: 'We serve many customers, ranging from small businesses, medium entrepreneurs, to world-renowned companies.' }}
        </p>
      </div>
    </section>

    <section class="about-story">
      <div class="container about-story__grid">
        <div class="about-story__content">
          <div class="about-story__label">
            <span class="about-story__label-text">- OUR STORY</span>
            <span class="about-story__label-line"></span>
          </div>
          <h2 class="about-story__title">About Us</h2>
          <div class="about-story__text">
            <p>Whizseed is your go-to online hub for all things legal! We've created a special platform that links top-notch lawyers with business clients, making it easy for you to get the legal help you need. Whether you have questions, need advice, or want to discuss legal matters, we've got you covered. Plus, we like to keep you in the loop with legal updates and news snippets.</p>
            <p>At Whizseed, we've gathered a bunch of talented professionals who specialize in various areas like Environmental issues, Business Registrations, Government Licenses, Compliance, Tax filing, and more. These experts are their own bosses, and no one at Whizseed or any other member firm can speak for them or make commitments on their behalf.</p>
            <p>Just so you know, Whizseed isn't a law firm. When our lawyers provide answers to your legal questions, they keep things simple and easy to understand, but remember, these are not full legal opinions. They're here to help you out of goodwill, but it doesn't create a formal lawyer-client relationship. It's important to note that the services we offer are not a replacement for advice from a lawyer.</p>
            <p>One cool thing about Whizseed is that clients like you post your queries or cases on our platform, and you get to choose the lawyer you want to work with. You're in the driver's seat when it comes to picking your lawyer!</p>
          </div>
        </div>
        <div class="about-story__visual">
          <img
            src="{{ asset('Image/about-illustration.png') }}"
            alt="Whizseed legal and business support"
            width="697"
            height="521"
            loading="lazy"
          >
        </div>
      </div>
    </section>

    <section class="about-platforms">
      <div class="container">
        <h2 class="about-platforms__heading">
          <span class="about-platforms__heading-accent">50,000+ People</span>
          Choose WHIZSEED for their Legal Solutions
        </h2>

        <div class="about-platforms__grid">
          <article class="about-platform-card">
            <div class="about-platform-card__icon" aria-hidden="true">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="M7 14l4-4 3 3 5-6"/></svg>
            </div>
            <h3 class="about-platform-card__title">India’s No.1 Legal Platform</h3>
            <p class="about-platform-card__text">Get the legal help from over 10,000+ Independent Professionals across India</p>
          </article>
          <article class="about-platform-card">
            <div class="about-platform-card__icon" aria-hidden="true">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a4 4 0 01-4 4H8l-5 3V7a4 4 0 014-4h10a4 4 0 014 4z"/></svg>
            </div>
            <h3 class="about-platform-card__title">Get Legal Advice</h3>
            <p class="about-platform-card__text">Post your queries and get response from highly experienced professionals within 1 or 2 days.</p>
          </article>
          <article class="about-platform-card">
            <div class="about-platform-card__icon" aria-hidden="true">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="3"/><path d="M5 20c1.5-3.5 4-5 7-5s5.5 1.5 7 5"/><path d="M19 8v4M17 10h4"/></svg>
            </div>
            <h3 class="about-platform-card__title">Contact a Lawyer</h3>
            <p class="about-platform-card__text">Contact &amp; get legal advice from our network of independent professionals for your specific matter.</p>
          </article>
        </div>
      </div>
    </section>

    <section class="about-why">
      <div class="about-why__glow" aria-hidden="true"></div>
      <div class="container">
        <p class="about-why__label">
          <span class="about-why__dash" aria-hidden="true"></span>
          WHY CHOOSE WHIZSEED
          <span class="about-why__dash" aria-hidden="true"></span>
        </p>
        <h2 class="about-why__heading">
          Choose WhizSeed for all your business needs in India because we are your trusted partner in entrepreneurial success. Here's how we can help you
        </h2>

        <div class="about-features__grid">
          <div class="about-features__cluster">
            <article class="about-features__card about-features__card--icon">
              <div class="about-features__card-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M7 15v-2M12 15V9M17 15v-4"/></svg>
              </div>
              <h3>Simplified Dashboard Experience</h3>
            </article>
            <article class="about-features__card about-features__card--icon">
              <div class="about-features__card-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/><circle cx="12" cy="12" r="3"/></svg>
              </div>
              <h3>Premium Expertise, Budget-Friendly Rates</h3>
            </article>
            <article class="about-features__card about-features__card--icon">
              <div class="about-features__card-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 1a4 4 0 014 4v3a4 4 0 01-8 0V5a4 4 0 014-4z"/><path d="M5 10a7 7 0 0014 0M12 17v4M8 21h8"/></svg>
              </div>
              <h3>Your Questions, Our Priority</h3>
            </article>
            <article class="about-features__card about-features__card--icon">
              <div class="about-features__card-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="3"/><path d="M5 20c1.5-3.5 4-5 7-5s5.5 1.5 7 5"/><path d="M4 10h2M18 10h2M5 4l1.5 1.5M19 4l-1.5 1.5"/></svg>
              </div>
              <h3>A Comprehensive Hub of Legal Experts</h3>
            </article>
          </div>

          <article class="about-features__card about-features__card--image about-features__card--hero-image">
            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=900&h=600&fit=crop&auto=format" alt="Team collaboration" loading="lazy">
          </article>

          <article class="about-features__card about-features__card--image about-features__card--meeting">
            <img src="{{ asset('Image/team-meeting.jpg') }}" alt="Team meeting" loading="lazy">
          </article>

          <article class="about-features__card about-features__card--accent">
            <ul class="about-features__bullet-list">
              <li>
                <span class="about-features__check" aria-hidden="true">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <div>
                  <strong>Expert Guidance</strong>
                  <p>Benefit from our seasoned experts who provide tailored advice for your specific business goals.</p>
                </div>
              </li>
              <li>
                <span class="about-features__check" aria-hidden="true">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <div>
                  <strong>Comprehensive Services</strong>
                  <p>We offer a wide range of services, from company registration to financial planning, to meet all your business needs.</p>
                </div>
              </li>
              <li>
                <span class="about-features__check" aria-hidden="true">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <div>
                  <strong>Customized Solutions</strong>
                  <p>Our solutions are designed to address your unique challenges, ensuring your business thrives in the Indian market.</p>
                </div>
              </li>
              <li>
                <span class="about-features__check" aria-hidden="true">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <div>
                  <strong>Regulatory Compliance</strong>
                  <p>Stay on top of ever-changing regulations with our assistance, minimizing legal hassles for your business.</p>
                </div>
              </li>
              <li>
                <span class="about-features__check" aria-hidden="true">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <div>
                  <strong>Support at Every Step</strong>
                  <p>WhizSeed is with you from the inception of your business idea to its realization, providing constant support and guidance.</p>
                </div>
              </li>
            </ul>
          </article>

          <article class="about-features__card about-features__card--dark">
            <div class="about-features__stat">
              <span class="about-features__stat-label">BUSINESS EMPOWERED</span>
              <span class="about-features__stat-value">70+</span>
            </div>
            <div class="about-features__stat">
              <span class="about-features__stat-label">OF INDUSTRY EXPERIENCE</span>
              <span class="about-features__stat-value">5+ Year</span>
            </div>
            <div class="about-features__stat">
              <span class="about-features__stat-label">CLIENT SATISFACTION</span>
              <span class="about-features__stat-value">98%</span>
            </div>
          </article>
        </div>
      </div>
    </section>

    <section class="about-testimonials">
      <div class="container">
        <div class="about-testimonials__label">
          <span class="about-testimonials__label-text">- CLIENT REVIEWS</span>
          <span class="about-testimonials__label-line"></span>
        </div>
        <h2 class="about-testimonials__heading">
          Here’s what our amazing
          <span class="about-testimonials__heading-row">
            clients are saying
            <span class="about-testimonials__square" aria-hidden="true"></span>
          </span>
        </h2>

        <div class="about-testimonials__grid">
          <article class="about-testimonial-card">
            <p class="about-testimonial-card__quote">“whizseed is managing my accounts and its such a relaxed and smooth journey so far , I dont have to worry about timely execution of the work .”</p>
            <div class="about-testimonial-card__author">
              <img src="https://www.whizseed.com/frontend/assets/images1/aman-gupta.jpg" alt="Aman Gupta" width="48" height="48" loading="lazy">
              <div>
                <strong>Aman Gupta</strong>
                <span>Client</span>
              </div>
            </div>
          </article>
          <article class="about-testimonial-card">
            <p class="about-testimonial-card__quote">“whizseed is managing my accounts and its such a relaxed and smooth journey so far , I dont have to worry about timely execution of the work .”</p>
            <div class="about-testimonial-card__author">
              <img src="https://www.whizseed.com/frontend/assets/images1/akash-yadav.jpg" alt="Akash Yadav" width="48" height="48" loading="lazy">
              <div>
                <strong>Akash Yadav</strong>
                <span>Client</span>
              </div>
            </div>
          </article>
          <article class="about-testimonial-card">
            <p class="about-testimonial-card__quote">“whizseed is managing my accounts and its such a relaxed and smooth journey so far , I dont have to worry about timely execution of the work .”</p>
            <div class="about-testimonial-card__author">
              <img src="https://www.whizseed.com/frontend/assets/images1/sonam-malhotra.jpg" alt="Sonam Malhotra" width="48" height="48" loading="lazy">
              <div>
                <strong>Sonam Malhotra</strong>
                <span>Client</span>
              </div>
            </div>
          </article>
        </div>
      </div>
    </section>

    <section class="about-elevate">
      <div class="container">
        <div class="about-elevate__intro">
          <div class="about-elevate__label">
            <span class="about-elevate__label-text">- WHAT WE DO</span>
            <span class="about-elevate__label-line"></span>
          </div>
          <h2 class="about-elevate__title">Elevate Your Business with WhizSeed</h2>
        </div>

        <div class="about-elevate__grid">
          <article class="about-elevate__card">
            <h3>Elevate Your Business with WhizSeed</h3>
            <p>As a leading technology-driven legal services and advisory firm, we empower SMEs and entrepreneurs on their business journey. Our expert team covers business registration, legal compliance, tax filing, IPR registration, and more. With over 200 professionals, we've served 10,000+ satisfied customers, ensuring startup compliance with our country's legal and regulatory systems.</p>
          </article>
          <article class="about-elevate__card">
            <h3>Navigating Regulatory Affairs</h3>
            <p>In India, regulatory bodies like RBI, SEBI, and IRDAI hold the keys to licenses and registrations for banks, financial institutions, and insurance businesses. We simplify this process by connecting you with our legal professionals. We understand your needs, handle license or registration applications, liaise with authorities, and deliver the licenses you require.</p>
          </article>
          <article class="about-elevate__card">
            <h3>Environmental Solutions</h3>
            <p>WhizSeed offers a comprehensive range of services to address environmental challenges in business. Our seasoned environmental experts, with over a decade of experience, provide comprehensive solutions for environmental compliance and advisory, including battery waste management, plastic waste management, and e-waste management.</p>
          </article>
          <article class="about-elevate__card">
            <h3>Business Registration Expertise</h3>
            <p>We are renowned for facilitating business registration, whether it's as a private limited company, one-person company, Section 8 company, LLP, public company, or Nidhi company. Our consultancy services extend from business setup from scratch to ongoing compliance.</p>
          </article>
          <article class="about-elevate__card">
            <h3>Safeguarding Intellectual Property</h3>
            <p>Intellectual property protection is vital for modern businesses. Our team excels in IP registration services such as trademark registration, handling objections, managing assignments, copyright registration, and patent registration.</p>
          </article>
          <article class="about-elevate__card">
            <h3>Simplifying Taxation</h3>
            <p>WhizSeed is your all-in-one solution for tax-related needs. Our dedicated professionals assist with GST registration, professional tax registration, GST return filing, TDS return filing, income tax return filing, and secretarial audits. Your tax matters are in capable hands with WhizSeed.</p>
          </article>
        </div>
      </div>
    </section>

    <section class="about-cta">
      <div class="container about-cta__inner">
        <div class="about-cta__content">
          <h2 class="about-cta__title">Ready to get started?</h2>
          <p class="about-cta__text">Talk to our experts and find the right service for your business in minutes.</p>
        </div>
        <a href="{{ route('services') }}" class="btn btn--accent about-cta__btn">
          Get Started Now
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
    </section>

    @include('front.partials.footer')
  </main>
@endsection
