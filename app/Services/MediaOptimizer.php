<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

class MediaOptimizer
{
    /** Simpan gambar sebagai WebP (maks lebar config). GIF disimpan apa adanya. Return nama file. */
    public static function image(UploadedFile $f, string $dir): string
    {
        $abs = public_path($dir);
        File::ensureDirectoryExists($abs);
        $name = uniqid() . '_' . time();

        if (strtolower($f->getClientOriginalExtension()) === 'gif' || ! function_exists('imagewebp')) {
            $name .= '.' . $f->extension();
            $f->move($abs, $name);
            return $name;
        }

        $im = @imagecreatefromstring(file_get_contents($f->getRealPath()));
        if (! $im) {
            abort(422, 'File gambar tidak dapat dibaca.');
        }

        if (function_exists('exif_read_data') && in_array($f->extension(), ['jpg', 'jpeg'])) {
            $o = @exif_read_data($f->getRealPath())['Orientation'] ?? 1;
            $angle = [3 => 180, 6 => -90, 8 => 90][$o] ?? 0;
            if ($angle) {
                $im = imagerotate($im, $angle, 0);
            }
        }

        imagepalettetotruecolor($im);
        imagealphablending($im, false);
        imagesavealpha($im, true);

        $max = config('media.image_max_width');
        if (imagesx($im) > $max) {
            $im = imagescale($im, $max);
        }

        $name .= '.webp';
        imagewebp($im, $abs . '/' . $name, 80);
        imagedestroy($im);

        return $name;
    }

    /**
     * Konversi video ke WebM + poster WebP bila ffmpeg ada.
     * Return ['file' => nama, 'poster' => nama|null, 'converted' => bool].
     * shortcut: sinkron di dalam request, pindah ke queue bila video sering > ±50 MB.
     */
    public static function video(UploadedFile $f, string $dir): array
    {
        $abs = public_path($dir);
        File::ensureDirectoryExists($abs);
        $base = uniqid() . '_' . time();
        $srcName = $base . '_src.' . $f->extension();
        $f->move($abs, $srcName);
        $src = $abs . '/' . $srcName;

        if (! self::hasFfmpeg()) {
            rename($src, $abs . '/' . ($final = $base . '.' . pathinfo($srcName, PATHINFO_EXTENSION)));
            return ['file' => $final, 'poster' => null, 'converted' => false];
        }

        set_time_limit(0);
        $ff = config('media.ffmpeg');
        $h = config('media.video_max_height');
        $out = $base . '.webm';

        $conv = new Process([$ff, '-y', '-i', $src, '-c:v', 'libvpx-vp9', '-crf', '34', '-b:v', '0',
            '-deadline', 'good', '-cpu-used', '4', '-vf', "scale=-2:'min($h,ih)'",
            '-c:a', 'libopus', '-b:a', '96k', $abs . '/' . $out]);
        $conv->setTimeout(1800)->run();

        if (! $conv->isSuccessful() || ! is_file($abs . '/' . $out)) {
            @unlink($abs . '/' . $out);
            rename($src, $abs . '/' . ($final = $base . '.' . pathinfo($srcName, PATHINFO_EXTENSION)));
            return ['file' => $final, 'poster' => null, 'converted' => false];
        }

        $poster = self::poster($ff, $abs . '/' . $out, $abs, $base);
        @unlink($src);

        return ['file' => $out, 'poster' => $poster, 'converted' => true];
    }

    public static function hasFfmpeg(): bool
    {
        $bin = config('media.ffmpeg');
        if (! $bin) {
            return false;
        }
        try {
            return (new Process([$bin, '-version']))->setTimeout(10)->run() === 0;
        } catch (\Throwable $e) {
            return false;
        }
    }

    public static function delete(string $dir, ?string ...$names): void
    {
        foreach ($names as $n) {
            if ($n) {
                File::delete(public_path($dir . '/' . $n));
            }
        }
    }

    private static function poster(string $ff, string $video, string $abs, string $base): ?string
    {
        $png = $abs . '/' . $base . '_poster.png';
        $p = new Process([$ff, '-y', '-ss', '1', '-i', $video, '-frames:v', '1', $png]);
        $p->setTimeout(60)->run();
        if (! is_file($png)) {
            // video lebih pendek dari 1 detik
            (new Process([$ff, '-y', '-i', $video, '-frames:v', '1', $png]))->setTimeout(60)->run();
        }
        if (! is_file($png) || ! function_exists('imagewebp')) {
            @unlink($png);
            return null;
        }
        $im = imagecreatefrompng($png);
        $name = $base . '_poster.webp';
        imagewebp($im, $abs . '/' . $name, 80);
        imagedestroy($im);
        unlink($png);

        return $name;
    }
}
