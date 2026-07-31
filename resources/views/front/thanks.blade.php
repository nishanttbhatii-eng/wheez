@extends('front.layouts.app')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endpush

@section('content')
  @include('front.partials.header')

  <main>
    <section class="thanks">
      <div class="thanks__glow" aria-hidden="true"></div>
      <div class="container thanks__inner">
        <div class="thanks__card">
          <span class="thanks__icon" aria-hidden="true">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 6L9 17l-5-5"/>
            </svg>
          </span>

          <h1 class="thanks__title">
            {{ __('ui.thanks_title') }}
            <span class="thanks__square" aria-hidden="true"></span>
          </h1>

          <p class="thanks__desc">
            {{ __('ui.thanks_desc') }}
          </p>

          <div class="thanks__actions">
            <a href="{{ route('home') }}" class="btn btn--accent thanks__btn">
              {{ __('ui.back_home') }}
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17L17 7"/><path d="M7 7h10v10"/></svg>
            </a>
            <a href="{{ route('services') }}" class="thanks__link">{{ __('ui.explore_services') }}</a>
          </div>
        </div>
      </div>
    </section>

    @include('front.partials.footer')
  </main>
@endsection
