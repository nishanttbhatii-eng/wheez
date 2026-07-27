@extends('layouts.admin')

@section('title', 'Lead #'.$lead->id)
@section('page-title', 'Lead Details')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1>{{ $lead->name }}</h1>
        <p>{{ optional($lead->created_at)->format('M d, Y H:i') }}</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.leads.edit', $lead) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('admin.leads.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-3">Name</dt><dd class="col-sm-9">{{ $lead->name }}</dd>
            <dt class="col-sm-3">Email</dt><dd class="col-sm-9"><a href="mailto:{{ $lead->email }}">{{ $lead->email }}</a></dd>
            <dt class="col-sm-3">Mobile</dt><dd class="col-sm-9"><a href="tel:{{ $lead->mobile }}">{{ $lead->mobile }}</a></dd>
            <dt class="col-sm-3">State</dt><dd class="col-sm-9">{{ $lead->state?->name ?: '—' }}</dd>
        </dl>
    </div>
</div>
@endsection
