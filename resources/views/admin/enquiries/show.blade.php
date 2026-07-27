@extends('layouts.admin')

@section('title', 'Enquiry #'.$enquiry->id)
@section('page-title', 'Enquiry Details')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1>Enquiry #{{ $enquiry->id }}</h1>
        <p>{{ optional($enquiry->created_at)->format('M d, Y H:i') }}</p>
    </div>
    <a href="{{ route('admin.enquiries.index') }}" class="btn btn-outline-secondary">Back</a>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">Enquiry Details</div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-3">Name</dt><dd class="col-sm-9">{{ $enquiry->name }}</dd>
                    <dt class="col-sm-3">Email</dt><dd class="col-sm-9"><a href="mailto:{{ $enquiry->email }}">{{ $enquiry->email }}</a></dd>
                    <dt class="col-sm-3">Mobile</dt><dd class="col-sm-9"><a href="tel:{{ $enquiry->mobile }}">{{ $enquiry->mobile }}</a></dd>
                    <dt class="col-sm-3">State</dt><dd class="col-sm-9">{{ $enquiry->state?->name ?: '—' }}</dd>
                    <dt class="col-sm-3">Subject</dt><dd class="col-sm-9">{{ $enquiry->subject ?: '—' }}</dd>
                    <dt class="col-sm-3">Service</dt><dd class="col-sm-9">{{ $enquiry->service_slug ?: '—' }}</dd>
                    <dt class="col-sm-3">Message</dt><dd class="col-sm-9">{!! nl2br(e($enquiry->description ?: '—')) !!}</dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">Update Status</div>
            <div class="card-body">
                <form action="{{ route('admin.enquiries.status', $enquiry) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="status" class="form-select mb-3">
                        <option value="1" @selected($enquiry->status == 1)>New</option>
                        <option value="2" @selected($enquiry->status == 2)>In Progress</option>
                        <option value="3" @selected($enquiry->status == 3)>Closed</option>
                    </select>
                    <button class="btn btn-primary w-100">Save Status</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
