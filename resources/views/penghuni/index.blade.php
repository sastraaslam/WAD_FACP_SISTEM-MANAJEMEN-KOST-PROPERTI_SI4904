@extends('layouts.app')

@section('title', 'Data Penghuni')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold">Data Penghuni</h1>
        <a href="{{ route('penghuni.create') }}"
           class="bg-green-600 text-white py-2 px-6 rounded-full hover:bg-green-700">
            Tambah Penghuni
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">NIK</th>
                    <th class="p-3">Jenis Kelamin</th>
                    <th class="p-3">Pekerjaan</th>
                    <th class="p-3">Kontak Darurat</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($penghunis as $penghuni)
                    <tr class="border-t">
                        <td class="p-3">{{ $loop->iteration }}</td>
                        <td class="p-3">{{ $penghuni->nama }}</td>
                        <td class="p-3">{{ $penghuni->nik }}</td>
                        <td class="p-3">{{ $penghuni->jk }}</td>
                        <td class="p-3">{{ Str::limit($penghuni->pekerjaan, 40) }}</td>
                        <td class="p-3">{{ $penghuni->kontakdarurat }}</td>
                        <td class="p-3">
                            <div class="flex items-center gap-4 text-sm">
                                <a href="{{ route('penghuni.show', $penghuni) }}" class="text-blue-600 hover:underline">Detail</a>
                                <a href="{{ route('penghuni.edit', $penghuni) }}" class="text-yellow-600 hover:underline">Edit</a>
                                @if(auth()->user()->isPemilik())
                                    <form action="{{ route('penghuni.destroy', $penghuni) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-6 text-center text-gray-500">Belum ada data penghuni.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection