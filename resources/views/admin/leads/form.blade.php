@extends('layouts.admin')

@section('title', isset($lead) && $lead->exists ? 'Edit Lead' : 'Create Lead')
@section('page-title', isset($lead) && $lead->exists ? 'Edit Lead' : 'Create Lead')

@section('content')
@php
  $lead = $lead ?? new \App\Models\Lead();
  $isEdit = $lead->exists;
@endphp
<div class="card">
    <div class="card-body">
        <form action="{{ $isEdit ? route('admin.leads.update', $lead) : route('admin.leads.store') }}" method="POST">
            @csrf
            @if($isEdit) @method('PUT') @endif
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Name *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $lead->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $lead->email) }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Mobile *</label>
                    <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mobile', $lead->mobile) }}" maxlength="10" required>
                    @error('mobile')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">State</label>
                    <select name="state_id" class="form-select">
                        <option value="">— Select —</option>
                        @foreach($states as $state)
                            <option value="{{ $state->id }}" @selected(old('state_id', $lead->state_id) == $state->id)>{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button class="btn btn-primary">{{ $isEdit ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.leads.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
