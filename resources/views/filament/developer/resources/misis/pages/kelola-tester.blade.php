<x-filament-panels::page>
    {{-- Header Banner Info Pengujian --}}
    <div class="bg-[#1a1a18] border border-[#2a2a26] rounded-2xl p-6 text-white mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="flex items-start gap-4">
                @if($record->logo)
                    <img src="/storage/{{ $record->logo }}" alt="{{ $record->nama_aplikasi }}" class="w-16 h-16 rounded-2xl object-cover border border-[#333330] flex-shrink-0">
                @else
                    <div class="w-16 h-16 rounded-2xl bg-[#252522] border border-[#333330] text-[#ffd900] font-black text-xl flex items-center justify-center flex-shrink-0">
                        {{ strtoupper(substr($record->nama_aplikasi, 0, 2)) }}
                    </div>
                @endif
                <div>
                    <div class="flex items-center gap-3 flex-wrap">
                        <h2 class="text-xl font-bold text-white">{{ $record->nama_aplikasi }}</h2>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-[#252522] text-[#ffd900] border border-[#3a3a34]">
                            Face-to-Face Testing
                        </span>
                    </div>
                    @if($record->penyelenggara)
                        <p class="text-xs text-neutral-400 mt-1">Penyelenggara: <strong class="text-neutral-200">{{ $record->penyelenggara }}</strong></p>
                    @endif
                    <div class="flex flex-wrap items-center gap-y-2 gap-x-6 mt-3 text-xs text-neutral-300">
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-[#ffd900]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>{{ $record->lokasi ?? 'Lokasi belum ditentukan' }}</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-[#ffd900]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>{{ $record->jadwal_tanggal ? $record->jadwal_tanggal->format('d M Y') : '-' }} &bull; {{ $record->jadwal_waktu ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-3 sm:flex sm:items-center gap-2 sm:gap-4 bg-[#111111] border border-[#2a2a26] p-3 sm:p-4 rounded-xl">
                <div class="text-center px-2 sm:px-3 border-r border-[#2a2a26]">
                    <div class="text-xs text-neutral-400">Total Kuota</div>
                    <div class="text-base sm:text-lg font-black text-white">{{ $kuota }} <span class="text-xs font-normal text-neutral-400">tester</span></div>
                </div>
                <div class="text-center px-2 sm:px-3 border-r border-[#2a2a26]">
                    <div class="text-xs text-neutral-400">Sisa Kuota</div>
                    <div class="text-base sm:text-lg font-black {{ $sisaKuota > 0 ? 'text-[#ffd900]' : 'text-red-400' }}">{{ $sisaKuota }}</div>
                </div>
                <div class="text-center px-2 sm:px-3">
                    <div class="text-xs text-neutral-400">Komisi/Tester</div>
                    <div class="text-base sm:text-lg font-black text-[#ffd900]">Rp {{ number_format($record->komisi_per_tester ?? 20000, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Stat Badges --}}
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 mb-6">
        <button wire:click="$set('activeTab', 'semua')" class="p-4 rounded-xl border text-left transition-all {{ $activeTab === 'semua' ? 'bg-[#ffd900] text-black border-[#ffd900]' : 'bg-[#1a1a18] text-neutral-300 border-[#2a2a26] hover:border-neutral-500' }}">
            <div class="text-xs font-semibold uppercase opacity-75">Semua Pelamar</div>
            <div class="text-2xl font-black mt-1">{{ $statTotal }}</div>
        </button>
        <button wire:click="$set('activeTab', 'menunggu')" class="p-4 rounded-xl border text-left transition-all {{ $activeTab === 'menunggu' ? 'bg-[#ffd900] text-black border-[#ffd900]' : 'bg-[#1a1a18] text-neutral-300 border-[#2a2a26] hover:border-neutral-500' }}">
            <div class="text-xs font-semibold uppercase opacity-75">Menunggu Seleksi</div>
            <div class="text-2xl font-black mt-1">{{ $statMenunggu }}</div>
        </button>
        <button wire:click="$set('activeTab', 'diterima')" class="p-4 rounded-xl border text-left transition-all {{ $activeTab === 'diterima' ? 'bg-[#ffd900] text-black border-[#ffd900]' : 'bg-[#1a1a18] text-neutral-300 border-[#2a2a26] hover:border-neutral-500' }}">
            <div class="text-xs font-semibold uppercase opacity-75">Diterima</div>
            <div class="text-2xl font-black mt-1">{{ $statDiterima }}</div>
        </button>
        <button wire:click="$set('activeTab', 'selesai')" class="p-4 rounded-xl border text-left transition-all {{ $activeTab === 'selesai' ? 'bg-[#ffd900] text-black border-[#ffd900]' : 'bg-[#1a1a18] text-neutral-300 border-[#2a2a26] hover:border-neutral-500' }}">
            <div class="text-xs font-semibold uppercase opacity-75">Hadir & Selesai</div>
            <div class="text-2xl font-black mt-1">{{ $statSelesai }}</div>
        </button>
        <button wire:click="$set('activeTab', 'ditolak')" class="p-4 rounded-xl border text-left transition-all {{ $activeTab === 'ditolak' ? 'bg-[#ffd900] text-black border-[#ffd900]' : 'bg-[#1a1a18] text-neutral-300 border-[#2a2a26] hover:border-neutral-500' }}">
            <div class="text-xs font-semibold uppercase opacity-75">Ditolak</div>
            <div class="text-2xl font-black mt-1">{{ $statDitolak }}</div>
        </button>
    </div>

    {{-- Filter Search --}}
    <div class="bg-[#1a1a18] border border-[#2a2a26] rounded-2xl p-4 mb-6 flex items-center justify-between gap-4">
        <div class="relative flex-1">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari pelamar berdasarkan nama, email, nomor HP..." class="w-full bg-[#111111] border border-[#333330] rounded-xl px-4 py-2.5 text-sm text-white placeholder-neutral-500 focus:outline-none focus:border-[#ffd900]">
        </div>
    </div>

    {{-- Applicant List Table --}}
    <div class="bg-[#1a1a18] border border-[#2a2a26] rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-neutral-300 min-w-[700px]">
                <thead class="bg-[#111111] text-xs uppercase text-neutral-400 font-semibold border-b border-[#2a2a26]">
                    <tr>
                        <th class="py-3.5 px-4">Tester / Data Diri</th>
                        <th class="py-3.5 px-4">Kontak (No. HP)</th>
                        <th class="py-3.5 px-4">Informasi Pembayaran (Komisi)</th>
                        <th class="py-3.5 px-4">Waktu Daftar</th>
                        <th class="py-3.5 px-4">Status & Kehadiran</th>
                        <th class="py-3.5 px-4 text-right">Aksi Developer</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#2a2a26]">
                    @forelse($testers as $item)
                        <tr class="hover:bg-[#20201d] transition-colors">
                            {{-- Profil --}}
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-[#252522] border border-[#3a3a34] text-[#ffd900] font-bold text-xs flex items-center justify-center flex-shrink-0">
                                        {{ $item['inisial'] }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-white">{{ $item['nama'] }}</div>
                                        <div class="text-xs text-neutral-400">{{ $item['email'] }}</div>
                                    </div>
                                </div>
                            </td>

                            {{-- No HP --}}
                            <td class="py-4 px-4">
                                @if($item['phone'] && $item['phone'] !== '-')
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item['phone']) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs text-[#ffd900] hover:underline font-medium">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.303-.058.116-.087.188-.173.289l-.26.302c-.087.086-.179.18-.077.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.173.086.275.072.376-.044.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/></svg>
                                        {{ $item['phone'] }}
                                    </a>
                                @else
                                    <span class="text-xs text-neutral-500">-</span>
                                @endif
                            </td>

                            {{-- Pembayaran --}}
                            <td class="py-4 px-4">
                                <div class="text-xs">
                                    <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-[#111111] text-[#ffd900] border border-[#333330]">
                                        {{ $item['payout_method'] }}
                                        @if($item['payout_bank_name']) ({{ $item['payout_bank_name'] }}) @endif
                                    </span>
                                    <div class="text-neutral-200 font-semibold mt-1">{{ $item['payout_account_name'] }}</div>
                                    <div class="text-neutral-400 font-mono text-[11px]">{{ $item['payout_account_number'] }}</div>
                                </div>
                            </td>

                            {{-- Waktu Daftar --}}
                            <td class="py-4 px-4 text-xs text-neutral-400">
                                {{ $item['tanggal_apply'] }}
                            </td>

                            {{-- Status & Kehadiran --}}
                            <td class="py-4 px-4">
                                @if(in_array($item['status'], ['pending', 'reviewing', 'menunggu_seleksi']))
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-950/60 text-amber-300 border border-amber-800">
                                        Menunggu Seleksi
                                    </span>
                                @elseif(in_array($item['status'], ['accepted', 'progress']))
                                    <div class="flex flex-col gap-1">
                                        <span class="inline-flex items-center w-fit px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-950/60 text-emerald-300 border border-emerald-800">
                                            Diterima
                                        </span>
                                        @if($item['status_kehadiran'] === 'tidak_hadir')
                                            <span class="text-[11px] text-red-400 font-semibold">&bull; Dilaporkan Tidak Hadir</span>
                                        @else
                                            <span class="text-[11px] text-neutral-400">&bull; Menunggu Kehadiran</span>
                                        @endif
                                    </div>
                                @elseif($item['status'] === 'selesai')
                                    <div class="flex flex-col gap-1">
                                        <span class="inline-flex items-center w-fit px-2.5 py-0.5 rounded-full text-xs font-semibold bg-[#252522] text-[#ffd900] border border-[#ffd900]/40">
                                            ✓ Hadir & Selesai
                                        </span>
                                        <span class="text-[11px] text-emerald-400 font-semibold">&bull; Komisi Masuk Dompet</span>
                                    </div>
                                @elseif(in_array($item['status'], ['rejected', 'cancelled']))
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-950/60 text-red-300 border border-red-800">
                                        Ditolak
                                    </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="py-4 px-4 text-right">
                                @if(in_array($item['status'], ['pending', 'reviewing', 'menunggu_seleksi']))
                                    <div class="flex items-center justify-end gap-2">
                                        <button wire:click="terimaTester({{ $item['id'] }})" class="px-3 py-1.5 rounded-lg bg-[#ffd900] text-black text-xs font-bold hover:bg-[#ffe133] transition-colors">
                                            Terima
                                        </button>
                                        <button wire:click="tolakTester({{ $item['id'] }})" class="px-3 py-1.5 rounded-lg bg-[#252522] text-red-400 border border-red-900/50 hover:bg-red-950/40 text-xs font-semibold transition-colors">
                                            Tolak
                                        </button>
                                    </div>
                                @elseif(in_array($item['status'], ['accepted', 'progress']))
                                    <div class="flex items-center justify-end gap-2">
                                        <button wire:click="konfirmasiHadirDanSelesai({{ $item['id'] }})" wire:confirm="Konfirmasi bahwa tester {{ $item['nama'] }} telah hadir langsung di lokasi dan menyelesaikan testing? Komisi Rp {{ number_format($record->komisi_per_tester ?? 20000, 0, ',', '.') }} akan langsung dikreditkan ke saldo dompet tester." class="px-3 py-1.5 rounded-lg bg-emerald-500 hover:bg-emerald-400 text-black text-xs font-bold transition-colors">
                                            Konfirmasi Hadir & Selesai
                                        </button>
                                        <button wire:click="openReportModal({{ $item['id'] }})" class="px-3 py-1.5 rounded-lg bg-red-950/60 text-red-300 border border-red-800 hover:bg-red-900/60 text-xs font-semibold transition-colors">
                                            Laporkan Absen
                                        </button>
                                    </div>
                                @else
                                    <span class="text-xs text-neutral-500">Tidak ada aksi</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-neutral-400">
                                <div class="max-w-xs mx-auto text-center">
                                    <svg class="w-12 h-12 mx-auto text-neutral-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    <p class="font-medium text-neutral-300">Belum ada pelamar tester</p>
                                    <p class="text-xs text-neutral-500 mt-1">Tester yang mengajukan Apply akan muncul pada daftar antrean ini untuk Anda seleksi.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Report Modal --}}
    @if($selectedTesterId)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4">
            <div class="bg-[#1a1a18] border border-[#333330] rounded-2xl max-w-md w-full p-6 text-white shadow-2xl">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    Laporkan Ketidakhadiran Tester
                </h3>
                <p class="text-xs text-neutral-400 mt-1.5">
                    Laporan ini akan diteruskan ke Admin untuk dicatat dan diperiksa sebelum sanksi pemblokiran diterapkan sesuai ketentuan.
                </p>

                <div class="mt-4">
                    <label class="block text-xs font-semibold text-neutral-300 mb-1.5">Alasan / Catatan Ketidakhadiran *</label>
                    <textarea wire:model="alasanPelanggaran" rows="4" placeholder="Jelaskan detail ketidakhadiran (misal: tester tidak datang ke lokasi tanpa kabar, tidak dapat dihubungi melalui nomor telepon yang tertera)..." class="w-full bg-[#111111] border border-[#333330] rounded-xl p-3 text-sm text-white placeholder-neutral-500 focus:outline-none focus:border-red-400"></textarea>
                </div>

                <div class="flex items-center justify-end gap-3 mt-6">
                    <button type="button" wire:click="$set('selectedTesterId', null)" class="px-4 py-2 rounded-xl bg-[#252522] text-neutral-300 text-xs font-semibold hover:bg-[#30302c]">
                        Batal
                    </button>
                    <button type="button" wire:click="submitReport" class="px-4 py-2 rounded-xl bg-red-600 hover:bg-red-500 text-white text-xs font-bold">
                        Kirim Laporan ke Admin
                    </button>
                </div>
            </div>
        </div>
    @endif
</x-filament-panels::page>
