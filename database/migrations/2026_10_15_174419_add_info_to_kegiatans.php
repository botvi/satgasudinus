<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->string('penyelenggara')->nullable()->after('tanggal');
            $table->string('kategori')->nullable()->after('penyelenggara');
            $table->string('tempat')->nullable()->after('kategori');
        });
    }

    public function down()
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropColumn(['penyelenggara', 'kategori', 'tempat']);
        });
    }
};
