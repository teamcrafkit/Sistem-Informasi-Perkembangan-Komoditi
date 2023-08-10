<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPerkembanganKomoditi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_perkembangan_komoditi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kecamatan_id')->constrained('tbl_kecamatan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('desa_id')->constrained('tbl_desa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('jenis_komoditi_id')->constrained('tbl_jenis_komoditi')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('kelompok_tani_id')->constrained('tbl_kelompok_tani')->onDelete('cascade')->onUpdate('cascade');
            $table->string('luas_lahan');
            $table->string('luas_tanam');
            $table->string('luas_panen');
            $table->string('produksi');
            $table->string('produktifitas');
            $table->date('tanggal');
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
        Schema::dropIfExists('tbl_perkembangan_komoditi');
    }
}
