<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $primaryKey = 'key';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['key', 'value'];

    private static ?array $cache = null;

    /** Nilai pengaturan; kosong/tidak ada → $default. */
    public static function value(string $key, ?string $default = null): ?string
    {
        self::$cache ??= self::pluck('value', 'key')->all();

        return self::$cache[$key] ?? null ?: $default;
    }

    public static function put(string $key, ?string $value): void
    {
        self::updateOrCreate(['key' => $key], ['value' => $value]);
        self::$cache = null;
    }
}
