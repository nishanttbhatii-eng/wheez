@php
  $countries = config('countries.list', []);
  $defaultCountry = config('countries.default', 'IN');
@endphp

<div
  class="consult-modal"
  id="consultModal"
  hidden
  role="dialog"
  aria-modal="true"
  aria-labelledby="consultModalTitle"
  @if(session('open_consult_modal')) data-auto-open="1" @endif
>
  <div class="consult-modal__backdrop js-consult-close" tabindex="-1"></div>
  <div class="consult-modal__dialog" role="document">
    <button type="button" class="consult-modal__close js-consult-close" aria-label="{{ __('ui.close_form') }}">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" aria-hidden="true">
        <path d="M6 6l12 12M18 6L6 18"/>
      </svg>
    </button>

    @include('front.partials.hn-consultation-form', [
      'service' => null,
      'formSuffix' => 'modal',
      'formModifier' => 'hn-consult--modal',
      'formTitle' => __('ui.consultation_by_expert'),
      'submitLabel' => __('ui.get_started'),
      'enquireAction' => route('enquire'),
      'showSuccess' => true,
    ])
  </div>
</div>
