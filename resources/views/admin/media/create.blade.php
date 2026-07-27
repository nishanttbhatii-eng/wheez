@extends('layouts.admin')

@section('title', 'Upload Media')
@section('page-title', 'Upload Media')

@section('content')
<div class="page-header">
    <h1>Upload Images</h1>
    <p>Upload one or more images to the media library</p>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Images *</label>
                <input type="file" name="files[]" id="mediaFiles" class="form-control @error('files') is-invalid @enderror @error('files.*') is-invalid @enderror" accept="image/jpeg,image/png,image/gif,image/webp" multiple required>
                <small class="text-muted">JPEG, PNG, GIF, or WebP · max 5 MB each · you can select multiple files</small>
                @error('files')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                @error('files.*')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <div id="mediaPreview" class="media-upload-preview mb-3"></div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Title (optional)</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Applied to all files if set">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Alt text (optional)</label>
                    <input type="text" name="alt_text" class="form-control" value="{{ old('alt_text') }}" placeholder="Applied to all files if set">
                </div>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-primary"><i class="fas fa-upload me-2"></i>Upload</button>
                <a href="{{ route('admin.media.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('mediaFiles').addEventListener('change', function () {
    const preview = document.getElementById('mediaPreview');
    preview.innerHTML = '';
    Array.from(this.files).forEach(function (file) {
        const url = URL.createObjectURL(file);
        const item = document.createElement('div');
        item.className = 'media-upload-preview-item';
        item.innerHTML = '<img src="' + url + '" alt=""><span>' + file.name + '</span>';
        preview.appendChild(item);
    });
});
</script>
@endpush
