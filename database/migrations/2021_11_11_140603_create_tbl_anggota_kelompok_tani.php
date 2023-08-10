<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAnggotaKelompokTani extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_anggota_kelompok_tani', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelompok_tani_id')->constrained('tbl_kelompok_tani')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nik');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->integer('volume');
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
        Schema::dropIfExists('tbl_anggota_kelompok_tani');
    }
}
