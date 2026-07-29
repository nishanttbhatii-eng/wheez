<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            if (! Schema::hasColumn('pages', 'content')) {
                $table->longText('content')->nullable()->after('slug');
            }
            if (! Schema::hasColumn('pages', 'featured_image')) {
                $table->string('featured_image')->nullable()->after('content');
            }
            if (! Schema::hasColumn('pages', 'seo_title')) {
                $table->string('seo_title')->nullable()->after('featured_image');
            }
            if (! Schema::hasColumn('pages', 'seo_description')) {
                $table->text('seo_description')->nullable()->after('seo_title');
            }
            if (! Schema::hasColumn('pages', 'author_id')) {
                $table->unsignedBigInteger('author_id')->nullable()->after('seo_description');
            }
            if (! Schema::hasColumn('pages', 'order')) {
                $table->integer('order')->default(0)->after('status');
            }
        });

        // Ensure status can store string values used by admin UI.
        DB::statement("ALTER TABLE `pages` MODIFY `status` VARCHAR(20) NOT NULL DEFAULT 'draft'");

        // Backfill from imported wiz dump columns.
        DB::table('pages')->orderBy('id')->chunkById(100, function ($pages) {
            foreach ($pages as $page) {
                $featured = $page->featured_image;
                if (! $featured && ! empty($page->image)) {
                    $image = $page->image;
                    if (str_starts_with($image, '/storage/')) {
                        $featured = ltrim(substr($image, strlen('/storage/')), '/');
                    } elseif (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
                        $featured = $image;
                    } else {
                        $featured = ltrim($image, '/');
                    }
                }

                $status = $page->status;
                if ($status === 1 || $status === '1') {
                    $status = 'published';
                } elseif ($status === 0 || $status === '0') {
                    $status = 'draft';
                } elseif (! in_array($status, ['draft', 'published', 'archived'], true)) {
                    $status = 'draft';
                }

                DB::table('pages')->where('id', $page->id)->update([
                    'content' => $page->content ?: ($page->description ?? null),
                    'featured_image' => $featured,
                    'seo_title' => $page->seo_title ?: ($page->meta_title ?? null),
                    'seo_description' => $page->seo_description ?: ($page->meta_description ?? null),
                    'order' => $page->order ?? 0,
                    'status' => $status,
                ]);
            }
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            foreach (['author_id', 'seo_description', 'seo_title', 'featured_image', 'content', 'order'] as $column) {
                if (Schema::hasColumn('pages', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
