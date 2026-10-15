@extends('template-admin.layout')

@section('content')
@php $max = max(1, $topPages->max('total') ?? 1); $devMax = max(1, $devices->sum()); @endphp
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="pg-head">
        <div>
            <h1>Dashboard</h1>
            <p>Ringkasan pengunjung situs dan konten Satgas PPK UDINUS.</p>
        </div>
        <form method="GET" class="d-flex align-items-center gap-2">
            <label for="hari" class="mb-0 text-muted">Periode</label>
            <select id="hari" name="hari" class="form-select" onchange="this.form.submit()" style="width:auto">
                @foreach ([7 => '7 hari', 30 => '30 hari', 90 => '90 hari'] as $v => $l)
                <option value="{{ $v }}" @selected($hari === $v)>{{ $l }} terakhir</option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="stats">
        <div class="card stat"><h2>Pengunjung hari ini</h2><div class="stat__total">{{ number_format($visitorsToday) }}<small>pengunjung unik</small></div></div>
        <div class="card stat"><h2>Pengunjung {{ $hari }} hari</h2><div class="stat__total">{{ number_format($visitorsRange) }}<small>unik per hari, dijumlahkan</small></div></div>
        <div class="card stat"><h2>Halaman dilihat</h2><div class="stat__total">{{ number_format($viewsRange) }}<small>tayangan {{ $hari }} hari</small></div></div>
        <div class="card stat"><h2>Laporan masuk</h2><div class="stat__total">{{ number_format($laporRange) }}<small>dalam {{ $hari }} hari · total {{ number_format($laporTotal) }}</small></div></div>
    </div>

    @unless ($tracking)
    <div class="alert alert-info">Belum ada data kunjungan. Statistik mulai terisi sejak halaman publik dibuka setelah fitur ini aktif (tanpa cookie, IP tidak disimpan, bot diabaikan).</div>
    @endunless

    <div class="card mb-4">
        <h5 class="card-header">Kunjungan per hari</h5>
        <div class="card-body"><div id="chart-visits"></div></div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-7">
            <div class="card h-100">
                <h5 class="card-header">Halaman terpopuler</h5>
                <div class="card-body">
                    <div class="stat"><ul>
                        @forelse ($topPages as $p)
                        <li><span>{{ $p['label'] }}</span><b>{{ number_format($p['total']) }}</b><span class="bar"><i style="width:{{ round($p['total'] / $max * 100) }}%"></i></span></li>
                        @empty
                        <li class="text-muted">Belum ada data.</li>
                        @endforelse
                    </ul></div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card h-100">
                <h5 class="card-header">Sumber pengunjung</h5>
                <div class="card-body">
                    <div class="stat"><ul>
                        @forelse ($referrers as $r)
                        <li><span>{{ $r->r }}</span><b>{{ number_format($r->total) }}</b></li>
                        @empty
                        <li class="text-muted">Belum ada data.</li>
                        @endforelse
                    </ul></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-4">
            <div class="card h-100">
                <h5 class="card-header">Perangkat</h5>
                <div class="card-body">
                    <div class="stat"><ul>
                        @foreach (['mobile' => 'Ponsel', 'desktop' => 'Komputer', 'tablet' => 'Tablet'] as $k => $l)
                        <li><span>{{ $l }}</span><b>{{ round(($devices[$k] ?? 0) / $devMax * 100) }}%</b><span class="bar"><i style="width:{{ round(($devices[$k] ?? 0) / $devMax * 100) }}%"></i></span></li>
                        @endforeach
                    </ul></div>
                    <hr>
                    <div class="stat"><ul>
                        @foreach ($browsers as $b)
                        <li><span>{{ $b->browser }}</span><b>{{ number_format($b->total) }}</b></li>
                        @endforeach
                    </ul></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <h5 class="card-header">Laporan per bulan</h5>
                <div class="card-body"><div id="chart-lapor"></div></div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <h5 class="card-header">Konten</h5>
                <div class="card-body">
                    <div class="stat"><ul>
                        @foreach ($counts as $l => $n)
                        <li><span>{{ $l }}</span><b>{{ $n }}</b></li>
                        @endforeach
                    </ul></div>
                    <div class="act mt-4">
                        <a class="btn btn-sm btn-primary" href="/kegiatans/create">+ Kegiatan</a>
                        <a class="btn btn-sm btn-info" href="/dokumens/create">+ Dokumen</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
window.addEventListener('DOMContentLoaded', function () {
  if (!window.ApexCharts) return;
  var C = @json($chart), L = @json($laporBulan);
  new ApexCharts(document.querySelector('#chart-visits'), {
    chart: { type: 'area', height: 300, toolbar: { show: false }, fontFamily: 'Hanken Grotesk, sans-serif' },
    series: [{ name: 'Pengunjung unik', data: C.uniq }, { name: 'Halaman dilihat', data: C.views }],
    xaxis: { categories: C.labels, tickAmount: Math.min(C.labels.length, 10), labels: { rotate: 0 } },
    yaxis: { min: 0, forceNiceScale: true, labels: { formatter: function (v) { return Math.round(v); } } },
    colors: ['#1E3A8A', '#3B63D9'], stroke: { curve: 'smooth', width: 3 },
    fill: { type: 'gradient', gradient: { opacityFrom: .3, opacityTo: .02 } },
    dataLabels: { enabled: false }, legend: { position: 'top', horizontalAlign: 'right' }
  }).render();
  new ApexCharts(document.querySelector('#chart-lapor'), {
    chart: { type: 'bar', height: 260, toolbar: { show: false }, fontFamily: 'Hanken Grotesk, sans-serif' },
    series: [{ name: 'Laporan', data: L.data }], xaxis: { categories: L.labels },
    yaxis: { min: 0, forceNiceScale: true, labels: { formatter: function (v) { return Math.round(v); } } },
    colors: ['#DC2626'], plotOptions: { bar: { borderRadius: 6, columnWidth: '55%' } }, dataLabels: { enabled: false }
  }).render();
});
</script>
@endsection
