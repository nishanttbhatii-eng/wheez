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
        $menuItem = MenuItem::create([
            'parent_id' => $parentId,
            'title' => $item['title'],
            'url' => $item['url'] ?? null,
            'location' => $location,
            'type' => $item['type'] ?? 'link',
            'order' => $order,
            'is_active' => true,
            'open_in_new_tab' => $item['open_in_new_tab'] ?? false,
        ]);

        foreach ($item['children'] ?? [] as $childOrder => $child) {
            $this->seedItem($child, $menuItem->id, $location, $childOrder);
        }
    }
}
