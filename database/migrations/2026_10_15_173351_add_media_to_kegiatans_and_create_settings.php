<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->date('tanggal')->nullable()->after('deskripsi');
            $table->string('video')->nullable()->after('gambar');
            $table->string('video_poster')->nullable()->after('video');
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropColumn(['tanggal', 'video', 'video_poster']);
        });
    }
};
