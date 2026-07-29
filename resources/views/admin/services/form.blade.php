@extends('layouts.admin')

@section('title', isset($service) && $service->exists ? 'Edit Service' : 'Create Service')
@section('page-title', isset($service) && $service->exists ? 'Edit Service' : 'Create Service')

@section('content')
@php
  $service = $service ?? new \App\Models\Service(['status' => 1, 'service_type' => 1, 'price' => 0, 'mrp_price' => 0]);
  $isEdit = $service->exists;
  $oldLocations = old('city', []);
@endphp
<div class="page-header">
    <h1>{{ $isEdit ? 'Edit Service' : 'Create Service' }}</h1>
    @if(! $isEdit)
        <p class="text-muted mb-0">Select states or cities below to generate separate landing pages (same as old admin).</p>
    @else
        <p class="text-muted mb-0">Updating saves this record; selected states/cities create <strong>new</strong> location pages (old behaviour).</p>
    @endif
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ $isEdit ? route('admin.services.update', $service) : route('admin.services.store') }}" method="POST">
            @csrf
            @if($isEdit) @method('PUT') @endif

            <h5 class="mb-3">Basic information</h5>
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Title *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $service->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug', $service->slug) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" id="category_id" class="form-select">
                        <option value="">— None —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('category_id', $service->category_id) == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Subcategory</label>
                    <select name="subcategory_id" id="subcategory_id" class="form-select">
                        <option value="">— None —</option>
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $service->price) }}">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">MRP</label>
                    <input type="number" step="0.01" name="mrp_price" class="form-control" value="{{ old('mrp_price', $service->mrp_price) }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Service visibility *</label>
                    <select name="service_type" class="form-select" required>
                        <option value="1" @selected(old('service_type', $service->service_type) == 1)>Show</option>
                        <option value="0" @selected(old('service_type', $service->service_type) == 0)>Hide</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-select" required>
                        <option value="1" @selected(old('status', $service->status) == 1)>Active</option>
                        <option value="0" @selected(old('status', $service->status) == 0)>Inactive</option>
                    </select>
                </div>
            </div>

            <h5 class="mt-4 mb-2">City / state wise pages (optional)</h5>
            <p class="small text-muted">If none selected, one service is saved. If selected, each checkbox creates its own page (title + slug suffix).</p>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label mb-0">States</label>
                        <label class="small mb-0"><input type="checkbox" id="state_all"> Select all</label>
                    </div>
                    <div class="location-grid">
                        @foreach($states as $state)
                            <label class="location-chip">
                                <input type="checkbox" class="state_childs" name="city[]" value="{{ $state->name }}" @checked(in_array($state->name, $oldLocations, true))>
                                {{ $state->name }}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label mb-0">Cities</label>
                        <label class="small mb-0"><input type="checkbox" id="city_all"> Select all</label>
                    </div>
                    <div class="location-grid">
                        @foreach($cities as $city)
                            <label class="location-chip">
                                <input type="checkbox" class="city_childs" name="city[]" value="{{ $city->name }}" @checked(in_array($city->name, $oldLocations, true))>
                                {{ $city->name }}
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <h5 class="mt-4 mb-3">Content</h5>
            <div class="row">
                <div class="col-12 mb-3">
                    <label class="form-label">Small description</label>
                    <textarea id="small_description" name="small_description" class="form-control ckeditor" rows="4">{{ old('small_description', $service->small_description) }}</textarea>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-control ckeditor" rows="6">{{ old('description', $service->description) }}</textarea>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Short description</label>
                    <textarea name="short_description" class="form-control" rows="3">{{ old('short_description', $service->short_description) }}</textarea>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Long description</label>
                    <textarea id="long_description" name="long_description" class="form-control ckeditor" rows="6">{{ old('long_description', $service->long_description) }}</textarea>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Too long description</label>
                    <textarea id="too_long_description" name="too_long_description" class="form-control ckeditor" rows="8">{{ old('too_long_description', $service->too_long_description) }}</textarea>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Talk to expert description</label>
                    <textarea id="talk_to_expert_description" name="talk_to_expert_description" class="form-control ckeditor" rows="4">{{ old('talk_to_expert_description', $service->talk_to_expert_description) }}</textarea>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Testimonial description</label>
                    <textarea id="testmonial_description" name="testmonial_description" class="form-control ckeditor" rows="4">{{ old('testmonial_description', $service->testmonial_description) }}</textarea>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Advisory services</label>
                    <textarea id="advisory_services" name="advisory_services" class="form-control ckeditor" rows="4">{{ old('advisory_services', $service->advisory_services) }}</textarea>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Get started</label>
                    <textarea id="get_started" name="get_started" class="form-control ckeditor" rows="4">{{ old('get_started', $service->get_started) }}</textarea>
                </div>
            </div>

            <h5 class="mt-4 mb-3">Caller / consultation</h5>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Caller mobile number</label>
                    <input type="text" name="free_consultation_desc" class="form-control" value="{{ old('free_consultation_desc', $service->free_consultation_desc) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Caller name</label>
                    <input type="text" name="caller_name" class="form-control" value="{{ old('caller_name', $service->caller_name) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Caller description</label>
                    <input type="text" name="caller_description" class="form-control" value="{{ old('caller_description', $service->caller_description) }}">
                </div>
            </div>

            <h5 class="mt-4 mb-3">SEO</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Meta title</label>
                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $service->meta_title) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Meta keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $service->meta_keywords) }}">
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Meta description</label>
                    <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description', $service->meta_description) }}</textarea>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-primary">{{ $isEdit ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
