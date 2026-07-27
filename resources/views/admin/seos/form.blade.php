@extends('layouts.admin')

@section('title', isset($seo) && $seo->exists ? 'Edit SEO' : 'Create SEO')
@section('page-title', isset($seo) && $seo->exists ? 'Edit SEO' : 'Create SEO')

@section('content')
@php
  $seo = $seo ?? new \App\Models\Seo(['page_type' => 0]);
  $isEdit = $seo->exists;
@endphp
<div class="card">
    <div class="card-body">
        <form action="{{ $isEdit ? route('admin.seos.update', $seo) : route('admin.seos.store') }}" method="POST">
            @csrf
            @if($isEdit) @method('PUT') @endif
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Page Type *</label>
                    <select name="page_type" class="form-select" required>
                        <option value="0" @selected(old('page_type', $seo->page_type) == 0)>Content Page</option>
                        <option value="1" @selected(old('page_type', $seo->page_type) == 1)>Subcategory</option>
                        <option value="2" @selected(old('page_type', $seo->page_type) == 2)>Service</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Related ID (page_id) *</label>
                    <input type="number" name="page_id" class="form-control @error('page_id') is-invalid @enderror" value="{{ old('page_id', $seo->page_id) }}" min="1" required>
                    @error('page_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="text-muted">ID of the page, category, or service this SEO belongs to.</small>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $seo->meta_title) }}" maxlength="255">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Meta Keywords</label>
                    <input type="text" name="meta_keyword" class="form-control" value="{{ old('meta_keyword', $seo->meta_keyword) }}" maxlength="255">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="3" maxlength="255">{{ old('meta_description', $seo->meta_description) }}</textarea>
                </div>
            </div>
            <button class="btn btn-primary">{{ $isEdit ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.seos.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
