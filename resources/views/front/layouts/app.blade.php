<!DOCTYPE html>
<html lang="en" @if(($displayLocale ?? session('locale', 'en')) === 'hi') class="lang-hi" @endif>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $page?->document_title ?? ($legal['meta_title'] ?? 'Whizseed - Business Solutions') }}</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}?v=2" type="image/x-icon">
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=2" type="image/x-icon">

  @php
    $displayLocale = $displayLocale ?? session('locale', 'en');
    $metaDescription = $page?->meta_description_text ?? ($legal['meta_description'] ?? "Whizseed is your one-stop destination for company registration, GST, trademark, compliance, and business growth services across India.");
    $ogTitle = $page?->og_title_text ?? ($page?->document_title ?? ($legal['meta_title'] ?? 'Whizseed - Business Solutions'));
    $ogDescription = $page?->og_description_text ?? $metaDescription;
    $ogImage = $page?->og_image ?? asset('Image/logo.png');
    $canonical = url()->current();
  @endphp

  <meta name="description" content="{{ $metaDescription }}">
  @if(!empty($page?->seo_title))
    <meta name="keywords" content="{{ $page->seo_title }}">
  @endif
  <link rel="canonical" href="{{ $canonical }}">

  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ $canonical }}">
  <meta property="og:title" content="{{ $ogTitle }}">
  <meta property="og:description" content="{{ $ogDescription }}">
  <meta property="og:image" content="{{ $ogImage }}">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ $ogTitle }}">
  <meta name="twitter:description" content="{{ $ogDescription }}">
  <meta name="twitter:image" content="{{ $ogImage }}">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ filemtime(public_path('css/home.css')) }}">
  @stack('styles')
  <style>
    .goog-te-banner-frame,
    .goog-te-balloon-frame,
    #goog-gt-tt,
    .goog-tooltip,
    .goog-te-spinner-pos,
    .skiptranslate,
    .goog-logo-link,
    .VIpgJd-ZVi9od-l4eHX-hSRGPd,
    .VIpgJd-ZVi9od-ORHb-OEVmcd {
      display: none !important;
    }
    body { top: 0 !important; }
    #google_translate_element { display: none !important; }
    font font { background: none !important; box-shadow: none !important; }
  </style>
</head>
<body data-display-locale="{{ $displayLocale }}">
  <div id="google_translate_element" aria-hidden="true"></div>
  @yield('content')
  @include('front.partials.consult-modal')
  <script src="{{ asset('js/home.js') }}"></script>
  <script>
    (function () {
      var locale = document.body.getAttribute('data-display-locale') || 'en';
      var value = locale === 'hi' ? '/en/hi' : '/en/en';
      document.cookie = 'googtrans=' + value + ';path=/;max-age=' + (60 * 60 * 24 * 365);
      try {
        document.cookie = 'googtrans=' + value + ';path=/;domain=.' + location.hostname + ';max-age=' + (60 * 60 * 24 * 365);
      } catch (e) {}

      window.googleTranslateElementInit = function () {
        if (!window.google || !google.translate) return;
        new google.translate.TranslateElement({
          pageLanguage: 'en',
          includedLanguages: 'en,hi',
          autoDisplay: false,
          multilanguagePage: true
        }, 'google_translate_element');
      };
    })();
  </script>
  <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" defer></script>
  @stack('scripts')
</body>
</html>
