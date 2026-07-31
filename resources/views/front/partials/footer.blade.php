<!-- Footer Top Bar -->
<footer class="footer">
  <div class="container footer__inner">
    <div class="footer__left">
      <a href="{{ route('about') }}" class="footer__link">{{ __('ui.about_us') }}</a>
      <span class="footer__sep">|</span>
      <a href="{{ route('terms') }}" class="footer__link">{{ __('ui.terms') }}</a>
      <span class="footer__sep">|</span>
      <a href="{{ route('privacy') }}" class="footer__link">{{ __('ui.privacy') }}</a>
      <span class="footer__sep">|</span>
      <a href="#" class="footer__link">{{ __('ui.refund') }}</a>
    </div>
    <div class="footer__right">
      <a
        href="https://wa.me/919625432342?text={{ urlencode(__('ui.wa_prefill')) }}"
        class="footer__social footer__social--whatsapp"
        aria-label="{{ __('ui.whatsapp_chat') }}"
        target="_blank"
        rel="noopener"
      >
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
      </a>
      <a href="#" class="footer__social" aria-label="Facebook">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3V2z"/></svg>
      </a>
      <a href="#" class="footer__social" aria-label="X (Twitter)">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
      </a>
      <a href="#" class="footer__social" aria-label="YouTube">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
      </a>
      <a href="#" class="footer__social" aria-label="LinkedIn">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
      </a>
      <a href="#" class="footer__social" aria-label="Instagram">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
      </a>
    </div>
  </div>
</footer>

{{-- Floating WhatsApp chat --}}
<a
  href="https://wa.me/919625432342?text={{ urlencode(__('ui.wa_prefill')) }}"
  class="wa-chat"
  target="_blank"
  rel="noopener"
  aria-label="{{ __('ui.whatsapp_chat') }}"
>
  <span class="wa-chat__pulse" aria-hidden="true"></span>
  <svg class="wa-chat__icon" width="28" height="28" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
  <span class="wa-chat__label">{{ __('ui.chat_with_us') }}</span>
</a>

<!-- Mega Footer -->
<footer class="mega-footer">
  <div class="mega-footer__container">
    <div class="mega-footer__grid">
      @foreach (config('services_catalog.categories') as $category)
        <div class="mega-footer__col">
          <h3 class="mega-footer__col-title">{{ $category['title'] }}</h3>
          <ul class="mega-footer__col-links">
            @foreach (array_slice($category['services'], 0, 5) as $service)
              <li><a href="#">{{ $service }}</a></li>
            @endforeach
          </ul>
        </div>
      @endforeach
    </div>

    <div class="mega-footer__content">
      <div class="mega-footer__block">
        <h3 class="mega-footer__block-title">Starting a Business</h3>
        <p class="mega-footer__block-text">Starting a business in India involves several legal and regulatory steps. From choosing the right business structure to obtaining necessary registrations, Whizseed simplifies the entire process. We help entrepreneurs navigate company incorporation, tax registrations, and compliance requirements with ease, ensuring a smooth launch for your venture.</p>
      </div>
      <div class="mega-footer__block">
        <h3 class="mega-footer__block-title">Intellectual Property Rights</h3>
        <p class="mega-footer__block-text">Protecting your intellectual property is crucial in today's competitive market. Our services cover trademark registration, copyright protection, and patent filing. We assist businesses in safeguarding their brand identity, creative works, and innovations through comprehensive IP strategies tailored to your specific needs.</p>
      </div>
      <div class="mega-footer__block">
        <h3 class="mega-footer__block-title">Legal Documentation</h3>
        <p class="mega-footer__block-text">Proper legal documentation forms the backbone of any successful business. We offer a wide range of legal document services including founder agreements, shareholder agreements, non-disclosure agreements, and term sheets. Our expert team ensures all documents are drafted professionally and comply with current Indian laws.</p>
      </div>
      <div class="mega-footer__block">
        <h3 class="mega-footer__block-title">Mandatory Compliance</h3>
        <p class="mega-footer__block-text">Staying compliant with regulatory requirements is essential for business continuity. We provide comprehensive compliance management services including annual filings, tax return submissions, board meeting minutes, and statutory register maintenance. Our automated reminders and expert guidance help you meet every deadline.</p>
      </div>
      <div class="mega-footer__block">
        <h3 class="mega-footer__block-title">Need for Lawyers</h3>
        <p class="mega-footer__block-text">While our platform handles most legal and compliance tasks, we recognize the importance of professional legal counsel for complex matters. We connect you with experienced lawyers across various specializations who can provide personalized advice, represent you in legal proceedings, and handle intricate legal documentation.</p>
      </div>
    </div>

    <div class="mega-footer__disclaimer">
      <p class="mega-footer__disclaimer-text">
        By continuing past this page, you agree to our
        <a href="{{ route('terms') }}">Terms &amp; Conditions</a>,
        <a href="{{ route('privacy') }}">Privacy Policy</a>, and
        <a href="#">Refund Policy</a>.
      </p>
      <p class="mega-footer__copyright">All Rights Reserved &copy; Whizseed, {{ date('Y') }}</p>
    </div>
  </div>
</footer>
