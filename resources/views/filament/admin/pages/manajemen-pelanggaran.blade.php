<x-filament-panels::page>
    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <button wire:click="$set('activeFilter', 'pending')" class="p-4 rounded-xl border text-left transition-all {{ $activeFilter === 'pending' ? 'bg-[#ffd900] text-black border-[#ffd900]' : 'bg-[#1a1a18] text-neutral-300 border-[#2a2a26]' }}">
            <div class="text-xs font-semibold uppercase opacity-75">Menunggu Tindakan Admin</div>
            <div class="text-2xl font-black mt-1">{{ $statPending }}</div>
        </button>
        <button wire:click="$set('activeFilter', 'disetujui')" class="p-4 rounded-xl border text-left transition-all {{ $activeFilter === 'disetujui' ? 'bg-[#ffd900] text-black border-[#ffd900]' : 'bg-[#1a1a18] text-neutral-300 border-[#2a2a26]' }}">
            <div class="text-xs font-semibold uppercase opacity-75">Sanksi Diterapkan</div>
            <div class="text-2xl font-black mt-1">{{ $statDisetujui }}</div>
        </button>
        <button wire:click="$set('activeFilter', 'ditolak')" class="p-4 rounded-xl border text-left transition-all {{ $activeFilter === 'ditolak' ? 'bg-[#ffd900] text-black border-[#ffd900]' : 'bg-[#1a1a18] text-neutral-300 border-[#2a2a26]' }}">
            <div class="text-xs font-semibold uppercase opacity-75">Laporan Ditolak</div>
            <div class="text-2xl font-black mt-1">{{ $statDitolak }}</div>
        </button>
    </div>

    {{-- Violation Table --}}
    <div class="bg-[#1a1a18] border border-[#2a2a26] rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-neutral-300 min-w-[750px]">
                <thead class="bg-[#111111] text-xs uppercase text-neutral-400 font-semibold border-b border-[#2a2a26]">
                    <tr>
                        <th class="py-3.5 px-4">Tester Terlapor</th>
                        <th class="py-3.5 px-4">Developer Pelapor</th>
                        <th class="py-3.5 px-4">Pengujian Terkait</th>
                        <th class="py-3.5 px-4">Alasan Ketidakhadiran</th>
                        <th class="py-3.5 px-4">Status & Sanksi</th>
                        <th class="py-3.5 px-4 text-right">Tindakan Admin</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#2a2a26]">
                    @forelse($pelanggaran as $item)
                        <tr class="hover:bg-[#20201d] transition-colors">
                            {{-- Tester --}}
                            <td class="py-4 px-4">
                                <div class="font-bold text-white">{{ $item->tester->name ?? 'Unknown Tester' }}</div>
                                <div class="text-xs text-neutral-400">{{ $item->tester->email ?? '-' }}</div>
                                @if($item->tester && $item->tester->is_banned)
                                    <span class="inline-block mt-1 px-2 py-0.5 rounded text-[10px] font-bold bg-red-950 text-red-300 border border-red-800">
                                        AKUN DIBLOKIR
                                    </span>
                                @endif
                            </td>

                            {{-- Developer --}}
                            <td class="py-4 px-4">
                                <div class="font-semibold text-neutral-200">{{ $item->developer->name ?? 'Unknown Developer' }}</div>
                                <div class="text-xs text-neutral-400">{{ $item->developer->email ?? '-' }}</div>
                            </td>

                            {{-- Misi --}}
                            <td class="py-4 px-4">
                                <div class="font-semibold text-white">{{ $item->misi->nama_aplikasi ?? '-' }}</div>
                                <div class="text-xs text-neutral-400">{{ $item->misi->jadwal_tanggal ? $item->misi->jadwal_tanggal->format('d M Y') : '' }}</div>
                            </td>

                            {{-- Alasan --}}
                            <td class="py-4 px-4 max-w-xs">
                                <div class="text-xs text-neutral-300 leading-relaxed bg-[#111111] p-2.5 rounded-lg border border-[#2a2a26]">
                                    {{ $item->alasan }}
                                </div>
                                <div class="text-[10px] text-neutral-500 mt-1">Dilaporkan: {{ $item->created_at->format('d M Y H:i') }}</div>
                            </td>

                            {{-- Status --}}
                            <td class="py-4 px-4">
                                @if($item->status === 'pending')
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-950/60 text-amber-300 border border-amber-800">
                                        Perlu Ditinjau
                                    </span>
                                @elseif($item->status === 'disetujui')
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-red-950/60 text-red-300 border border-red-800">
                                        Sanksi Disetujui
                                    </span>
                                    @if($item->tindakan_admin)
                                        <div class="text-[11px] text-neutral-400 mt-1">{{ $item->tindakan_admin }}</div>
                                    @endif
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-neutral-800 text-neutral-400 border border-neutral-700">
                                        Laporan Ditolak
                                    </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="py-4 px-4 text-right">
                                @if($item->status === 'pending')
                                    <div class="flex items-center justify-end gap-2">
                                        <button wire:click="blokirAkun({{ $item->id }})" wire:confirm="Yakin ingin memblokir akun tester ini karena pelanggaran ketidakhadiran?" class="px-3 py-1.5 rounded-lg bg-red-600 hover:bg-red-500 text-white text-xs font-bold transition-colors">
                                            Blokir Akun
                                        </button>
                                        <button wire:click="beriPeringatan({{ $item->id }})" class="px-3 py-1.5 rounded-lg bg-amber-500 hover:bg-amber-400 text-black text-xs font-bold transition-colors">
                                            Peringatan
                                        </button>
                                        <button wire:click="tolakLaporan({{ $item->id }})" class="px-3 py-1.5 rounded-lg bg-[#252522] text-neutral-300 hover:bg-[#30302c] text-xs font-semibold transition-colors">
                                            Tolak
                                        </button>
                                    </div>
                                @else
                                    @if($item->tester && $item->tester->is_banned)
                                        <button wire:click="bukaBlokir({{ $item->tester->id }})" class="px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition-colors">
                                            Buka Blokir Akun
                                        </button>
                                    @else
                                        <span class="text-xs text-neutral-500">Selesai diproses</span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-neutral-400">
                                <svg class="w-10 h-10 mx-auto text-neutral-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                <p class="text-xs">Tidak ada data pelanggaran tester.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-filament-panels::page>
