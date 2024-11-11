<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('giats', function (Blueprint $table) {
            $table->id();
            $table->string('kegiatan', 255);
            $table->longText('detail_kegiatan');
            $table->string('tempat', 255);
            $table->string('kendaraan', 50);
            $table->string('beban_biaya', 255);
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai')->nullable();
            $table->dateTime('akses_mulai');
            $table->dateTime('akses_selesai')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giats');
    }
};
