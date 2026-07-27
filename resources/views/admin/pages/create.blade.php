@extends('layouts.admin')

@section('title', 'Create Page')
@section('page-title', 'Create New Page')

@section('content')
<div class="page-header">
    <h1>Create Page</h1>
    <p>Add a new static page</p>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-plus me-2"></i>Page Information
    </div>
    <div class="card-body">
        <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-4">
                        <label for="title" class="form-label">Page Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}" required>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">URL-friendly version of the title (e.g., about-us)</small>
                    </div>

                    <div class="mb-4">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="8">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">For the home page (slug: <code>home</code>), this text is shown as the hero description. For other pages, this is the main page body.</small>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="featured_image" class="form-label">Featured Image</label>
                        <input type="file" class="form-control @error('featured_image') is-invalid @enderror" id="featured_image" name="featured_image" accept="image/*">
                        @error('featured_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Max size: 2MB. Formats: JPG, PNG, GIF</small>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3"><i class="fas fa-search me-2"></i>SEO & Meta Information</h5>

                    <div class="mb-4">
                        <label for="seo_title" class="form-label">SEO Title</label>
                        <input type="text" class="form-control @error('seo_title') is-invalid @enderror" id="seo_title" name="seo_title" value="{{ old('seo_title') }}" maxlength="255">
                        @error('seo_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Appears in search results. Leave empty to use page title.</small>
                    </div>

                    <div class="mb-4">
                        <label for="seo_description" class="form-label">SEO Description</label>
                        <textarea class="form-control @error('seo_description') is-invalid @enderror" id="seo_description" name="seo_description" rows="2" maxlength="255">{{ old('seo_description') }}</textarea>
                        @error('seo_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Brief description for search engines. Recommended: 150-160 characters.</small>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3"><i class="fas fa-share-alt me-2"></i>Meta Tags</h5>

                    <div class="mb-4">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" name="meta_title" value="{{ old('meta_title') }}" maxlength="255">
                        @error('meta_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Leave empty to use page title. Recommended: 50-60 characters</small>
                    </div>

                    <div class="mb-4">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="2" maxlength="255">{{ old('meta_description') }}</textarea>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Recommended: 150-160 characters</small>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3"><i class="fas fa-share-square me-2"></i>Open Graph (OG) Tags</h5>

                    <div class="mb-4">
                        <label for="og_title" class="form-label">OG Title</label>
                        <input type="text" class="form-control @error('og_title') is-invalid @enderror" id="og_title" name="og_title" value="{{ old('og_title') }}" maxlength="255">
                        @error('og_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Title when shared on social media. Leave empty to use page title.</small>
                    </div>

                    <div class="mb-4">
                        <label for="og_description" class="form-label">OG Description</label>
                        <textarea class="form-control @error('og_description') is-invalid @enderror" id="og_description" name="og_description" rows="2" maxlength="255">{{ old('og_description') }}</textarea>
                        @error('og_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Description when shared on social media</small>
                    </div>

                    <div class="mb-4">
                        <label for="og_image_url" class="form-label">OG Image URL</label>
                        <input type="url" class="form-control @error('og_image_url') is-invalid @enderror" id="og_image_url" name="og_image_url" value="{{ old('og_image_url') }}" placeholder="https://example.com/image.jpg">
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
                                    <strong>Status:</strong> Determine if this page is visible to visitors
                                </small>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted">
                                    <strong>Slug:</strong> Used in the page URL. Keep it lowercase with hyphens.
                                </small>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted">
                                    <strong>Order:</strong> Leave empty or 0 to use default ordering
                                </small>
                            </div>
                            <hr>
                            <div>
                                <small class="text-muted">
                                    <i class="fas fa-lightbulb me-1"></i> Tip: Use SEO fields to improve search visibility.
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3" style="background: #f7fafc;">
                        <div class="card-body">
                            <h6 class="mb-3"><i class="fas fa-layers me-2"></i>Display Order</h6>
                            <div class="mb-3">
                                <label for="order" class="form-label">Order <small class="text-muted">(optional)</small></label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', 0) }}" min="0">
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
                    <i class="fas fa-arrow-left me-2"></i>Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Create Page
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Auto-generate slug from title
    $('#title').on('keyup', function() {
        let title = $(this).val();
        let slug = title
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
        
        if ($('#slug').val() === '') {
            $('#slug').val(slug);
        }
    });
});
</script>
@endpush

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
