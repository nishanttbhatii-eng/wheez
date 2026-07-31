@extends('front.layouts.app')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endpush

@section('content')
  @include('front.partials.header', ['activeNav' => 'contact-us'])

  <main>
    <section class="contact-hero">
      <div class="contact-hero__media" aria-hidden="true">
        <img
          src="{{ asset('Image/contact-hero.jpg') }}"
          alt=""
          width="1800"
          height="900"
          fetchpriority="high"
        >
      </div>
      <div class="contact-hero__overlay" aria-hidden="true"></div>

      <div class="container contact-hero__inner">
        <p class="contact-hero__label">CONTACT US</p>
        <h1 class="contact-hero__title">
          Get in Touch With Us
          <span class="contact-hero__square" aria-hidden="true"></span>
        </h1>
        <p class="contact-hero__desc">
          {{ $page?->content ?: 'Have a question about registration, compliance, or licensing? Reach out — our experts are ready to help you move forward.' }}
        </p>
      </div>
    </section>

    <section class="contact-panel">
      <div class="container contact-panel__grid">
        <div class="contact-info">
          <article class="contact-info__card">
            <span class="contact-info__icon" aria-hidden="true">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><path d="M9 22V12h6v10"/></svg>
            </span>
            <div>
              <h2>Head Offices</h2>
              <p>H-210, Sector-63, Noida, Uttar Pradesh, 201301</p>
            </div>
          </article>

          <article class="contact-info__card">
            <span class="contact-info__icon" aria-hidden="true">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1a4 4 0 014 4v3a4 4 0 01-8 0V5a4 4 0 014-4z"/><path d="M5 10a7 7 0 0014 0M12 17v4M8 21h8"/></svg>
            </span>
            <div>
              <h2>For Quick Inquiries</h2>
              <p class="contact-info__phones">
                <a href="tel:+919625432342">+91-9625432342</a>
                <a class="contact-info__wa" href="https://wa.me/919625432342?text={{ urlencode(__('ui.wa_prefill')) }}" target="_blank" rel="noopener">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                  +91-9625432342
                </a>
              </p>
            </div>
          </article>

          <article class="contact-info__card">
            <span class="contact-info__icon" aria-hidden="true">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><path d="M22 6l-10 7L2 6"/></svg>
            </span>
            <div>
              <h2>Email us</h2>
              <ul class="contact-info__emails">
                <li><span>Information</span> <a href="mailto:info@whizseed.com">info@whizseed.com</a></li>
                <li><span>HR</span> <a href="mailto:hr@whizseed.com">hr@whizseed.com</a></li>
                <li><span>Support</span> <a href="mailto:support@whizseed.com">support@whizseed.com</a></li>
              </ul>
            </div>
          </article>
        </div>

        <div class="contact-form-wrap" id="contact-form">
          <form class="contact-form" action="{{ route('contact.submit') }}" method="post" novalidate>
            @csrf
            <h2 class="contact-form__title">Consultation by Expert</h2>

            <div class="contact-form__field">
              <label for="contact_service">Select Your Service</label>
              <select id="contact_service" name="service" required>
                <option value="">Select Your Service</option>
                @foreach($services as $serviceName)
                  <option value="{{ $serviceName }}" @selected(old('service') === $serviceName)>{{ $serviceName }}</option>
                @endforeach
              </select>
              @error('service') <span class="contact-form__error">{{ $message }}</span> @enderror
            </div>

            <div class="contact-form__row">
              <div class="contact-form__field">
                <label for="contact_name">Full Name</label>
                <input type="text" id="contact_name" name="name" value="{{ old('name') }}" placeholder="Full Name" required autocomplete="name">
                @error('name') <span class="contact-form__error">{{ $message }}</span> @enderror
              </div>
              <div class="contact-form__field">
                <label for="contact_email">Email Address</label>
                <input type="email" id="contact_email" name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email">
                @error('email') <span class="contact-form__error">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="contact-form__row">
              <div class="contact-form__field">
                <label for="contact_mobile">Mobile Number</label>
                <div class="contact-form__phone">
                  <span class="contact-form__flag" aria-hidden="true">🇮🇳</span>
                  <span class="contact-form__code">+91</span>
                  <input type="tel" id="contact_mobile" name="mobile" value="{{ old('mobile') }}" placeholder="Mobile Number" inputmode="numeric" maxlength="10" pattern="[0-9]{10}" required autocomplete="tel-national">
                </div>
                @error('mobile') <span class="contact-form__error">{{ $message }}</span> @enderror
              </div>
              <div class="contact-form__field">
                <label for="contact_state">State</label>
                <select id="contact_state" name="state" required>
                  <option value="">Select State</option>
                  @foreach($states as $state)
                    <option value="{{ $state }}" @selected(old('state') === $state)>{{ $state }}</option>
                  @endforeach
                </select>
                @error('state') <span class="contact-form__error">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="contact-form__field">
              <label for="contact_message">How can we Help You?</label>
              <textarea id="contact_message" name="message" rows="5" placeholder="How can we Help You?">{{ old('message') }}</textarea>
              @error('message') <span class="contact-form__error">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn--accent contact-form__submit">
              Send Request
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17L17 7"/><path d="M7 7h10v10"/></svg>
            </button>
            <p class="contact-form__privacy">{{ __('ui.privacy_note') }}</p>
          </form>
        </div>
      </div>
    </section>

    @include('front.partials.trusted-marquee')
    @include('front.partials.client-reviews')
    @include('front.partials.newsletter')
    @include('front.partials.footer')
  </main>
@endsection
