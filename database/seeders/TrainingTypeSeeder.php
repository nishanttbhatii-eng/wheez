<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TrainingType;

class TrainingTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Health & Safety Training', 'requires_custom_text' => false],
            ['name' => 'Fire Safety Training', 'requires_custom_text' => false],
            ['name' => 'Data Protection Training', 'requires_custom_text' => false],
            ['name' => 'Custom Training', 'requires_custom_text' => true],
            ['name' => 'IT Security Training', 'requires_custom_text' => false],
        ];

        foreach ($types as $type) {
            TrainingType::firstOrCreate(
                ['name' => $type['name']],
                [
                    'requires_custom_text' => $type['requires_custom_text'],
                    'is_active' => true,
                ]
            );
        }
    }
}
