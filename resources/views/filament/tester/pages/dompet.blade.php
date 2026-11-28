<x-filament-panels::page>
    @php
        $currentBalance = $this->getBalance();
        $presetOptions = [20000, 40000, 60000, 80000, 100000, 200000];
    @endphp

    {{-- Balance Header Banner --}}
    <div class="bg-[#1a1a18] border border-[#2a2a26] rounded-2xl p-6 text-white mb-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-[#ffd900]">Saldo Tersedia</span>
                <div class="text-3xl sm:text-4xl font-black text-white mt-1">
                    Rp {{ number_format($currentBalance, 0, ',', '.') }}
                </div>
                <p class="text-xs text-neutral-400 mt-2">
                    Komisi tunai dari pengujian tatap muka yang telah selesai diverifikasi oleh developer.
                </p>
            </div>

            <div class="bg-[#111111] border border-[#2a2a26] p-4 rounded-xl text-left sm:text-right">
                <div class="text-[11px] font-semibold text-neutral-400">Minimal Penarikan</div>
                <div class="text-lg font-black text-[#ffd900] mt-0.5">Rp 20.000</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        {{-- Form Penarikan Dana --}}
        <div class="lg:col-span-7 bg-[#1a1a18] border border-[#2a2a26] rounded-2xl p-6 text-white"
            x-data="{
                amount: @js((int) ($amount ?? 20000)),
                currentBalance: @js((int) $currentBalance),
                setNominal(val) {
                    this.amount = val;
                    $wire.set('amount', val, false);
                },
                withdrawAll() {
                    this.amount = this.currentBalance;
                    $wire.set('amount', this.currentBalance, false);
                },
                formatRupiah(num) {
                    let val = parseInt(num) || 0;
                    return 'Rp ' + val.toLocaleString('id-ID');
                },
                isValid() {
                    let val = parseInt(this.amount) || 0;
                    return val >= 20000 && val <= this.currentBalance;
                }
            }"
        >
            <h3 class="text-base font-bold text-white mb-1">
                Tarik Komisi ke Rekening / E-Wallet
            </h3>
            <p class="text-xs text-neutral-400 mb-6">Pilih nominal dan rekening tujuan untuk mencairkan saldo komisi Anda.</p>

            {{-- Preset Nominal --}}
            <div class="flex items-center justify-between mb-2">
                <label class="text-xs font-semibold text-neutral-300">Pilihan Nominal Cepat</label>
                @if($currentBalance >= 20000)
                    <button type="button" @click="withdrawAll()" class="text-xs font-bold text-[#ffd900] hover:text-[#ffe133] transition-colors flex items-center gap-1.5 cursor-pointer">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        Tarik Semua Saldo (Rp {{ number_format($currentBalance, 0, ',', '.') }})
                    </button>
                @endif
            </div>

            <div class="grid grid-cols-3 gap-2.5 mb-5">
                @foreach($presetOptions as $preset)
                    <button type="button" 
                        @click="setNominal({{ $preset }})" 
                        class="py-2.5 px-3 rounded-xl border text-xs font-bold transition-all text-center cursor-pointer"
                        :class="parseInt(amount) === {{ $preset }} 
                            ? 'bg-[#ffd900] text-black border-[#ffd900] shadow-[0_0_12px_rgba(255,217,0,0.3)]' 
                            : ({{ $preset }} <= currentBalance 
                                ? 'bg-[#111111] text-neutral-200 border-[#2a2a26] hover:border-[#ffd900] hover:text-white' 
                                : 'bg-[#111111]/50 text-neutral-500 border-[#222220] hover:border-neutral-700')">
                        Rp {{ number_format($preset, 0, ',', '.') }}
                    </button>
                @endforeach
            </div>

            {{-- Custom Nominal Input --}}
            <div class="mb-5">
                <div class="flex items-center justify-between mb-1.5">
                    <label class="text-xs font-semibold text-neutral-300">Atau Masukkan Nominal Bebas</label>
                    <span class="text-[11px] text-neutral-400">Min. Rp 20.000</span>
                </div>
                <div class="relative">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-xs font-bold text-neutral-400">Rp</span>
                    <input type="number" 
                        x-model="amount"
                        wire:model="amount"
                        @input="$wire.set('amount', $event.target.value, false)"
                        min="20000" 
                        placeholder="Contoh: 25000" 
                        class="w-full bg-[#111111] border border-[#333330] rounded-xl pl-10 pr-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#ffd900] focus:ring-1 focus:ring-[#ffd900] transition-all">
                </div>
                <template x-if="parseInt(amount) > 0 && parseInt(amount) < 20000">
                    <p class="text-[11px] text-amber-400 mt-1.5 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        Nominal kurang dari batas minimum Rp 20.000
                    </p>
                </template>
                <template x-if="parseInt(amount) > currentBalance">
                    <p class="text-[11px] text-amber-400 mt-1.5 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        Nominal melebihi saldo tersedia (Rp {{ number_format($currentBalance, 0, ',', '.') }})
                    </p>
                </template>
            </div>

            {{-- Metode Penarikan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1.5">Metode Pembayaran Tujuan</label>
                    <select wire:model.live="selectedMethod" class="w-full bg-[#111111] border border-[#333330] rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-[#ffd900]">
                        <option value="bank">Transfer Bank</option>
                        <option value="dana">DANA</option>
                        <option value="gopay">GoPay</option>
                        <option value="ovo">OVO</option>
                        <option value="shopeepay">ShopeePay</option>
                    </select>
                </div>

                @if($selectedMethod === 'bank')
                    <div>
                        <label class="block text-xs font-semibold text-neutral-300 mb-1.5">Nama Bank</label>
                        <select wire:model="bankName" class="w-full bg-[#111111] border border-[#333330] rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-[#ffd900]">
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
                        {{ $selectedMethod === 'bank' ? 'Nama Pemilik Rekening' : 'Nama Pemilik Akun E-Wallet' }}
                    </label>
                    <input type="text" wire:model="accountName" placeholder="Contoh: Budi Santoso" class="w-full bg-[#111111] border border-[#333330] rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-[#ffd900]">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1.5">
                        {{ $selectedMethod === 'bank' ? 'Nomor Rekening' : 'Nomor HP Akun E-Wallet' }}
                    </label>
                    <input type="text" wire:model="accountNumber" placeholder="{{ $selectedMethod === 'bank' ? 'Contoh: 1234567890' : 'Contoh: 081234567890' }}" class="w-full bg-[#111111] border border-[#333330] rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-[#ffd900]">
                </div>
            </div>

            <div class="mt-6 pt-5 border-t border-[#2a2a26] flex items-center justify-between">
                <div>
                    <div class="text-[11px] text-neutral-400">Total Pencairan</div>
                    <div class="text-lg font-black text-[#ffd900]" x-text="formatRupiah(amount)"></div>
                </div>
                <button type="button" wire:click="submitWithdrawal" 
                    :disabled="!isValid()"
                    :class="isValid() ? 'bg-[#ffd900] text-black hover:bg-[#ffe133] shadow-[0_0_16px_rgba(255,217,0,0.25)] cursor-pointer' : 'bg-neutral-800 text-neutral-500 cursor-not-allowed'"
                    class="px-6 py-2.5 rounded-xl font-bold text-xs transition-all">
                    Ajukan Penarikan Dana
                </button>
            </div>
        </div>

        {{-- Riwayat Penarikan --}}
        <div class="lg:col-span-5 bg-[#1a1a18] border border-[#2a2a26] rounded-2xl p-6 text-white">
            <h3 class="text-base font-bold text-white mb-1 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#ffd900]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Riwayat Penarikan Dana
            </h3>
            <p class="text-xs text-neutral-400 mb-4">Status pemrosesan penarikan komisi Anda.</p>

            <div class="space-y-3">
                @forelse($riwayat as $r)
                    <div class="bg-[#111111] border border-[#2a2a26] rounded-xl p-3.5 flex items-center justify-between gap-3">
                        <div>
                            <div class="text-sm font-bold text-white">{{ $r['rupiahF'] }}</div>
                            <div class="text-[11px] text-neutral-400 mt-0.5">Ke {{ $r['metode'] }} &bull; {{ $r['nomorAkun'] }}</div>
                            <div class="text-[10px] text-neutral-500 mt-1">{{ $r['tanggal'] }}</div>
                        </div>
                        <div>
                            @if($r['status'] === 'pending')
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-950/60 text-amber-300 border border-amber-800">
                                    Diproses Admin
                                </span>
                            @elseif(in_array($r['status'], ['approved', 'success', 'selesai']))
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-950/60 text-emerald-300 border border-emerald-800">
                                    Berhasil Ditransfer
                                </span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-neutral-800 text-neutral-400 border border-neutral-700">
                                    Ditolak
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 text-neutral-500">
                        <svg class="w-10 h-10 mx-auto text-neutral-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-xs">Belum ada riwayat penarikan dana.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-filament-panels::page>
