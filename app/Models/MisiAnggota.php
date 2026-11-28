<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MisiAnggota extends Model
{
    protected $table = 'misi_anggota';

    protected $fillable = [
        'id_misi',
        'id_user',
        'phone_number',
        'payout_method',
        'payout_bank_name',
        'payout_account_name',
        'payout_account_number',
        'status', // menunggu_seleksi (or pending), accepted, rejected, cancelled, selesai
        'status_kehadiran', // belum_hadir, hadir, tidak_hadir
        'status_komisi', // belum_dibayar, masuk_dompet
        'catatan_seleksi',
        'agreed_terms_at',
    ];

    protected $casts = [
        'agreed_terms_at' => 'datetime',
    ];

    public function misi(): BelongsTo
    {
        return $this->belongsTo(Misi::class, 'id_misi');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function userBalance(): \Illuminate\Database\Eloquent\Relations\HasOneThrough
    {
        return $this->hasOneThrough(
            UserBalance::class,
            User::class,
            'id',        // FK on users
            'id_user',   // FK on user_balance
            'id_user',   // local key on misi_anggota
            'id'         // local key on users
        );
    }
}
