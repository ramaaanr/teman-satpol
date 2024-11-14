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
        Schema::create('detail_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penugasan');
            $table->foreign('id_penugasan')->references('id')->on('penugasans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_items');
    }
};
