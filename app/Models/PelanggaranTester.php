<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PelanggaranTester extends Model
{
    protected $table = 'pelanggaran_tester';

    protected $fillable = [
        'id_user',
        'id_developer',
        'id_misi',
        'alasan',
        'status', // pending, disetujui, ditolak
        'tindakan_admin',
    ];

    public function tester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function developer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_developer');
    }

    public function misi(): BelongsTo
    {
        return $this->belongsTo(Misi::class, 'id_misi');
    }
}
