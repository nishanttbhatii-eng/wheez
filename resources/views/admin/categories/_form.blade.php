@extends('layouts.admin')

@section('title', $category->exists ? 'Edit Category' : 'Create Category')
@section('page-title', $category->exists ? 'Edit Category' : 'Create Category')

@section('content')
@php $isEdit = $category->exists; @endphp
<div class="page-header">
    <h1>{{ $isEdit ? 'Edit Category' : 'Create Category' }}</h1>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ $isEdit ? route('admin.categories.update', $category) : route('admin.categories.store') }}" method="POST">
            @csrf
            @if($isEdit) @method('PUT') @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Name *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $category->slug) }}">
                    @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Parent Category</label>
                    <select name="parent_id" class="form-select">
                        <option value="0">— Root —</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-select" required>
                        <option value="1" @selected(old('status', $category->status ?? 1) == 1)>Active</option>
                        <option value="0" @selected(old('status', $category->status ?? 1) == 0)>Inactive</option>
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" rows="3">{{ old('short_description', $category->short_description) }}</textarea>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5">{{ old('description', $category->description) }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $category->meta_title) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $category->meta_keywords) }}">
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description', $category->meta_description) }}</textarea>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-primary">{{ $isEdit ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
