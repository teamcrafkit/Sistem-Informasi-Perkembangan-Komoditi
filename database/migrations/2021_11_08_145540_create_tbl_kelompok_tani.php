<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblKelompokTani extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kelompok_tani', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kecamatan_id')->constrained('tbl_kecamatan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('desa_id')->constrained('tbl_desa')->onDelete('cascade')->onUpdate('cascade');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('nama_kelompok');
            $table->string('ketua_kelompok');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('tbl_kelompok_tani');
    }
}
