@extends('layouts.admin')

@section('title', 'Edit Media')
@section('page-title', 'Edit Media')

@section('content')
<div class="page-header">
    <h1>Edit Media</h1>
    <p>Update details or replace the image</p>
</div>

<div class="row">
    <div class="col-lg-5 mb-3">
        <div class="card">
            <div class="card-body text-center">
                <img src="{{ $media->url }}" alt="{{ $media->alt_text ?: $media->title }}" class="img-fluid rounded media-edit-preview">
                <div class="mt-3 text-muted small">
                    {{ $media->file_name }} · {{ $media->human_size }}
                    @if($media->width && $media->height)
                        · {{ $media->width }}×{{ $media->height }}
                    @endif
                </div>
                <div class="media-card-url-row mt-3">
                    <input type="text" class="form-control form-control-sm media-url-input" id="mediaUrl" value="{{ $media->url }}" readonly>
                    <button type="button" class="btn btn-sm btn-primary" id="copyMediaUrl" title="Copy URL">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7 mb-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.media.update', $media) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $media->title) }}">
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alt text</label>
                        <input type="text" name="alt_text" class="form-control @error('alt_text') is-invalid @enderror" value="{{ old('alt_text', $media->alt_text) }}">
                        @error('alt_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Replace image</label>
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" accept="image/jpeg,image/png,image/gif,image/webp">
                        <small class="text-muted">Leave empty to keep the current image · max 5 MB</small>
                        @error('file')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.media.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('copyMediaUrl').addEventListener('click', async function () {
    const url = document.getElementById('mediaUrl').value;
    try {
        await navigator.clipboard.writeText(url);
        const icon = this.querySelector('i');
        icon.className = 'fas fa-check';
        this.classList.add('btn-success');
        this.classList.remove('btn-primary');
        setTimeout(() => {
            icon.className = 'fas fa-copy';
            this.classList.remove('btn-success');
            this.classList.add('btn-primary');
        }, 1500);
    } catch (e) {
        document.getElementById('mediaUrl').select();
        document.execCommand('copy');
        alert('URL copied');
    }
});
</script>
@endpush
