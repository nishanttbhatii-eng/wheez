<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class BasicSetting extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'value'];

    public static function getValue(string $name, ?string $default = null): ?string
    {
        $settings = Cache::remember('basic_settings_map', 300, function () {
            return static::query()->pluck('value', 'name')->all();
        });

        return $settings[$name] ?? $default;
    }

    public static function setValue(string $name, ?string $value): void
    {
        static::updateOrCreate(['name' => $name], ['value' => $value]);
        Cache::forget('basic_settings_map');
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('basic_settings_map'));
        static::deleted(fn () => Cache::forget('basic_settings_map'));
    }
}
