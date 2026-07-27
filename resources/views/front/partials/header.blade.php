@php
  $activeNav = $activeNav ?? '';
  $primaryMenu = $primaryMenu ?? collect();
  $secondaryMenu = $secondaryMenu ?? collect();
  $headerMenu = $primaryMenu->filter(fn ($item) => $item->title !== 'Global');
  $globalMenu = $primaryMenu->firstWhere('title', 'Global');
@endphp
<header class="header">
  <div class="header__top">
    <div class="container header__inner">
      <div class="header__left">
        <a href="{{ route('home') }}" class="logo logo--brand" aria-label="Whizseed Home">
          <img
            src="{{ asset('Image/logo.svg') }}"
            alt="Whizseed"
            class="logo__svg"
            width="110"
            height="66"
            onerror="this.onerror=null;this.src='{{ asset('Image/logo.png') }}';this.classList.add('logo__svg--fallback');"
          >
        </a>
      </div>

      <div class="header__center" id="navMenu">
          <nav class="nav" aria-label="Main navigation">
            <ul class="nav__list">
              @foreach($headerMenu as $item)
                <li class="nav__item {{ $item->hasDropdown() ? 'nav__item--mega' : '' }}">
                  <a
                    href="{{ $item->url ?: '#' }}"
                    class="nav__link {{ $activeNav === \Illuminate\Support\Str::slug($item->title) ? 'nav__link--active' : '' }}"
                    @if($item->hasDropdown()) aria-haspopup="true" aria-expanded="false" @endif
                  >
                    {{ $item->title }}
                    @if($item->hasDropdown())
                      <svg class="nav__arrow" width="10" height="10" viewBox="0 0 10 10" aria-hidden="true">
                        <path d="M1.5 3.5L5 6.5L8.5 3.5" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                    @endif
                  </a>
                  @if($item->hasDropdown())
                    <div class="mega-menu" role="menu">
                      <div class="mega-menu__inner">
                        @foreach($item->activeChildren as $group)
                          <div class="mega-menu__col">
                            <h4 class="mega-menu__heading">{{ $group->title }}</h4>
                            <ul class="mega-menu__links">
                              @foreach($group->activeChildren as $link)
                                <li>
                                  <a
                                    href="{{ $link->url ?: '#' }}"
                                    class="mega-menu__link"
                                    @if($link->open_in_new_tab) target="_blank" rel="noopener" @endif
                                  >{{ $link->title }}</a>
                                </li>
                              @endforeach
                            </ul>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  @endif
                </li>
              @endforeach
            </ul>
          </nav>
          @if($secondaryMenu->isNotEmpty())
            <ul class="nav__list nav__list--secondary-mobile">
              @foreach($secondaryMenu as $link)
                <li class="nav__item nav__item--secondary-only">
                  <a href="{{ $link->url ?: '#' }}" class="nav__link {{ $activeNav === \Illuminate\Support\Str::slug($link->title) ? 'nav__link--active' : '' }}">{{ $link->title }}</a>
                </li>
              @endforeach
            </ul>
          @endif
      </div>

      <div class="header__right">
        <div class="lang-selector" role="button" tabindex="0" aria-label="Language">
          <span class="lang-selector__text">GB EN</span>
          <svg class="lang-selector__arrow" width="10" height="10" viewBox="0 0 10 10" aria-hidden="true">
            <path d="M1.5 3.5L5 6.5L8.5 3.5" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <a href="https://wa.me/919625432342" class="btn-whatsapp" aria-label="WhatsApp" target="_blank" rel="noopener">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        </a>
        <a href="tel:9625432342" class="btn-phone">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
          <span class="btn-phone__text">9625432342</span>
        </a>
        <button class="hamburger" id="hamburger" aria-label="Menu" type="button" aria-expanded="false" aria-controls="headerExtra">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <div class="header__extra" id="headerExtra" hidden>
          @if($globalMenu)
            <div class="header__extra-section">
              <!-- <a href="{{ $globalMenu->url ?: '#' }}" class="header__extra-title">{{ $globalMenu->title }}</a> -->
              <!-- @if($globalMenu->hasDropdown())
                <ul class="header__extra-links">
                  @foreach($globalMenu->activeChildren as $group)
                    @foreach($group->activeChildren as $link)
                      <li><a href="{{ $link->url ?: '#' }}">{{ $link->title }}</a></li>
                    @endforeach
                  @endforeach
                </ul>
              @endif -->
            </div>
          @endif
          @if($secondaryMenu->isNotEmpty())
            <ul class="header__extra-links header__extra-links--inline">
              @foreach($secondaryMenu as $link)
                <li><a href="{{ $link->url ?: '#' }}" class="{{ $activeNav === \Illuminate\Support\Str::slug($link->title) ? 'is-active' : '' }}">{{ $link->title }}</a></li>
              @endforeach
            </ul>
          @endif
        </div>
      </div>
    </div>
  </div>
</header>