.location-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    max-height: 220px;
    overflow-y: auto;
    padding: 12px;
    border: 1px solid var(--brand-border, #e4e4e7);
    border-radius: 8px;
    background: #fff;
}
.location-chip {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 10px;
    border-radius: 999px;
    background: #f4f4f5;
    font-size: 13px;
    margin: 0;
    cursor: pointer;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const categorySelect = document.getElementById('category_id');
    const subSelect = document.getElementById('subcategory_id');
    const selectedSub = @json(old('subcategory_id', $service->subcategory_id));

    function loadSubcategories(categoryId, preselect) {
        if (!subSelect) return;
        subSelect.innerHTML = '<option value="">— None —</option>';
        if (!categoryId) return;
        fetch(@json(route('admin.services.subcategories')) + '?category_id=' + encodeURIComponent(categoryId))
            .then(r => r.json())
            .then(items => {
                items.forEach(function (item) {
                    const opt = document.createElement('option');
                    opt.value = item.id;
                    opt.textContent = item.name;
                    if (String(preselect) === String(item.id)) opt.selected = true;
                    subSelect.appendChild(opt);
                });
            });
    }

    if (categorySelect) {
        categorySelect.addEventListener('change', function () {
            loadSubcategories(this.value, null);
        });
        if (categorySelect.value) {
            loadSubcategories(categorySelect.value, selectedSub);
        }
    }

    function bindSelectAll(masterId, childClass) {
        const master = document.getElementById(masterId);
        if (!master) return;
        master.addEventListener('change', function () {
            document.querySelectorAll('.' + childClass).forEach(function (el) {
                el.checked = master.checked;
            });
        });
    }
    bindSelectAll('state_all', 'state_childs');
    bindSelectAll('city_all', 'city_childs');

    const editors = [];
    const toolbar = [
        'heading', '|',
        'bold', 'italic', 'link', '|',
        'bulletedList', 'numberedList', 'blockQuote', '|',
        'insertTable', 'undo', 'redo'
    ];

    document.querySelectorAll('textarea.ckeditor').forEach(function (el) {
        ClassicEditor
            .create(el, { toolbar: toolbar })
            .then(function (editor) {
                editors.push(editor);
            })
            .catch(function (error) {
                console.error(error);
            });
    });

    const form = document.querySelector('.card form');
    if (form) {
        form.addEventListener('submit', function () {
            editors.forEach(function (editor) {
                editor.updateSourceElement();
            });
        });
    }
});
</script>
<style>
    .ck-editor__editable_inline { min-height: 180px; }
</style>
@endpush
