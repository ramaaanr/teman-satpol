<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('deskripsi', 255);
        });

        DB::table('items')->insert([
            ['deskripsi' => 'Melaksanakan tindakan yustisi'],
            ['deskripsi' => 'Menjadi saksi dalam proses penyidikan'],
            ['deskripsi' => 'Menjadi saksi dalam proses persidangan'],
            ['deskripsi' => 'Melakukan tindakan non yustisi'],
            ['deskripsi' => 'Melakukan analisis aspek sanksi dalam Perda'],
            ['deskripsi' => 'Melakukan evaluasi permasalahan penegakan perda'],
            ['deskripsi' => 'Melakukan koordinasi penegakan perda'],
            ['deskripsi' => 'Mengikuti sosialisasi Perda/Peraturan Kepala Daerah'],
            ['deskripsi' => 'Mengikuti penyusunan Perda/Perkada'],
            ['deskripsi' => 'Menyusun rencana program'],
            ['deskripsi' => 'Melakukan evaluasi kegiatan'],
            ['deskripsi' => 'Melakukan patroli'],
            ['deskripsi' => 'Melakukan pengamanan'],
            ['deskripsi' => 'Melakukan pengawalan'],
            ['deskripsi' => 'Melakukan pengendalian massa'],
            ['deskripsi' => 'Melaksanakan deteksi dini'],
            ['deskripsi' => 'Melakukan pendataan dan pelatihan satlinmas'],
            ['deskripsi' => 'Melakukan mobilisasi linmas'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
