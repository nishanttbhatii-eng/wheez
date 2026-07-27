<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (! auth()->user()?->isAdmin()) {
                abort(403, 'You are not authorized to access this area.');
            }

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $query = Media::latest('id');

        if ($search = trim((string) $request->get('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('file_name', 'like', "%{$search}%")
                    ->orWhere('alt_text', 'like', "%{$search}%");
            });
        }

        $media = $query->paginate(24)->withQueryString();

        return view('admin.media.index', compact('media'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'files' => 'required|array|min:1',
            'files.*' => 'required|image|mimes:jpeg,jpg,png,gif,webp|max:5120',
            'title' => 'nullable|string|max:255',
            'alt_text' => 'nullable|string|max:255',
        ]);

        $count = 0;
        foreach ($request->file('files', []) as $file) {
            if ($file instanceof UploadedFile && $file->isValid()) {
                $this->storeUploadedFile(
                    $file,
                    $request->input('title'),
                    $request->input('alt_text')
                );
                $count++;
            }
        }

        $message = $count === 1
            ? 'Image uploaded successfully.'
            : "{$count} images uploaded successfully.";

        return redirect()->route('admin.media.index')->with('success', $message);
    }

    public function edit(Media $media)
    {
        return view('admin.media.edit', compact('media'));
    }

    public function update(Request $request, Media $media)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'alt_text' => 'nullable|string|max:255',
            'file' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120',
        ]);

        $media->title = $validated['title'] ?: ($media->title ?: $media->file_name);
        $media->alt_text = $validated['alt_text'] ?? null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $media->deleteFile();

            $path = $file->store('media/' . now()->format('Y/m'), 'public');
            $dimensions = @getimagesize($file->getRealPath()) ?: [null, null];

            $media->file_name = $file->getClientOriginalName();
            $media->path = $path;
            $media->disk = 'public';
            $media->mime_type = $file->getMimeType();
            $media->size = $file->getSize() ?: 0;
            $media->width = $dimensions[0] ?? null;
            $media->height = $dimensions[1] ?? null;
        }

        $media->save();

        return redirect()->route('admin.media.index')->with('success', 'Media updated successfully.');
    }

    public function destroy(Media $media)
    {
        $media->deleteFile();
        $media->delete();

        return redirect()->route('admin.media.index')->with('success', 'Media deleted successfully.');
    }

    private function storeUploadedFile(UploadedFile $file, ?string $title, ?string $altText): Media
    {
        $path = $file->store('media/' . now()->format('Y/m'), 'public');
        $dimensions = @getimagesize($file->getRealPath()) ?: [null, null];
        $originalName = $file->getClientOriginalName();

        return Media::create([
            'title' => $title ?: pathinfo($originalName, PATHINFO_FILENAME),
            'alt_text' => $altText,
            'file_name' => $originalName,
            'path' => $path,
            'disk' => 'public',
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize() ?: 0,
            'width' => $dimensions[0] ?? null,
            'height' => $dimensions[1] ?? null,
            'user_id' => auth()->id(),
        ]);
    }
}
