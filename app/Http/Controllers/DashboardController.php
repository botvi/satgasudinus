<?php

namespace App\Http\Controllers;

use App\Models\{Dokumen, Galeri, Kegiatan, Lapor, Visit};
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    private const PAGES = [
        '/' => 'Beranda', '/satgas/kegiatan' => 'Kegiatan', '/satgas/galeri' => 'Galeri', '/satgas/lapor' => 'Lapor',
        '/satgas/dokumen' => 'Dokumen', '/satgas/pengantar' => 'Pengantar', '/satgas/filosofi' => 'Filosofi',
        '/satgas/lainnya' => 'Lainnya', '/satgas/faq' => 'FAQ',
    ];

    public function dashboard(Request $request)
    {
        $hari = in_array((int) $request->hari, [7, 30, 90], true) ? (int) $request->hari : 30;
        $from = now()->subDays($hari - 1)->startOfDay();

        $range = Visit::where('created_at', '>=', $from);

        // Per hari; unik = pengunjung berbeda dalam satu hari (hash harian).
        $daily = (clone $range)->selectRaw('DATE(created_at) d, COUNT(*) views, COUNT(DISTINCT visitor) uniq')
            ->groupBy('d')->get()->keyBy('d');
        $labels = $views = $uniq = [];
        for ($i = 0; $i < $hari; $i++) {
            $d = $from->copy()->addDays($i);
            $row = $daily[$d->toDateString()] ?? null;
            $labels[] = $d->locale('id')->translatedFormat('j M');
            $views[] = (int) ($row->views ?? 0);
            $uniq[] = (int) ($row->uniq ?? 0);
        }

        $kegiatanTitles = Kegiatan::pluck('title', 'id');
        $topPages = (clone $range)->selectRaw('path, COUNT(*) total')->groupBy('path')->orderByDesc('total')->limit(8)->get()
            ->map(function ($r) use ($kegiatanTitles) {
                $label = self::PAGES[$r->path] ?? null;
                if (! $label && preg_match('~^/satgas/kegiatan/(\d+)~', $r->path, $m)) {
                    $label = 'Kegiatan: ' . ($kegiatanTitles[$m[1]] ?? '#' . $m[1]);
                }

                return ['label' => $label ?? $r->path, 'total' => $r->total];
            });

        $bulan = collect(range(5, 0))->map(fn ($i) => now()->subMonths($i)->startOfMonth());
        $laporPerBulan = $bulan->map(fn (Carbon $m) => Lapor::whereBetween('created_at', [$m, $m->copy()->endOfMonth()])->count());

        return view('pageadmin.dashboard.dashboard', [
            'hari' => $hari,
            'chart' => compact('labels', 'views', 'uniq'),
            'visitorsToday' => Visit::where('created_at', '>=', today())->distinct('visitor')->count('visitor'),
            'visitorsRange' => array_sum($uniq),
            'viewsRange' => array_sum($views),
            'topPages' => $topPages,
            'referrers' => (clone $range)->selectRaw("COALESCE(referrer_host, 'Langsung') r, COUNT(*) total")->groupBy('r')->orderByDesc('total')->limit(6)->get(),
            'devices' => (clone $range)->selectRaw('device, COUNT(*) total')->groupBy('device')->pluck('total', 'device'),
            'browsers' => (clone $range)->selectRaw('browser, COUNT(*) total')->groupBy('browser')->orderByDesc('total')->limit(5)->get(),
            'counts' => ['Kegiatan' => Kegiatan::count(), 'Dokumen' => Dokumen::count(), 'Galeri' => Galeri::count()],
            'laporTotal' => Lapor::count(),
            'laporRange' => Lapor::where('created_at', '>=', $from)->count(),
            'laporBulan' => ['labels' => $bulan->map(fn ($m) => $m->locale('id')->translatedFormat('M Y')), 'data' => $laporPerBulan],
            'tracking' => Visit::exists(),
        ]);
    }
}
