@extends('layouts.admin')

@section('title', isset($service) && $service->exists ? 'Edit Service' : 'Create Service')
@section('page-title', isset($service) && $service->exists ? 'Edit Service' : 'Create Service')

@section('content')
@php
  $service = $service ?? new \App\Models\Service(['status' => 1, 'service_type' => 1, 'price' => 0, 'mrp_price' => 0]);
  $isEdit = $service->exists;
@endphp
<div class="page-header">
    <h1>{{ $isEdit ? 'Edit Service' : 'Create Service' }}</h1>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ $isEdit ? route('admin.services.update', $service) : route('admin.services.store') }}" method="POST">
            @csrf
            @if($isEdit) @method('PUT') @endif

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Name *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $service->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug', $service->slug) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select">
                        <option value="">— None —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('category_id', $service->category_id) == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Subcategory</label>
                    <select name="subcategory_id" class="form-select">
                        <option value="">— None —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('subcategory_id', $service->subcategory_id) == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
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
                    <label class="form-label">Visibility *</label>
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
                <div class="col-12 mb-3">
                    <label class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" rows="3">{{ old('short_description', $service->short_description) }}</textarea>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Small Description</label>
                    <textarea name="small_description" class="form-control" rows="3">{{ old('small_description', $service->small_description) }}</textarea>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-control ckeditor" rows="5">{{ old('description', $service->description) }}</textarea>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Long Description</label>
                    <textarea id="long_description" name="long_description" class="form-control ckeditor" rows="8">{{ old('long_description', $service->long_description) }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $service->meta_title) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $service->meta_keywords) }}">
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Meta Description</label>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
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
    .ck-editor__editable_inline {
        min-height: 180px;
    }
    #long_description + .ck-editor .ck-editor__editable_inline,
    .ck-editor__editable_inline[aria-labelledby*="long_description"] {
        min-height: 260px;
    }
</style>
@endpush
