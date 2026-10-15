<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;

/** Catat kunjungan halaman publik tanpa cookie dan tanpa menyimpan IP. */
class TrackVisit
{
    private const BOT = '/bot|crawl|spider|slurp|preview|curl|wget|python|headless|monitor|lighthouse|facebookexternalhit|whatsapp/i';

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        try {
            $ua = (string) $request->userAgent();
            if ($request->isMethod('GET') && $response->getStatusCode() === 200 && ! $request->ajax()
                && $ua !== '' && ! preg_match(self::BOT, $ua) && ! auth()->check()
                && ! in_array($request->header('Purpose'), ['prefetch', 'preview'], true)) {
                $ref = parse_url((string) $request->headers->get('referer'), PHP_URL_HOST);

                Visit::create([
                    'visitor' => sha1($request->ip() . $ua . date('Y-m-d') . config('app.key')),
                    'path' => '/' . ltrim($request->path(), '/'),
                    'referrer_host' => $ref && $ref !== $request->getHost() ? substr($ref, 0, 120) : null,
                    'device' => preg_match('/ipad|tablet/i', $ua) ? 'tablet' : (preg_match('/mobi|android|iphone/i', $ua) ? 'mobile' : 'desktop'),
                    'browser' => $this->browser($ua),
                ]);
            }
        } catch (\Throwable $e) {
            report($e); // statistik tidak boleh merusak halaman
        }

        return $response;
    }

    private function browser(string $ua): string
    {
        foreach (['Edg' => 'Edge', 'OPR' => 'Opera', 'Firefox' => 'Firefox', 'Chrome' => 'Chrome', 'Safari' => 'Safari'] as $k => $v) {
            if (stripos($ua, $k) !== false) {
                return $v;
            }
        }

        return 'Lainnya';
    }
}
