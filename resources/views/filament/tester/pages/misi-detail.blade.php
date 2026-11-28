<x-filament-panels::page>
    @if(!$misi)
        <div class="bg-[#1a1a18] border border-[#2a2a26] rounded-2xl p-12 text-center text-neutral-400">
            <h3 class="text-lg font-bold text-white mb-2">Pengujian Tidak Ditemukan</h3>
            <p class="text-sm">Pengujian ini mungkin telah dihapus atau ditutup oleh developer.</p>
            <a href="/tester" class="mt-4 inline-block px-5 py-2.5 rounded-xl bg-[#ffd900] text-black font-bold text-sm">Kembali ke Beranda</a>
        </div>
    @else
        <div class="max-w-4xl mx-auto space-y-6">
            {{-- Back Link --}}
            <a href="/tester" class="inline-flex items-center gap-2 text-xs font-semibold text-neutral-400 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Pengujian
            </a>

            {{-- Hero Header --}}
            <div class="bg-[#1a1a18] border border-[#2a2a26] rounded-2xl p-6 text-white shadow-sm">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                    <div class="flex items-start gap-4">
                        @if($misi->logo)
                            <img src="/storage/{{ $misi->logo }}" alt="{{ $misi->nama_aplikasi }}" class="w-16 h-16 rounded-2xl object-cover border border-[#333330] flex-shrink-0">
                        @else
                            <div class="w-16 h-16 rounded-2xl bg-[#252522] border border-[#333330] text-[#ffd900] font-black text-2xl flex items-center justify-center flex-shrink-0">
                                {{ strtoupper(substr($misi->nama_aplikasi, 0, 2)) }}
                            </div>
                        @endif
                        <div>
                            <div class="flex items-center gap-2.5 flex-wrap">
                                <h1 class="text-2xl font-black text-white">{{ $misi->nama_aplikasi }}</h1>
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-[#ffd900]/10 text-[#ffd900] border border-[#ffd900]/30">
                                    Tatap Muka (Face to Face)
                                </span>
                            </div>
                            @if($misi->penyelenggara)
                                <p class="text-xs text-neutral-400 mt-1">Diselenggarakan oleh: <strong class="text-neutral-200">{{ $misi->penyelenggara }}</strong></p>
                            @endif
                        </div>
                    </div>

                    {{-- Commission Card --}}
                    <div class="bg-[#111111] border border-[#2a2a26] rounded-xl px-5 py-3 text-right sm:min-w-[180px]">
                        <div class="text-[11px] font-semibold uppercase text-neutral-400">Komisi Tunai Tester</div>
                        <div class="text-2xl font-black text-[#ffd900] mt-0.5">Rp {{ number_format($misi->komisi_per_tester ?? 20000, 0, ',', '.') }}</div>
                        <div class="text-[10px] text-emerald-400 font-medium">Cair ke Dompet setelah selesai</div>
                    </div>
                </div>

                {{-- Key Details Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-6 pt-6 border-t border-[#2a2a26]">
                    <div class="flex items-start gap-3 bg-[#111111] p-3.5 rounded-xl border border-[#2a2a26]">
                        <div class="p-2 rounded-lg bg-[#252522] text-[#ffd900]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <div class="text-[11px] font-bold uppercase text-neutral-400">Lokasi Fisik Pengujian</div>
                            <div class="text-xs font-semibold text-white mt-0.5">{{ $misi->lokasi ?? 'Alamat akan diinformasikan' }}</div>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 bg-[#111111] p-3.5 rounded-xl border border-[#2a2a26]">
                        <div class="p-2 rounded-lg bg-[#252522] text-[#ffd900]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <div class="text-[11px] font-bold uppercase text-neutral-400">Jadwal & Waktu</div>
                            <div class="text-xs font-semibold text-white mt-0.5">
                                {{ $misi->jadwal_tanggal ? $misi->jadwal_tanggal->format('d F Y') : '-' }}
                            </div>
                            <div class="text-[11px] text-neutral-400">{{ $misi->jadwal_waktu ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 bg-[#111111] p-3.5 rounded-xl border border-[#2a2a26]">
                        <div class="p-2 rounded-lg bg-[#252522] text-[#ffd900]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <div class="text-[11px] font-bold uppercase text-neutral-400">Kuota Tester</div>
                            <div class="text-xs font-semibold text-white mt-0.5">
                                Terisi {{ $acceptedCount }} dari {{ $misi->kuota_tester ?? 0 }} orang
                            </div>
                            <div class="text-[11px] {{ $sisaKuota > 0 ? 'text-emerald-400' : 'text-red-400' }}">
                                {{ $sisaKuota > 0 ? 'Sisa ' . $sisaKuota . ' slot tersedia' : 'Kuota Penuh' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Description & Requirements --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Deskripsi Kegiatan --}}
                <div class="bg-[#1a1a18] border border-[#2a2a26] rounded-2xl p-6 text-white">
                    <h3 class="text-base font-bold text-white flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 text-[#ffd900]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Deskripsi & Kegiatan Pengujian
                    </h3>
                    <div class="prose prose-invert max-w-none text-xs text-neutral-300 leading-relaxed">
                        {!! $misi->instruksi !!}
                    </div>
                </div>

                {{-- Persyaratan Wajib --}}
                <div class="bg-[#1a1a18] border border-[#2a2a26] rounded-2xl p-6 text-white">
                    <h3 class="text-base font-bold text-white flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Persyaratan Wajib Tester
                    </h3>
                    <div class="bg-[#111111] border border-amber-900/40 rounded-xl p-4 text-xs text-neutral-300 whitespace-pre-line leading-relaxed">
                        {{ $misi->persyaratan ?? 'Tidak ada persyaratan khusus.' }}
                    </div>
                    <p class="text-[11px] text-neutral-500 mt-3">
                        * Anda wajib mematuhi seluruh persyaratan di atas dan hadir langsung di lokasi pengujian. Ketidakhadiran tanpa alasan dapat dikenakan sanksi akun.
                    </p>
                </div>
            </div>

            {{-- Application Area --}}
            @if($alreadyJoined && $misiAnggota)
                <div class="bg-[#1a1a18] border border-[#2a2a26] rounded-2xl p-6 text-white">
                    <h3 class="text-base font-bold text-white mb-2">Status Lamaran Pengujian Anda</h3>
                    
                    @if(in_array($misiAnggota->status, ['pending', 'reviewing', 'menunggu_seleksi']))
                        <div class="bg-amber-950/40 border border-amber-800/60 rounded-xl p-4 flex items-start gap-3">
                            <span class="text-xl">⏳</span>
                            <div>
                                <h4 class="text-sm font-bold text-amber-300">Menunggu Seleksi Developer</h4>
                                <p class="text-xs text-neutral-300 mt-1">
                                    Lamaran Anda telah berhasil dikirim pada {{ $misiAnggota->created_at->format('d M Y H:i') }}. Developer sedang menyeleksi calon tester yang mendaftar. Silakan cek berkala status lamaran Anda.
                                </p>
                            </div>
                        </div>
                    @elseif(in_array($misiAnggota->status, ['accepted', 'progress']))
                        <div class="bg-emerald-950/40 border border-emerald-800/60 rounded-xl p-4 flex items-start gap-3">
                            <span class="text-xl">🎉</span>
                            <div>
                                <h4 class="text-sm font-bold text-emerald-300">Selamat! Lamaran Anda Diterima</h4>
                                <p class="text-xs text-neutral-300 mt-1">
                                    Anda telah terpilih sebagai tester! Mohon hadir tepat waktu di <strong>{{ $misi->lokasi }}</strong> pada tanggal <strong>{{ $misi->jadwal_tanggal ? $misi->jadwal_tanggal->format('d F Y') : '-' }} ({{ $misi->jadwal_waktu }})</strong>.
                                </p>
                                <div class="mt-3 text-xs bg-[#111111] p-3 rounded-lg border border-emerald-900/50">
                                    Penerimaan komisi Rp {{ number_format($misi->komisi_per_tester ?? 20000, 0, ',', '.') }} akan dikreditkan ke {{ strtoupper($misiAnggota->payout_method) }} ({{ $misiAnggota->payout_account_number }}) setelah pengujian selesai.
                                </div>
                            </div>
                        </div>
                    @elseif($misiAnggota->status === 'selesai')
                        <div class="bg-[#252522] border border-[#ffd900]/40 rounded-xl p-4 flex items-start gap-3">
                            <span class="text-xl">✅</span>
                            <div>
                                <h4 class="text-sm font-bold text-[#ffd900]">Pengujian Selesai & Hadir</h4>
                                <p class="text-xs text-neutral-300 mt-1">
                                    Developer telah mengonfirmasi kehadiran Anda. Komisi sebesar Rp {{ number_format($misi->komisi_per_tester ?? 20000, 0, ',', '.') }} telah masuk ke Saldo Dompet Anda.
                                </p>
                                <a href="/tester/dompet" class="inline-block mt-3 px-4 py-2 rounded-xl bg-[#ffd900] text-black font-bold text-xs">
                                    Buka Dompet & Tarik Dana
                                </a>
                            </div>
                        </div>
                    @elseif(in_array($misiAnggota->status, ['rejected', 'cancelled']))
                        <div class="bg-red-950/40 border border-red-800/60 rounded-xl p-4 flex items-start gap-3">
                            <span class="text-xl">❌</span>
                            <div>
                                <h4 class="text-sm font-bold text-red-300">Lamaran Belum Diterima</h4>
                                <p class="text-xs text-neutral-300 mt-1">
                                    Mohon maaf, kuota pengujian telah terpenuhi atau pengajuan belum sesuai dengan kriteria developer saat ini. Anda dapat melamar pada sesi pengujian lainnya.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                {{-- Apply Form --}}
                <div class="bg-[#1a1a18] border border-[#2a2a26] rounded-2xl p-6 text-white shadow-sm">
                    <h3 class="text-base font-bold text-white mb-1">Formulir Lamaran Tester (Apply)</h3>
                    <p class="text-xs text-neutral-400 mb-6">
                        Lengkapi nomor telepon aktif dan rekening pembayaran digital untuk menerima komisi sebelum mengirimkan lamaran.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-xs font-semibold text-neutral-300 mb-1.5">Nama Lengkap</label>
                            <input type="text" value="{{ auth()->user()->name }}" disabled class="w-full bg-[#111111] border border-[#333330] rounded-xl px-3.5 py-2.5 text-xs text-neutral-400 cursor-not-allowed">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-neutral-300 mb-1.5">Nomor Telepon / WhatsApp Aktif *</label>
                            <input type="tel" wire:model="phone_number" placeholder="Contoh: 081234567890" class="w-full bg-[#111111] border border-[#333330] rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-[#ffd900]">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-neutral-300 mb-1.5">Metode Pembayaran Komisi *</label>
                            <select wire:model.live="payout_method" class="w-full bg-[#111111] border border-[#333330] rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-[#ffd900]">
                                <option value="bank">Transfer Bank</option>
                                <option value="dana">DANA</option>
                                <option value="gopay">GoPay</option>
                                <option value="ovo">OVO</option>
                                <option value="shopeepay">ShopeePay</option>
                            </select>
                        </div>

                        @if($payout_method === 'bank')
                            <div>
                                <label class="block text-xs font-semibold text-neutral-300 mb-1.5">Nama Bank *</label>
                                <select wire:model="payout_bank_name" class="w-full bg-[#111111] border border-[#333330] rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-[#ffd900]">
                                    <option value="BCA">Bank Central Asia (BCA)</option>
                                    <option value="Mandiri">Bank Mandiri</option>
                                    <option value="BNI">Bank Negara Indonesia (BNI)</option>
                                    <option value="BRI">Bank Rakyat Indonesia (BRI)</option>
                                    <option value="CIMB Niaga">CIMB Niaga</option>
                                    <option value="BSI">Bank Syariah Indonesia (BSI)</option>
                                    <option value="Bank Jago">Bank Jago</option>
                                    <option value="SeaBank">SeaBank</option>
                                </select>
                            </div>
                        @endif

                        <div>
                            <label class="block text-xs font-semibold text-neutral-300 mb-1.5">
                                {{ $payout_method === 'bank' ? 'Nama Pemilik Rekening *' : 'Nama Pemilik Akun *' }}
                            </label>
                            <input type="text" wire:model="payout_account_name" placeholder="Sesuai buku tabungan / e-wallet" class="w-full bg-[#111111] border border-[#333330] rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-[#ffd900]">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-neutral-300 mb-1.5">
                                {{ $payout_method === 'bank' ? 'Nomor Rekening Bank *' : 'Nomor HP Akun E-Wallet *' }}
                            </label>
                            <input type="text" wire:model="payout_account_number" placeholder="{{ $payout_method === 'bank' ? 'Contoh: 1234567890' : 'Contoh: 081234567890' }}" class="w-full bg-[#111111] border border-[#333330] rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-[#ffd900]">
                        </div>
                    </div>

                    {{-- Checkbox Persetujuan --}}
                    <div class="bg-[#111111] border border-[#2a2a26] rounded-xl p-4 mb-6">
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" wire:model.live="agreed_terms" class="mt-0.5 w-4 h-4 rounded border-neutral-700 text-[#ffd900] focus:ring-0">
                            <span class="text-xs text-neutral-300 leading-relaxed">
                                <strong class="text-white">Saya menyetujui seluruh persyaratan di atas.</strong> Saya berkomitmen untuk datang secara langsung ke lokasi pengujian (<strong>{{ $misi->lokasi }}</strong>) pada jadwal yang ditentukan dan mematuhi arahan developer.
                            </span>
                        </label>
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-[11px] text-neutral-500">
                            Tombol Apply akan aktif setelah Anda mencentang persetujuan persyaratan.
                        </p>
                        <button type="button" wire:click="applyMission" 
                            @if(!$agreed_terms || $sisaKuota <= 0) disabled @endif
                            class="px-6 py-3 rounded-xl font-bold text-sm transition-all {{ ($agreed_terms && $sisaKuota > 0) ? 'bg-[#ffd900] text-black hover:bg-[#ffe133] shadow-md shadow-[#ffd900]/20' : 'bg-neutral-800 text-neutral-500 cursor-not-allowed' }}">
                            {{ $sisaKuota > 0 ? 'Ajukan Lamaran (Apply)' : 'Kuota Pengujian Penuh' }}
                        </button>
                    </div>
                </div>
            @endif
        </div>
    @endif
</x-filament-panels::page>
