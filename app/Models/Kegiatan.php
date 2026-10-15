<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kegiatan extends Model
{
    protected $fillable = [
        'title',
        'deskripsi',
        'tanggal',
        'penyelenggara',
        'kategori',
        'tempat',
        'gambar',
        'video',
        'video_poster',
    ];

    protected $casts = ['tanggal' => 'date'];

    public function media()
    {
        return $this->hasMany(KegiatanMedia::class)->orderBy('id');
    }

    /** Isi sebagai HTML; data lama (teks biasa) dibungkus paragraf. */
    public function getIsiHtmlAttribute(): string
    {
        $d = (string) $this->deskripsi;
        if ($d !== strip_tags($d)) {
            return $d;
        }

        return '<p>' . nl2br(e($d)) . '</p>';
    }

    public function getRingkasanAttribute(): string
    {
        $t = str_replace(['</p>', '<br>', '</li>', '</h2>', '</h3>'], ' ', (string) $this->deskripsi);
        $t = html_entity_decode(strip_tags($t), ENT_QUOTES, 'UTF-8');

        return Str::limit(trim(preg_replace('/\s+/', ' ', $t)), 200);
    }

    public function getUrlAttribute(): string
    {
        return url('/satgas/kegiatan/' . $this->id . '/' . Str::slug($this->title));
    }
}
