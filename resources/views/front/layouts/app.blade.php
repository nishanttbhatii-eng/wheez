<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $page?->document_title ?? ($legal['meta_title'] ?? 'Whizseed - Business Solutions') }}</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}?v=2" type="image/x-icon">
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=2" type="image/x-icon">

  @php
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
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  @stack('styles')
</head>
<body>
  @yield('content')
  <script src="{{ asset('js/home.js') }}"></script>
  @stack('scripts')
</body>
</html>
