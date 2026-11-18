@extends('layouts.app')

@section('title', 'Data Penghuni')

@section('content')
    {{-- Header --}}
    <div class="flex flex-wrap items-start justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight">Data penghuni</h1>
            <p class="text-slate-500 mt-2">Pantau dan kelola seluruh profil penghuni kos Anda.</p>
        </div>
        <a href="{{ route('penghuni.create') }}"
           class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white font-semibold px-5 py-3 rounded-xl shadow-lg shadow-brand-600/25 transition">
            <span class="text-lg leading-none">+</span> Tambah penghuni
        </a>
    </div>

    {{-- Kartu statistik --}}
    @php
        $cards = [
            ['PENGHUNI', $stats['total'],     'orang',    'Total penghuni terdaftar',     'bg-indigo-50 text-indigo-500', 'M15 19a4 4 0 0 0-8 0M11 13a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z'],
            ['LAKI-LAKI', $stats['laki'],     'orang',    'Penghuni laki-laki',           'bg-brand-50 text-brand-600',  'M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm-7 9a7 7 0 0 1 14 0'],
            ['PEREMPUAN', $stats['perempuan'],'orang',    'Penghuni perempuan',           'bg-orange-50 text-orange-500','M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm-7 9a7 7 0 0 1 14 0'],
            ['PEKERJAAN', $stats['pekerjaan'],'jenis',    'Variasi pekerjaan penghuni',   'bg-amber-50 text-amber-500',  'M9 7V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2M4 7h16v12H4V7Z'],
        ];
    @endphp
    <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
        @foreach ($cards as [$label, $angka, $satuan, $ket, $warna, $ikon])
            <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm">
                <div class="flex items-start justify-between mb-5">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center {{ $warna }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $ikon }}"/></svg>
                    </div>
                    <span class="text-[10px] tracking-[0.15em] font-bold text-slate-400">{{ $label }}</span>
                </div>
                <div class="text-3xl font-extrabold">{{ $angka }} <span class="text-base font-semibold text-slate-500">{{ $satuan }}</span></div>
                <div class="text-xs text-slate-400 mt-2">{{ $ket }}</div>
            </div>
        @endforeach
    </div>

    {{-- Daftar --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-6 pb-5">
            <div class="flex items-start justify-between mb-5">
                <div>
                    <h2 class="text-lg font-bold">Daftar penghuni</h2>
                    <p class="text-xs text-slate-400 mt-1">Semua penghuni yang tercatat di properti Anda.</p>
                </div>
                <span class="text-xs font-semibold text-slate-500 bg-slate-100 rounded-lg px-3 py-1.5">{{ $penghunis->count() }} penghuni</span>
            </div>

            <form method="GET" action="{{ route('penghuni.index') }}" class="flex flex-wrap gap-3">
                <div class="flex-1 min-w-[220px] relative">
                    <svg class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path stroke-linecap="round" d="m20 20-3.5-3.5"/></svg>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama atau NIK..."
                           class="w-full bg-white border border-slate-200 rounded-xl pl-11 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500">
                </div>
                <select name="jk" class="border border-slate-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/40">
                    <option value="">Semua jenis kelamin</option>
                    <option value="Laki-laki" @selected(request('jk') === 'Laki-laki')>Laki-laki</option>
                    <option value="Perempuan" @selected(request('jk') === 'Perempuan')>Perempuan</option>
                </select>
                <button type="submit" class="border border-slate-200 rounded-xl px-6 py-3 text-sm font-bold hover:bg-slate-50">Terapkan</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/70">
                    <tr class="text-[11px] tracking-[0.12em] font-bold text-slate-400">
                        <th class="px-6 py-4">PENGHUNI</th>
                        <th class="px-4 py-4">NIK</th>
                        <th class="px-4 py-4">JENIS KELAMIN</th>
                        <th class="px-4 py-4">PEKERJAAN</th>
                        <th class="px-4 py-4">KONTAK DARURAT</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penghunis as $penghuni)
                        <tr class="border-t border-slate-100 hover:bg-slate-50/50">
                            <td class="px-6 py-5">
                                <div class="font-bold">{{ $penghuni->nama }}</div>
                                <div class="text-xs text-slate-400 mt-1">Ditambahkan {{ $penghuni->created_at->translatedFormat('d M Y') }}</div>
                            </td>
                            <td class="px-4 py-5 text-sm text-slate-600">{{ $penghuni->nik }}</td>
                            <td class="px-4 py-5">
                                <span class="text-xs font-semibold rounded-lg px-3 py-1.5
                                    {{ $penghuni->jk === 'Laki-laki' ? 'bg-brand-50 text-brand-700' : 'bg-orange-50 text-orange-600' }}">
                                    {{ $penghuni->jk }}
                                </span>
                            </td>
                            <td class="px-4 py-5 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($penghuni->pekerjaan, 30) }}</td>
                            <td class="px-4 py-5 text-sm text-slate-600">{{ $penghuni->kontakdarurat }}</td>
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-end gap-3 text-slate-400">
                                    <a href="{{ route('penghuni.show', $penghuni) }}" title="Detail" class="hover:text-brand-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </a>
                                    <a href="{{ route('penghuni.edit', $penghuni) }}" title="Edit" class="hover:text-amber-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5Z"/></svg>
                                    </a>
                                    @if (auth()->user()->isPemilik())
                                        <form action="{{ route('penghuni.destroy', $penghuni) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus" class="hover:text-red-600">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M8 6V4h8v2M6 6l1 14h10l1-14M10 11v5M14 11v5"/></svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-10 text-center text-slate-400 text-sm">Belum ada data penghuni.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection