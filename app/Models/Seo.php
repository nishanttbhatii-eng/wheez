<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seo extends Model
{
    use SoftDeletes;

    protected $table = 'seos';

    protected $fillable = [
        'page_id',
        'page_type',
        'meta_title',
        'meta_keyword',
        'meta_description',
    ];

    protected $casts = [
        'page_id' => 'integer',
        'page_type' => 'integer',
    ];

    public const TYPE_CONTENT_PAGE = 0;
    public const TYPE_SUBCATEGORY = 1;
    public const TYPE_SERVICE = 2;

    public function typeLabel(): string
    {
        return match ((int) $this->page_type) {
            self::TYPE_SUBCATEGORY => 'Subcategory',
            self::TYPE_SERVICE => 'Service',
            default => 'Content Page',
        };
    }

    public function relatedTitle(): string
    {
        return match ((int) $this->page_type) {
            self::TYPE_SERVICE => Service::withTrashed()->find($this->page_id)?->name ?? ('Service #'.$this->page_id),
            self::TYPE_SUBCATEGORY => Category::withTrashed()->find($this->page_id)?->name ?? ('Category #'.$this->page_id),
            default => Page::find($this->page_id)?->title
                ?? Category::withTrashed()->find($this->page_id)?->name
                ?? ('Page #'.$this->page_id),
        };
    }
}
