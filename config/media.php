<?php

return [
    // Path/nama binary ffmpeg; kosongkan di .env bila server tidak punya ffmpeg.
    'ffmpeg' => env('FFMPEG_BIN', 'ffmpeg'),
    'image_max_width' => 1600,
    'video_max_height' => 720,
    'video_max_mb' => 100,
];
