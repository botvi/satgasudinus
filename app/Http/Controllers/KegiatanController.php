<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\{HtmlSanitizer, MediaOptimizer};

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::all();
        return view('pageadmin.kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        return view('pageadmin.kegiatan.create');
    }

    private const RULES = [
        'title' => 'required|max:255',
        'deskripsi' => 'required',
        'tanggal' => 'nullable|date',
        'penyelenggara' => 'nullable|max:255',
        'kategori' => 'nullable|max:100',
        'tempat' => 'nullable|max:255',
        'video' => 'nullable|file|mimes:mp4,webm,mov,m4v|max:102400',
        'media' => 'nullable|array|max:20',
        'media.*' => 'file|mimes:jpeg,png,jpg,gif,webp,mp4,webm,mov,m4v|max:102400',
    ];

    public function store(Request $request)
    {
        $request->validate(self::RULES + [
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $data = $request->only('title', 'tanggal', 'penyelenggara', 'kategori', 'tempat');
        $data['deskripsi'] = HtmlSanitizer::clean($request->deskripsi);
        $data['gambar'] = MediaOptimizer::image($request->gambar, 'kegiatan');
        $this->saveVideo($request, $data);

        $kegiatan = Kegiatan::create($data);
        $this->saveMedia($request, $kegiatan);

        Alert::success('Success', 'Kegiatan created successfully.');
        return redirect()->route('kegiatans.index');
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::find($id);
        return view('pageadmin.kegiatan.show', compact('kegiatan'));
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::find($id);
        return view('pageadmin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(self::RULES + [
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $kegiatan = Kegiatan::findOrFail($id);
        $data = $request->only('title', 'tanggal', 'penyelenggara', 'kategori', 'tempat');
        $data['deskripsi'] = HtmlSanitizer::clean($request->deskripsi);

        if ($request->hasFile('gambar')) {
            MediaOptimizer::delete('kegiatan', $kegiatan->gambar);
            $data['gambar'] = MediaOptimizer::image($request->gambar, 'kegiatan');
        }

        if ($request->boolean('hapus_video') || $request->hasFile('video')) {
            MediaOptimizer::delete('kegiatan', $kegiatan->video, $kegiatan->video_poster);
            $data['video'] = $data['video_poster'] = null;
        }
        $this->saveVideo($request, $data);

        $kegiatan->update($data);

        $hapus = $kegiatan->media()->whereIn('id', (array) $request->hapus_media)->get();
        foreach ($hapus as $m) {
            MediaOptimizer::delete('kegiatan', $m->file, $m->poster);
            $m->delete();
        }
        $this->saveMedia($request, $kegiatan);

        Alert::success('Success', 'Kegiatan updated successfully.');
        return redirect()->route('kegiatans.index');
    }

    private function saveMedia(Request $request, Kegiatan $kegiatan): void
    {
        $unconverted = false;
        foreach ((array) $request->file('media') as $f) {
            if (str_starts_with($f->getMimeType(), 'video/')) {
                $v = MediaOptimizer::video($f, 'kegiatan');
                $kegiatan->media()->create(['type' => 'video', 'file' => $v['file'], 'poster' => $v['poster']]);
                $unconverted |= ! $v['converted'];
            } else {
                $kegiatan->media()->create(['type' => 'image', 'file' => MediaOptimizer::image($f, 'kegiatan')]);
            }
        }
        if ($unconverted) {
            Alert::warning('Video belum dikompres', 'ffmpeg tidak tersedia di server, video disimpan apa adanya.');
        }
    }

    private function saveVideo(Request $request, array &$data): void
    {
        if (! $request->hasFile('video')) {
            return;
        }
        $v = MediaOptimizer::video($request->video, 'kegiatan');
        $data['video'] = $v['file'];
        $data['video_poster'] = $v['poster'];
        if (! $v['converted']) {
            Alert::warning('Video belum dikompres', 'ffmpeg tidak tersedia di server, video disimpan apa adanya.');
        }
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::find($id);

        MediaOptimizer::delete('kegiatan', $kegiatan->gambar, $kegiatan->video, $kegiatan->video_poster);
        foreach ($kegiatan->media as $m) {
            MediaOptimizer::delete('kegiatan', $m->file, $m->poster);
        }

        $kegiatan->delete();

        Alert::success('Success', 'Kegiatan deleted successfully.');

        return redirect()->route('kegiatans.index');
    }
}
