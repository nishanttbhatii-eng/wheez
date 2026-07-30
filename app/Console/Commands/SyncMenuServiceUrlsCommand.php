<?php

namespace App\Console\Commands;

use App\Models\MenuItem;
use App\Models\Service;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SyncMenuServiceUrlsCommand extends Command
{
    protected $signature = 'menu:sync-service-urls';

    protected $description = 'Link menu items to matching service pages by title/slug';

    public function handle(): int
    {
        $services = Service::query()
            ->active()
            ->where('service_type', 1)
            ->get(['id', 'name', 'slug']);

        $byName = $services->keyBy(fn (Service $s) => Str::lower(trim($s->name)));
        $bySlug = $services->keyBy('slug');

        $updated = 0;
        $skipped = 0;

        MenuItem::query()
            ->where('type', 'link')
            ->orderBy('id')
            ->each(function (MenuItem $item) use ($byName, $bySlug, &$updated, &$skipped) {
                $title = Str::lower(trim($item->title));
                $slug = Str::slug($item->title);

                $service = $byName->get($title) ?: $bySlug->get($slug);

                if (! $service) {
                    // Soft match: remove common suffixes like "in India"
                    $normalized = preg_replace('/\s+in\s+india$/i', '', $title);
                    $service = $byName->get(trim($normalized ?? ''))
                        ?: $bySlug->get(Str::slug($normalized ?? ''));
                }

                if (! $service) {
                    $skipped++;
                    $this->warn("No service match: {$item->title}");

                    return;
                }

                $url = '/services/'.$service->slug;
                if ($item->url === $url) {
                    return;
                }

                $item->update(['url' => $url]);
                $updated++;
            });

        $this->info("Updated {$updated} menu links. Unmatched: {$skipped}.");

        return self::SUCCESS;
    }
}
