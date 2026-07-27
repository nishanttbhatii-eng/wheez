@php
  $suffix = $formSuffix ?? 'main';
@endphp

@if(session('service_enquiry_success') && ($showSuccess ?? true))
  <div class="sp-consult__success" role="status">
    {{ session('service_enquiry_success') }}
  </div>
@endif

<form class="sp-consult" action="{{ route('services.enquire', $service->slug) }}" method="post" novalidate>
  @csrf
  <h2 class="sp-consult__title">Consultation by Expert</h2>

  <div class="sp-consult__field">
    <input type="text" id="service_name_{{ $suffix }}" name="name" value="{{ old('name') }}" placeholder="Your Name" required>
    @error('name') <span class="sp-consult__error">{{ $message }}</span> @enderror
  </div>

  <div class="sp-consult__field">
    <input type="email" id="service_email_{{ $suffix }}" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
    @error('email') <span class="sp-consult__error">{{ $message }}</span> @enderror
  </div>

  <div class="sp-consult__field">
    <div class="sp-consult__phone">
      <span class="sp-consult__phone-code" aria-hidden="true">🇮🇳 +91</span>
      <input type="tel" id="service_mobile_{{ $suffix }}" name="mobile" value="{{ old('mobile') }}" placeholder="Mobile Number" inputmode="numeric" maxlength="10" pattern="[0-9]{10}" required>
    </div>
    @error('mobile') <span class="sp-consult__error">{{ $message }}</span> @enderror
  </div>

  <div class="sp-consult__field">
    <select id="service_state_{{ $suffix }}" name="state" required>
      <option value="">Select State</option>
      @foreach($states as $state)
        <option value="{{ $state }}" @selected(old('state') === $state)>{{ $state }}</option>
      @endforeach
    </select>
    @error('state') <span class="sp-consult__error">{{ $message }}</span> @enderror
  </div>

  <button type="submit" class="btn btn--accent sp-consult__submit">
    Get Started Now
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17L17 7"/><path d="M7 7h10v10"/></svg>
  </button>

  <p class="sp-consult__privacy">We'll never share your details with third parties. we won't spam you</p>
</form>
