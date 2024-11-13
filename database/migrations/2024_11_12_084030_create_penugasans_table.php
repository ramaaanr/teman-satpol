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
        Schema::create('penugasans', function (Blueprint $table) {
            $table->id();
            $table->time('durasi');
            $table->longText('detail');
            $table->string('dokumen_lapangan', 255);
            $table->string('status', 50);
            $table->unsignedBigInteger('id_giat');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_giat')->references('id')->on('giats')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penugasans');
    }
};
