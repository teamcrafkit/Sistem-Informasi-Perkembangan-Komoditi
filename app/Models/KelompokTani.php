<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class KelompokTani extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, HasRoles, Notifiable;

    protected $table   = 'tbl_kelompok_tani';
    protected $guarded = [];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }
    public function anggotakelompok()
    {
        return $this->hasMany(Anggota::class, 'kelompok_tani_id');
    }
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
