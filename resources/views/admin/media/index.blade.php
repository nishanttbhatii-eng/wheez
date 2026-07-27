@extends('layouts.admin')

@section('title', 'Media')
@section('page-title', 'Media')

@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1>Media Library</h1>
        <p>Upload images and copy URLs to use anywhere</p>
    </div>
    <a href="{{ route('admin.media.create') }}" class="btn btn-primary"><i class="fas fa-upload me-2"></i>Upload Images</a>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.media.index') }}" class="row g-2 align-items-end">
            <div class="col-md-6">
                <label class="form-label">Search</label>
                <input type="text" name="q" class="form-control" value="{{ request('q') }}" placeholder="Title, file name, alt text…">
            </div>
            <div class="col-md-6 d-flex gap-2">
                <button class="btn btn-primary">Search</button>
                @if(request()->filled('q'))
                    <a href="{{ route('admin.media.index') }}" class="btn btn-outline-secondary">Clear</a>
                @endif
            </div>
        </form>
    </div>
</div>

@if($media->isEmpty())
    <div class="card">
        <div class="card-body text-center py-5">
            <p class="text-muted mb-3">No media found. Upload your first image to get started.</p>
            <a href="{{ route('admin.media.create') }}" class="btn btn-primary"><i class="fas fa-upload me-2"></i>Upload Images</a>
        </div>
    </div>
@else
    <div class="media-grid">
        @foreach($media as $item)
            <div class="media-card">
                <div class="media-card-preview">
                    <img src="{{ $item->url }}" alt="{{ $item->alt_text ?: $item->title }}" loading="lazy">
                </div>
                <div class="media-card-body">
                    <div class="media-card-title" title="{{ $item->title ?: $item->file_name }}">{{ $item->title ?: $item->file_name }}</div>
                    <div class="media-card-meta">
                        {{ $item->human_size }}
                        @if($item->width && $item->height)
                            · {{ $item->width }}×{{ $item->height }}
                        @endif
                    </div>
                    <div class="media-card-url-row">
                        <input type="text" class="form-control form-control-sm media-url-input" value="{{ $item->url }}" readonly>
                        <button type="button" class="btn btn-sm btn-primary media-copy-btn" data-url="{{ $item->url }}" title="Copy URL">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                    <div class="media-card-actions">
                        <a href="{{ route('admin.media.edit', $item) }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.media.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this image?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-3">
        {{ $media->links() }}
    </div>
@endif
@endsection

@push('scripts')
<script>
document.querySelectorAll('.media-copy-btn').forEach(function (btn) {
    btn.addEventListener('click', async function () {
        const url = this.getAttribute('data-url');
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
            const input = this.closest('.media-card-url-row').querySelector('.media-url-input');
            input.select();
            document.execCommand('copy');
            alert('URL copied');
        }
    });
});
</script>
@endpush
