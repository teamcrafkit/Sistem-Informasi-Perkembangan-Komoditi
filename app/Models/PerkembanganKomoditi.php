<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerkembanganKomoditi extends Model
{
    use HasFactory;

    protected $table   = 'tbl_perkembangan_komoditi';
    protected $guarded = [];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }
    public function kelompok()
    {
        return $this->belongsTo(KelompokTani::class, 'kelompok_tani_id');
    }
    public function jenis()
    {
        return $this->belongsTo(JenisKomoditi::class, 'jenis_komoditi_id');
    }
}
