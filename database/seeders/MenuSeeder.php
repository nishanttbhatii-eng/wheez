<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        MenuItem::query()->delete();

        $config = config('whizseed_menu');

        foreach ($config['primary'] ?? [] as $order => $item) {
            $this->seedItem($item, null, 'primary', $order);
        }

        foreach ($config['secondary'] ?? [] as $order => $item) {
            $this->seedItem($item, null, 'secondary', $order);
        }
    }

    private function seedItem(array $item, ?int $parentId, string $location, int $order): void
    {
        $type = $item['type'] ?? 'link';
        $url = $item['url'] ?? null;

        if ($type === 'link' && (empty($url) || $url === '#')) {
            $url = $this->resolveServiceUrl($item['title'] ?? '');
        }

        $menuItem = MenuItem::create([
            'parent_id' => $parentId,
            'title' => $item['title'],
            'url' => $url,
            'location' => $location,
            'type' => $type,
            'order' => $order,
            'is_active' => true,
            'open_in_new_tab' => $item['open_in_new_tab'] ?? false,
        ]);

        foreach ($item['children'] ?? [] as $childOrder => $child) {
            $this->seedItem($child, $menuItem->id, $location, $childOrder);
        }
    }

    private function resolveServiceUrl(string $title): ?string
    {
        static $byName = null;
        static $bySlug = null;

        if ($byName === null) {
            $services = \App\Models\Service::query()
                ->active()
                ->where('service_type', 1)
                ->get(['name', 'slug']);

            $byName = $services->keyBy(fn ($s) => \Illuminate\Support\Str::lower(trim($s->name)));
            $bySlug = $services->keyBy('slug');
        }

        $key = \Illuminate\Support\Str::lower(trim($title));
        $slug = \Illuminate\Support\Str::slug($title);
        $service = $byName->get($key) ?: $bySlug->get($slug);

        return $service ? '/services/'.$service->slug : '#';
    }
}
