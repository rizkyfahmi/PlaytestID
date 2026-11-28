<x-filament-panels::page>
    {{-- Tabs Filter --}}
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 mb-6">
        <button wire:click="$set('activeTab', 'semua')" class="p-4 rounded-xl border text-left transition-all {{ $activeTab === 'semua' ? 'bg-[#ffd900] text-black border-[#ffd900]' : 'bg-[#1a1a18] text-neutral-300 border-[#2a2a26] hover:border-neutral-500' }}">
            <div class="text-xs font-semibold uppercase opacity-75">Semua</div>
            <div class="text-2xl font-black mt-1">{{ $statTotal }}</div>
        </button>
        <button wire:click="$set('activeTab', 'menunggu')" class="p-4 rounded-xl border text-left transition-all {{ $activeTab === 'menunggu' ? 'bg-[#ffd900] text-black border-[#ffd900]' : 'bg-[#1a1a18] text-neutral-300 border-[#2a2a26] hover:border-neutral-500' }}">
            <div class="text-xs font-semibold uppercase opacity-75">Menunggu Seleksi</div>
            <div class="text-2xl font-black mt-1">{{ $statMenunggu }}</div>
        </button>
        <button wire:click="$set('activeTab', 'diterima')" class="p-4 rounded-xl border text-left transition-all {{ $activeTab === 'diterima' ? 'bg-[#ffd900] text-black border-[#ffd900]' : 'bg-[#1a1a18] text-neutral-300 border-[#2a2a26] hover:border-neutral-500' }}">
            <div class="text-xs font-semibold uppercase opacity-75">Diterima / Jadwal</div>
            <div class="text-2xl font-black mt-1">{{ $statDiterima }}</div>
        </button>
        <button wire:click="$set('activeTab', 'selesai')" class="p-4 rounded-xl border text-left transition-all {{ $activeTab === 'selesai' ? 'bg-[#ffd900] text-black border-[#ffd900]' : 'bg-[#1a1a18] text-neutral-300 border-[#2a2a26] hover:border-neutral-500' }}">
            <div class="text-xs font-semibold uppercase opacity-75">Selesai & Cair</div>
            <div class="text-2xl font-black mt-1">{{ $statSelesai }}</div>
        </button>
        <button wire:click="$set('activeTab', 'ditolak')" class="p-4 rounded-xl border text-left transition-all {{ $activeTab === 'ditolak' ? 'bg-[#ffd900] text-black border-[#ffd900]' : 'bg-[#1a1a18] text-neutral-300 border-[#2a2a26] hover:border-neutral-500' }}">
            <div class="text-xs font-semibold uppercase opacity-75">Ditolak</div>
            <div class="text-2xl font-black mt-1">{{ $statDitolak }}</div>
        </button>
    </div>

    {{-- Search Filter --}}
    <div class="bg-[#1a1a18] border border-[#2a2a26] rounded-2xl p-4 mb-6">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari sesi pengujian saya..." class="w-full bg-[#111111] border border-[#333330] rounded-xl px-4 py-2.5 text-sm text-white placeholder-neutral-500 focus:outline-none focus:border-[#ffd900]">
    </div>

    {{-- Missions Cards --}}
    <div class="space-y-4">
        @forelse($missions as $item)
            @php $m = $item->misi; @endphp
            @if($m)
                <div class="bg-[#1a1a18] border border-[#2a2a26] rounded-2xl p-6 text-white hover:border-[#383832] transition-colors">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="flex items-start gap-4">
                            @if($m->logo)
                                <img src="/storage/{{ $m->logo }}" alt="{{ $m->nama_aplikasi }}" class="w-14 h-14 rounded-2xl object-cover border border-[#333330] flex-shrink-0">
                            @else
                                <div class="w-14 h-14 rounded-2xl bg-[#252522] border border-[#333330] text-[#ffd900] font-black text-lg flex items-center justify-center flex-shrink-0">
                                    {{ strtoupper(substr($m->nama_aplikasi, 0, 2)) }}
                                </div>
                            @endif
                            <div>
                                <div class="flex items-center gap-2.5 flex-wrap">
                                    <h3 class="text-lg font-bold text-white">{{ $m->nama_aplikasi }}</h3>
                                    @if(in_array($item->status, ['pending', 'reviewing', 'menunggu_seleksi']))
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-950/60 text-amber-300 border border-amber-800">
                                            Menunggu Seleksi
                                        </span>
                                    @elseif(in_array($item->status, ['accepted', 'progress']))
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-950/60 text-emerald-300 border border-emerald-800">
                                            Diterima — Wajib Hadir
                                        </span>
                                    @elseif($item->status === 'selesai')
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-[#252522] text-[#ffd900] border border-[#ffd900]/40">
                                            ✓ Hadir & Komisi Cair
                                        </span>
                                    @elseif(in_array($item->status, ['rejected', 'cancelled']))
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-950/60 text-red-300 border border-red-800">
                                            Ditolak
                                        </span>
                                    @endif
                                </div>

                                @if($m->penyelenggara)
                                    <p class="text-xs text-neutral-400 mt-1">Penyelenggara: <strong class="text-neutral-200">{{ $m->penyelenggara }}</strong></p>
                                @endif

                                <div class="flex flex-wrap items-center gap-y-1 gap-x-4 mt-2 text-xs text-neutral-300">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-[#ffd900]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        <span>{{ $m->lokasi ?? 'Lokasi fisik' }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-[#ffd900]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span>{{ $m->jadwal_tanggal ? $m->jadwal_tanggal->format('d M Y') : '-' }} &bull; {{ $m->jadwal_waktu ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex sm:flex-col items-center sm:items-end justify-between w-full sm:w-auto gap-3 pt-3 sm:pt-0 border-t sm:border-t-0 border-[#2a2a26]">
                            <div class="text-left sm:text-right">
                                <div class="text-[11px] text-neutral-400">Komisi Tester</div>
                                <div class="text-base font-black text-[#ffd900]">Rp {{ number_format($m->komisi_per_tester ?? 20000, 0, ',', '.') }}</div>
                            </div>
                            <a href="/tester/misi-detail?misi_id={{ $m->id }}" class="px-4 py-2 rounded-xl bg-[#252522] text-xs font-bold text-white hover:bg-[#33332d] transition-colors">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="bg-[#1a1a18] border border-[#2a2a26] rounded-2xl p-12 text-center text-neutral-400">
                <svg class="w-12 h-12 mx-auto text-neutral-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                <p class="font-bold text-white">Belum Ada Riwayat Pengujian</p>
                <p class="text-xs text-neutral-500 mt-1">Anda belum melamar pada pengujian tatap muka manapun.</p>
                <a href="/tester" class="mt-4 inline-block px-5 py-2.5 rounded-xl bg-[#ffd900] text-black font-bold text-xs">Jelajahi Pengujian Tersedia</a>
            </div>
        @endforelse
    </div>
</x-filament-panels::page>
