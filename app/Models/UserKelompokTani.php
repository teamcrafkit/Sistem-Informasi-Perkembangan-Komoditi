<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKelompokTani extends Model
{
    use HasFactory;

    protected $table   = 'tbl_user_kelompok_tani';
    protected $guarded = [];

    public function kelompok()
    {
        return $this->belongsTo(KelompokTani::class, 'kelompok_tani_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
