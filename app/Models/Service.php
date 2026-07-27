<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'subcategory_id',
        'name',
        'slug',
        'price',
        'mrp_price',
        'service_type',
        'small_description',
        'description',
        'free_consultation_desc',
        'short_description',
        'talk_to_expert_description',
        'caller_name',
        'caller_description',
        'testmonial_description',
        'long_description',
        'too_long_description',
        'advisory_services',
        'get_started',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'status',
    ];

    protected $casts = [
        'price' => 'float',
        'mrp_price' => 'float',
        'status' => 'integer',
        'service_type' => 'integer',
        'category_id' => 'integer',
        'subcategory_id' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function heroDescription(): string
    {
        foreach (['small_description', 'short_description', 'meta_description'] as $field) {
            $value = $this->{$field};
            if (! empty($value)) {
                $text = trim(html_entity_decode(strip_tags($value)));
                if ($text !== '') {
                    return $text;
                }
            }
        }

        return 'Get expert assistance for ' . $this->name . ' with Whizseed. We handle documentation, compliance, and filing so you can focus on your business.';
    }

    public function processSteps(): array
    {
        $steps = [];

        if (! empty($this->description) && preg_match_all(
            '/<img[^>]+src=["\']([^"\']+)["\'][^>]*>.*?<p[^>]*>(.*?)<\/p>/is',
            $this->description,
            $matches,
            PREG_SET_ORDER
        )) {
            foreach ($matches as $match) {
                $steps[] = [
                    'icon' => $match[1],
                    'text' => trim(html_entity_decode(strip_tags($match[2]))),
                ];
            }
        }

        if (count($steps) >= 3) {
            return array_slice($steps, 0, 3);
        }

        return [
            [
                'icon' => 'https://www.whizseed.com/frontend/assets/images1/step1.svg',
                'text' => 'Get in touch with our experts',
            ],
            [
                'icon' => 'https://www.whizseed.com/frontend/assets/images1/step2.svg',
                'text' => 'Provide all the details and we will prepare all your documents',
            ],
            [
                'icon' => 'https://www.whizseed.com/frontend/assets/images1/step3.svg',
                'text' => 'Finally submit your application and get your ' . $this->name,
            ],
        ];
    }

    public function processLabel(): string
    {
        $name = trim($this->name);
        $short = strtok($name, ' ') ?: $name;

        return $short . ' Process';
    }
}
