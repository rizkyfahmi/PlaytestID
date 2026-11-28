<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Update users table for phone & payout info
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'phone_number')) {
                $table->string('phone_number')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'payout_method')) {
                $table->string('payout_method')->nullable()->after('phone_number');
            }
            if (!Schema::hasColumn('users', 'payout_bank_name')) {
                $table->string('payout_bank_name')->nullable()->after('payout_method');
            }
            if (!Schema::hasColumn('users', 'payout_account_name')) {
                $table->string('payout_account_name')->nullable()->after('payout_bank_name');
            }
            if (!Schema::hasColumn('users', 'payout_account_number')) {
                $table->string('payout_account_number')->nullable()->after('payout_account_name');
            }
            if (!Schema::hasColumn('users', 'is_banned')) {
                $table->boolean('is_banned')->default(false)->after('role');
            }
            if (!Schema::hasColumn('users', 'banned_reason')) {
                $table->text('banned_reason')->nullable()->after('is_banned');
            }
        });

        // 2. Update misi table for face-to-face testing details
        Schema::table('misi', function (Blueprint $table) {
            if (!Schema::hasColumn('misi', 'penyelenggara')) {
                $table->string('penyelenggara')->nullable()->after('nama_aplikasi');
            }
            if (!Schema::hasColumn('misi', 'lokasi')) {
                $table->text('lokasi')->nullable()->after('penyelenggara');
            }
            if (!Schema::hasColumn('misi', 'jadwal_tanggal')) {
                $table->date('jadwal_tanggal')->nullable()->after('lokasi');
            }
            if (!Schema::hasColumn('misi', 'jadwal_waktu')) {
                $table->string('jadwal_waktu')->nullable()->after('jadwal_tanggal');
            }
            if (!Schema::hasColumn('misi', 'kuota_tester')) {
                $table->unsignedInteger('kuota_tester')->default(1)->after('jadwal_waktu');
            }
            if (!Schema::hasColumn('misi', 'komisi_per_tester')) {
                $table->unsignedBigInteger('komisi_per_tester')->default(20000)->after('kuota_tester');
            }
            if (!Schema::hasColumn('misi', 'biaya_admin')) {
                $table->unsignedBigInteger('biaya_admin')->default(0)->after('komisi_per_tester');
            }
            if (!Schema::hasColumn('misi', 'total_biaya')) {
                $table->unsignedBigInteger('total_biaya')->default(20000)->after('biaya_admin');
            }
            if (!Schema::hasColumn('misi', 'persyaratan')) {
                $table->text('persyaratan')->nullable()->after('total_biaya');
            }
        });

        // Make id_paket & link_aplikasi nullable in misi table if not already
        Schema::table('misi', function (Blueprint $table) {
            $table->unsignedBigInteger('id_paket')->nullable()->change();
            $table->string('link_aplikasi')->nullable()->change();
        });

        // 3. Update misi_anggota for application & attendance workflow
        Schema::table('misi_anggota', function (Blueprint $table) {
            if (!Schema::hasColumn('misi_anggota', 'phone_number')) {
                $table->string('phone_number')->nullable()->after('id_user');
            }
            if (!Schema::hasColumn('misi_anggota', 'payout_method')) {
                $table->string('payout_method')->nullable()->after('phone_number');
            }
            if (!Schema::hasColumn('misi_anggota', 'payout_bank_name')) {
                $table->string('payout_bank_name')->nullable()->after('payout_method');
            }
            if (!Schema::hasColumn('misi_anggota', 'payout_account_name')) {
                $table->string('payout_account_name')->nullable()->after('payout_bank_name');
            }
            if (!Schema::hasColumn('misi_anggota', 'payout_account_number')) {
                $table->string('payout_account_number')->nullable()->after('payout_account_name');
            }
            if (!Schema::hasColumn('misi_anggota', 'status_kehadiran')) {
                $table->string('status_kehadiran')->default('belum_hadir')->after('status');
            }
            if (!Schema::hasColumn('misi_anggota', 'status_komisi')) {
                $table->string('status_komisi')->default('belum_dibayar')->after('status_kehadiran');
            }
            if (!Schema::hasColumn('misi_anggota', 'catatan_seleksi')) {
                $table->text('catatan_seleksi')->nullable()->after('status_komisi');
            }
            if (!Schema::hasColumn('misi_anggota', 'agreed_terms_at')) {
                $table->timestamp('agreed_terms_at')->nullable()->after('catatan_seleksi');
            }
        });

        // 4. Update user_balance for Rupiah balance
        Schema::table('user_balance', function (Blueprint $table) {
            if (!Schema::hasColumn('user_balance', 'saldo_rupiah')) {
                $table->unsignedBigInteger('saldo_rupiah')->default(0)->after('point');
            }
        });

        // 5. Create pelanggaran_tester table
        if (!Schema::hasTable('pelanggaran_tester')) {
            Schema::create('pelanggaran_tester', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
                $table->foreignId('id_developer')->constrained('users')->cascadeOnDelete();
                $table->foreignId('id_misi')->constrained('misi')->cascadeOnDelete();
                $table->text('alasan');
                $table->string('status')->default('pending'); // pending, disetujui, ditolak
                $table->text('tindakan_admin')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggaran_tester');

        Schema::table('user_balance', function (Blueprint $table) {
            $table->dropColumn('saldo_rupiah');
        });

        Schema::table('misi_anggota', function (Blueprint $table) {
            $table->dropColumn([
                'phone_number',
                'payout_method',
                'payout_bank_name',
                'payout_account_name',
                'payout_account_number',
                'status_kehadiran',
                'status_komisi',
                'catatan_seleksi',
                'agreed_terms_at',
            ]);
        });

        Schema::table('misi', function (Blueprint $table) {
            $table->dropColumn([
                'penyelenggara',
                'lokasi',
                'jadwal_tanggal',
                'jadwal_waktu',
                'kuota_tester',
                'komisi_per_tester',
                'biaya_admin',
                'total_biaya',
                'persyaratan',
            ]);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone_number',
                'payout_method',
                'payout_bank_name',
                'payout_account_name',
                'payout_account_number',
                'is_banned',
                'banned_reason',
            ]);
        });
    }
};
