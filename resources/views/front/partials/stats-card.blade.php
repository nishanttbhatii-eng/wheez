@php
  $statsCardClass = trim($statsCardClass ?? 'features__card features__card--dark');
  $statsCtaLabel = $statsCtaLabel ?? null;
  $statsCtaClass = trim('btn btn--accent stats-card__cta '.($statsCtaExtraClass ?? 'js-open-consult'));
@endphp
<article class="{{ $statsCardClass }} stats-card js-stats-card{{ $statsCtaLabel ? ' stats-card--with-cta' : '' }}" aria-label="Company statistics">
  <div class="stats-card__item">
    <span class="stats-card__label">BUSINESS EMPOWERED</span>
    <span class="stats-card__value js-count-up" data-count="1800" data-suffix="+">0+</span>
  </div>
  <div class="stats-card__item">
    <span class="stats-card__label">OF INDUSTRY EXPERIENCE</span>
    <span class="stats-card__value js-count-up" data-count="3" data-suffix="+ Year">0+ Year</span>
  </div>
  <div class="stats-card__item">
    <span class="stats-card__label">CLIENT SATISFACTION</span>
    <span class="stats-card__value js-count-up" data-count="98" data-suffix="%">0%</span>
  </div>
  @if($statsCtaLabel)
    <a href="{{ $statsCtaHref ?? '#consult' }}" class="{{ $statsCtaClass }}">
      {{ $statsCtaLabel }}
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17L17 7"/><path d="M7 7h10v10"/></svg>
    </a>
  @endif
</article>
