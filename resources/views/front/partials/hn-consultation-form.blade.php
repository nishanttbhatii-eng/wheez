@php
  $suffix = $formSuffix ?? 'main';
  $modifier = $formModifier ?? '';
  $formClass = trim('hn-consult '.$modifier);
  $countries = config('countries.list', []);
  $defaultCountry = old('country', config('countries.default', 'IN'));
  if (! isset($countries[$defaultCountry])) {
      $defaultCountry = 'IN';
  }
  $defaultMeta = $countries[$defaultCountry];
  $statesList = $defaultMeta['states'] ?? [];
  $formTitle = $formTitle ?? __('ui.consultation_by_expert');
  $submitLabel = $submitLabel ?? __('ui.get_started');
  $oldState = old('state');
  $enquireAction = $enquireAction
      ?? (isset($service) && $service ? route('services.enquire', $service->slug) : route('enquire'));
  $successKey = $successKey ?? 'service_enquiry_success';
@endphp

<form
  class="{{ $formClass }} js-consult-form"
  action="{{ $enquireAction }}"
  method="post"
  novalidate
  data-countries='@json($countries)'
  data-default-country="{{ $defaultCountry }}"
  data-state-placeholder="{{ __('ui.select_state') }}"
>
  @csrf
  @if(isset($service) && $service)
    <input type="hidden" name="service_id" value="{{ $service->id }}">
    <input type="hidden" name="service_slug" value="{{ $service->slug }}">
  @else
    <input type="hidden" name="service_slug" value="" class="js-modal-service-slug">
  @endif
  <input type="hidden" name="country_code" class="js-country-dial" value="{{ $defaultMeta['dial'] }}">

  <h2 class="hn-consult__title" @if($suffix === 'modal') id="consultModalTitle" @endif>{{ $formTitle }}</h2>

  @if(session($successKey) && ($showSuccess ?? true))
    <div class="hn-consult__success" role="status">{{ session($successKey) }}</div>
  @endif

  <div class="hn-consult__field">
    <input
      type="text"
      id="hn_name_{{ $suffix }}"
      name="name"
      value="{{ old('name') }}"
      placeholder="{{ __('ui.your_name') }}"
      autocomplete="name"
      required
    >
    @error('name') <span class="hn-consult__error">{{ $message }}</span> @enderror
  </div>

  <div class="hn-consult__field">
    <input
      type="email"
      id="hn_email_{{ $suffix }}"
      name="email"
      value="{{ old('email') }}"
      placeholder="{{ __('ui.email_address') }}"
      autocomplete="email"
      required
    >
    @error('email') <span class="hn-consult__error">{{ $message }}</span> @enderror
  </div>

  <div class="hn-consult__field">
    <div class="hn-consult__phone">
      <label class="hn-consult__phone-code hn-consult__phone-code--select" for="hn_country_{{ $suffix }}">
        <select
          id="hn_country_{{ $suffix }}"
          name="country"
          class="js-country-select"
          aria-label="Country code"
          required
        >
          @foreach($countries as $iso => $country)
            <option
              value="{{ $iso }}"
              data-dial="{{ $country['dial'] }}"
              data-flag="{{ $country['flag'] }}"
              @selected($iso === $defaultCountry)
            >
              {{ $country['flag'] }} +{{ $country['dial'] !== '' ? $country['dial'] : '—' }} {{ $country['name'] }}
            </option>
          @endforeach
        </select>
      </label>
      <input
        type="tel"
        id="hn_mobile_{{ $suffix }}"
        name="mobile"
        class="js-mobile-input"
        value="{{ old('mobile') }}"
        placeholder="{{ __('ui.mobile_number') }}"
        inputmode="numeric"
        maxlength="15"
        pattern="[0-9]{6,15}"
        autocomplete="tel-national"
        required
      >
    </div>
    @error('mobile') <span class="hn-consult__error">{{ $message }}</span> @enderror
    @error('country') <span class="hn-consult__error">{{ $message }}</span> @enderror
  </div>

  <div class="hn-consult__field">
    <select id="hn_state_{{ $suffix }}" name="state" class="js-state-select" required>
      <option value="">{{ __('ui.select_state') }}</option>
      @foreach($statesList as $state)
        <option value="{{ $state }}" @selected($oldState === $state)>{{ $state }}</option>
      @endforeach
    </select>
    @error('state') <span class="hn-consult__error">{{ $message }}</span> @enderror
  </div>

  <button type="submit" class="btn btn--accent hn-consult__submit">
    <span class="hn-consult__submit-text">{{ $submitLabel }}</span>
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17L17 7"/><path d="M7 7h10v10"/></svg>
  </button>
  <p class="hn-consult__privacy">{{ __('ui.privacy_note') }}</p>
</form>
