@extends('layouts.admin')

@section('title', 'Site Settings')
@section('page-title', 'Site Settings')

@section('content')
<div class="page-header">
    <h1>Site Settings</h1>
    <p>Company contact details and site configuration from CMS</p>
</div>

<div class="card mb-4">
    <div class="card-header">Editable Settings</div>
    <div class="card-body">
        <form action="{{ route('admin.site-settings.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                @foreach($keys as $key)
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ $key }}</label>
                        <input type="text" name="settings[{{ $key }}]" class="form-control" value="{{ old('settings.'.$key, $settings[$key] ?? '') }}">
                    </div>
                @endforeach
            </div>
            <button class="btn btn-primary">Save Settings</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">All Settings ({{ $allSettings->count() }})</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-hover">
                <thead><tr><th>Key</th><th>Value</th></tr></thead>
                <tbody>
                    @forelse($allSettings as $row)
                        <tr>
                            <td><code>{{ $row->name }}</code></td>
                            <td>{{ \Illuminate\Support\Str::limit((string) ($row->value ?? ''), 120) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="text-muted">No settings imported yet. Run <code>php artisan wiz:import-sql</code>.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
