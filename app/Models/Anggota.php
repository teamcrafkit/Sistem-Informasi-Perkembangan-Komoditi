<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table   = 'tbl_anggota_kelompok_tani';
    protected $guarded = [];

    public function kelompok()
    {
        return $this->belongsTo(KelompokTani::class, 'kelompok_tani_id');
    }
}
