<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\MediaOptimizer;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    private const TEXT = ['sekapur_teks', 'alamat', 'telepon', 'instagram_url', 'whatsapp_url', 'survey_url', 'cerdas_url'];

    public function edit()
    {
        return view('pageadmin.setting.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'sekapur_teks' => 'nullable|max:1000',
            'alamat' => 'nullable|max:255',
            'telepon' => 'nullable|max:50',
            'instagram_url' => 'nullable|url|max:255',
            'whatsapp_url' => 'nullable|url|max:255',
            'survey_url' => 'nullable|url|max:255',
            'cerdas_url' => 'nullable|url|max:255',
            'video_profil' => 'nullable|file|mimes:mp4,webm,mov,m4v|max:102400',
        ]);

        foreach (self::TEXT as $k) {
            Setting::put($k, $request->input($k));
        }

        if ($request->boolean('hapus_video') || $request->hasFile('video_profil')) {
            MediaOptimizer::delete('video', Setting::value('video_profil'), Setting::value('video_profil_poster'));
            Setting::put('video_profil', null);
            Setting::put('video_profil_poster', null);
        }

        if ($request->hasFile('video_profil')) {
            $v = MediaOptimizer::video($request->video_profil, 'video');
            Setting::put('video_profil', $v['file']);
            Setting::put('video_profil_poster', $v['poster']);
            if (! $v['converted']) {
                Alert::warning('Video belum dikompres', 'ffmpeg tidak tersedia di server, video disimpan apa adanya.');
                return redirect()->route('settings.edit');
            }
        }

        Alert::success('Success', 'Pengaturan disimpan.');
        return redirect()->route('settings.edit');
    }
}
