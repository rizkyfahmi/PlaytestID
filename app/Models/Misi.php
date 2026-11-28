<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Misi extends Model
{
    protected $table = 'misi';

    protected $fillable = [
        'id_user',
        'id_paket',
        'nama_aplikasi',
        'penyelenggara',
        'lokasi',
        'jadwal_tanggal',
        'jadwal_waktu',
        'kuota_tester',
        'komisi_per_tester',
        'biaya_admin',
        'total_biaya',
        'persyaratan',
        'logo',
        'link_aplikasi',
        'instruksi',
        'status',
        'point',
        'kapasitas',
    ];

    protected $casts = [
        'jadwal_tanggal' => 'date',
        'kuota_tester' => 'integer',
        'komisi_per_tester' => 'integer',
        'biaya_admin' => 'integer',
        'total_biaya' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function paket(): BelongsTo
    {
        return $this->belongsTo(Paket::class, 'id_paket');
    }

    public function misiSubs(): HasMany
    {
        return $this->hasMany(MisiSub::class, 'id_misi');
    }

    public function misiAnggotas(): HasMany
    {
        return $this->hasMany(MisiAnggota::class, 'id_misi');
    }

    public function pembayarans(): HasMany
    {
        return $this->hasMany(Pembayaran::class, 'id_misi');
    }
}
