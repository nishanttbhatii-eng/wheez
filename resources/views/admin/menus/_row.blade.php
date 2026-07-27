<tr>
    <td>
        <span style="padding-left: {{ $depth * 24 }}px; display: inline-block;">
            @if($depth > 0)
                <i class="fas fa-level-up-alt fa-rotate-90 text-muted me-1"></i>
            @endif
            <strong>{{ $item->title }}</strong>
        </span>
    </td>
    <td><span class="badge bg-secondary">{{ ucfirst($item->type) }}</span></td>
    <td>
        @if($item->url)
            <code class="small">{{ Str::limit($item->url, 40) }}</code>
        @else
            <span class="text-muted">—</span>
        @endif
    </td>
    <td>{{ $item->order }}</td>
    <td>
        @if($item->is_active)
            <span class="badge badge-success">Active</span>
        @else
            <span class="badge badge-warning">Hidden</span>
        @endif
    </td>
    <td>
        <div class="btn-group">
            <a href="{{ route('admin.menus.edit', $item) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
            <form action="{{ route('admin.menus.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this item and all children?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
            </form>
        </div>
    </td>
</tr>
@foreach($item->children as $child)
    @include('admin.menus._row', ['item' => $child, 'depth' => $depth + 1])
@endforeach
