<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->char('visitor', 40);          // hash harian IP+UA, IP asli tidak disimpan
            $table->string('path');
            $table->string('referrer_host', 120)->nullable();
            $table->string('device', 10);         // mobile | tablet | desktop
            $table->string('browser', 20)->nullable();
            $table->timestamp('created_at')->useCurrent()->index();
            $table->index(['path', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('visits');
    }
};
