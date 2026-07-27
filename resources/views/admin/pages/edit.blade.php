@extends('layouts.admin')

@section('title', 'Edit Page')
@section('page-title', 'Edit Page')

@section('content')
<div class="page-header">
    <h1>Edit Page</h1>
    <p>Update your static page</p>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-edit me-2"></i>Page Information
    </div>
    <div class="card-body">
        <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-4">
                        <label for="title" class="form-label">Page Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $page->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $page->slug) }}" required>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">URL-friendly version of the title</small>
                    </div>

                    <div class="mb-4">
                        <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="8">{{ old('content', $page->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">The page content</small>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="draft" {{ old('status', $page->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $page->status) == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status', $page->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="featured_image" class="form-label">Featured Image</label>
                        @if($page->featured_image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $page->featured_image) }}" alt="{{ $page->title }}" style="max-width: 100%; height: auto; border-radius: 8px; max-height: 200px;">
                            </div>
                        @endif
                        <input type="file" class="form-control @error('featured_image') is-invalid @enderror" id="featured_image" name="featured_image" accept="image/*">
                        @error('featured_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Max size: 2MB. Formats: JPG, PNG, GIF. Leave empty to keep current image.</small>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3"><i class="fas fa-search me-2"></i>SEO & Meta Information</h5>

                    <div class="mb-4">
                        <label for="seo_title" class="form-label">SEO Title</label>
                        <input type="text" class="form-control @error('seo_title') is-invalid @enderror" id="seo_title" name="seo_title" value="{{ old('seo_title', $page->seo_title) }}" maxlength="255">
                        @error('seo_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Appears in search results. Leave empty to use page title.</small>
                    </div>

                    <div class="mb-4">
                        <label for="seo_description" class="form-label">SEO Description</label>
                        <textarea class="form-control @error('seo_description') is-invalid @enderror" id="seo_description" name="seo_description" rows="2" maxlength="255">{{ old('seo_description', $page->seo_description) }}</textarea>
                        @error('seo_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Brief description for search engines. Recommended: 150-160 characters.</small>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3"><i class="fas fa-share-alt me-2"></i>Meta Tags</h5>

                    <div class="mb-4">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" maxlength="255">
                        @error('meta_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Leave empty to use page title. Recommended: 50-60 characters</small>
                    </div>

                    <div class="mb-4">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="2" maxlength="255">{{ old('meta_description', $page->meta_description) }}</textarea>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Recommended: 150-160 characters</small>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3"><i class="fas fa-share-square me-2"></i>Open Graph (OG) Tags</h5>

                    <div class="mb-4">
                        <label for="og_title" class="form-label">OG Title</label>
                        <input type="text" class="form-control @error('og_title') is-invalid @enderror" id="og_title" name="og_title" value="{{ old('og_title', $page->og_title) }}" maxlength="255">
                        @error('og_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Title when shared on social media. Leave empty to use page title.</small>
                    </div>

                    <div class="mb-4">
                        <label for="og_description" class="form-label">OG Description</label>
                        <textarea class="form-control @error('og_description') is-invalid @enderror" id="og_description" name="og_description" rows="2" maxlength="255">{{ old('og_description', $page->og_description) }}</textarea>
                        @error('og_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Description when shared on social media</small>
                    </div>

                    <div class="mb-4">
                        <label for="og_image_url" class="form-label">OG Image URL</label>
                        <input type="url" class="form-control @error('og_image_url') is-invalid @enderror" id="og_image_url" name="og_image_url" value="{{ old('og_image_url', $page->og_image_url) }}" placeholder="https://example.com/image.jpg">
                        @error('og_image_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Full URL to image shown when shared on social media. Leave empty to use featured image.</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card" style="background: #f7fafc;">
                        <div class="card-body">
                            <h6 class="mb-3"><i class="fas fa-info-circle me-2"></i>Page Info</h6>
                            <div class="mb-3">
                                <small class="text-muted">
                                    <strong>Created:</strong> {{ $page->created_at->format('M d, Y H:i') }}
                                </small>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted">
                                    <strong>Last Updated:</strong> {{ $page->updated_at->format('M d, Y H:i') }}
                                </small>
                            </div>
                            <hr>
                            <div>
                                <small class="text-muted">
                                    <i class="fas fa-lightbulb me-1"></i> Tip: Keep slug consistent to maintain SEO.
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3" style="background: #f7fafc;">
                        <div class="card-body">
                            <h6 class="mb-3"><i class="fas fa-layers me-2"></i>Display Order</h6>
                            <div class="mb-3">
                                <label for="order" class="form-label">Order <small class="text-muted">(optional)</small></label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $page->order) }}" min="0">
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Lower numbers appear first</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update Page
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .page-header {
        margin-bottom: 30px;
    }
    .page-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: #2d3748;
        margin: 0 0 5px 0;
    }
    .page-header p {
        color: #718096;
        margin: 0;
    }
</style>
@endsection
