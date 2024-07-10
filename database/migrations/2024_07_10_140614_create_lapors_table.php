<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lapors', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nomor_identitas');
            $table->string('file_identitas')->nullable();
            $table->text('alamat');
            $table->string('no_hp');
            $table->string('email');
            $table->string('nama_unit_kerja_fakultas_instansi');
            $table->string('status_pelapor');
            $table->string('kategori');
            $table->string('nama_lengkap_terlapor');
            $table->string('status_terlapor');
            $table->string('no_hp_terlapor');
            $table->text('peristiwa');
            $table->date('tanggal_peristiwa');
            $table->string('lokasi_peristiwa');
            $table->text('kronologi_peristiwa');
            $table->string('file_bukti_tindakan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lapors');
    }
};
