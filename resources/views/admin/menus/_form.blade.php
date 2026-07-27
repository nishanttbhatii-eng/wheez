@php
    $menu = $menu ?? null;
    $isEdit = !empty($menu);
@endphp

<div class="mb-3">
    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $menu->title ?? '') }}" required>
    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="location" class="form-label">Menu Location <span class="text-danger">*</span></label>
        <select class="form-select @error('location') is-invalid @enderror" id="location" name="location" required>
            <option value="primary" {{ old('location', $menu->location ?? $location) === 'primary' ? 'selected' : '' }}>Primary (Mega Menu)</option>
            <option value="secondary" {{ old('location', $menu->location ?? $location) === 'secondary' ? 'selected' : '' }}>Secondary (About, Contact…)</option>
        </select>
        @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
            <option value="menu" {{ old('type', $menu->type ?? '') === 'menu' ? 'selected' : '' }}>Menu (top-level dropdown)</option>
            <option value="group" {{ old('type', $menu->type ?? '') === 'group' ? 'selected' : '' }}>Group (column heading)</option>
            <option value="link" {{ old('type', $menu->type ?? 'link') === 'link' ? 'selected' : '' }}>Link</option>
        </select>
        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<div class="mb-3">
    <label for="parent_id" class="form-label">Parent Item</label>
    <select class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
        <option value="">— None (top level) —</option>
        @foreach($parentOptions as $parent)
            <option value="{{ $parent->id }}" {{ (string) old('parent_id', $menu->parent_id ?? '') === (string) $parent->id ? 'selected' : '' }}>
                {{ $parent->title }} ({{ ucfirst($parent->type) }})
            </option>
        @endforeach
    </select>
    @error('parent_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="url" class="form-label">URL</label>
    <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url', $menu->url ?? '') }}" placeholder="https:// or /page/slug or #">
    @error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
    <small class="text-muted">Leave empty for menu/group headings without a direct link.</small>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label for="order" class="form-label">Sort Order</label>
        <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $menu->order ?? 0) }}" min="0">
        @error('order')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4 mb-3 d-flex align-items-end">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $menu->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Active (visible on site)</label>
        </div>
    </div>
    <div class="col-md-4 mb-3 d-flex align-items-end">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="open_in_new_tab" name="open_in_new_tab" value="1" {{ old('open_in_new_tab', $menu->open_in_new_tab ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="open_in_new_tab">Open in new tab</label>
        </div>
    </div>
</div>
