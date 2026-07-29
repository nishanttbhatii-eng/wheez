<?php

namespace App\Console\Commands;

use App\Models\Media;
use App\Models\Page;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImportExistingMediaCommand extends Command
{
    protected $signature = 'media:import-existing';

    protected $description = 'Import existing project images into the media library and restore page featured images';

    public function handle(): int
    {
        $this->restorePageFeaturedImages();
        $imported = $this->importImageFiles();

        $this->info("Imported {$imported} images into media library.");
        $this->info('Media total: '.Media::count());

        return self::SUCCESS;
    }

    private function restorePageFeaturedImages(): void
    {
        $pageDir = storage_path('app/public/page');
        File::ensureDirectoryExists($pageDir);

        // About Us from S3 download (local cache).
        if (is_file('/tmp/about_s3.jpg')) {
            $name = '6atF5SwQrCEHd4aEbSnYNqD9neBeZC9AOrATwwOn.jpg';
            File::copy('/tmp/about_s3.jpg', $pageDir.'/'.$name);
            $this->updatePageImage(25, 'page/'.$name);
        } elseif (is_file($pageDir.'/6332d22e622eaabout-us.png')) {
            $this->updatePageImage(25, 'page/6332d22e622eaabout-us.png');
        }

        $map = [
            17 => public_path('frontend/assets/images1/bannerImg.png'),
            26 => public_path('frontend/assets/images1/contact-us-image.png'),
            27 => public_path('frontend/assets/images1/blog-2.png'),
            28 => public_path('frontend/assets/images1/refund-policy-image.png'),
            29 => public_path('frontend/assets/images1/privacy-policy-img.png'),
            30 => public_path('frontend/assets/images1/Privacy-Policy-bn.png'),
        ];

        foreach ($map as $pageId => $source) {
            if (! is_file($source)) {
                $this->warn("Missing source for page #{$pageId}: {$source}");
                continue;
            }

            $ext = strtolower(pathinfo($source, PATHINFO_EXTENSION) ?: 'png');
            $name = 'page-'.$pageId.'-featured.'.$ext;
            File::copy($source, $pageDir.'/'.$name);
            $this->updatePageImage($pageId, 'page/'.$name);
            $this->line("Restored featured image for page #{$pageId}");
        }

        $this->info('Page featured images restored.');
    }

    private function updatePageImage(int $pageId, string $relativePath): void
    {
        Page::where('id', $pageId)->update([
            'featured_image' => $relativePath,
            'image' => '/storage/'.$relativePath,
        ]);
    }

    private function importImageFiles(): int
    {
        $roots = [
            storage_path('app/public'),
            public_path('frontend'),
            public_path('Image'),
            public_path('uploads'),
            public_path('admin/img'),
        ];

        $extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
        $imported = 0;
        $storagePublic = storage_path('app/public');

        foreach ($roots as $root) {
            if (! is_dir($root)) {
                continue;
            }

            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($root, \FilesystemIterator::SKIP_DOTS)
            );

            foreach ($iterator as $file) {
                if (! $file->isFile()) {
                    continue;
                }

                $ext = strtolower($file->getExtension());
                if (! in_array($ext, $extensions, true)) {
                    continue;
                }

                $absolute = $file->getPathname();
                if (str_contains($absolute, '/node_modules/') || str_contains($absolute, '/vendor/')) {
                    continue;
                }

                if (str_starts_with($absolute, $storagePublic.DIRECTORY_SEPARATOR)) {
                    $path = str_replace('\\', '/', ltrim(substr($absolute, strlen($storagePublic)), DIRECTORY_SEPARATOR));
                } else {
                    $hash = substr(sha1($absolute), 0, 12);
                    $safeName = Str::slug(pathinfo($absolute, PATHINFO_FILENAME)) ?: 'image';
                    $subdir = 'media/imported/'.date('Y/m', $file->getMTime() ?: time());
                    File::ensureDirectoryExists(storage_path('app/public/'.$subdir));
                    $path = $subdir.'/'.$safeName.'-'.$hash.'.'.$ext;
                    $dest = storage_path('app/public/'.$path);
                    if (! is_file($dest)) {
                        File::copy($absolute, $dest);
                    }
                }

                if (Media::where('path', $path)->exists()) {
                    continue;
                }

                $absoluteStored = storage_path('app/public/'.$path);
                if (! is_file($absoluteStored)) {
                    continue;
                }

                $mime = @mime_content_type($absoluteStored) ?: null;
                $size = filesize($absoluteStored) ?: 0;
                $dimensions = @getimagesize($absoluteStored) ?: [null, null];
                $fileName = basename($absoluteStored);

                Media::create([
                    'title' => pathinfo($fileName, PATHINFO_FILENAME),
                    'alt_text' => pathinfo($fileName, PATHINFO_FILENAME),
                    'file_name' => $fileName,
                    'path' => $path,
                    'disk' => 'public',
                    'mime_type' => $mime,
                    'size' => $size,
                    'width' => $dimensions[0] ?? null,
                    'height' => $dimensions[1] ?? null,
                    'user_id' => 1,
                ]);

                $imported++;
            }
        }

        return $imported;
    }
}
