@extends('layouts.app')

@section('title', 'Edit Penghuni')

@section('content')
    <div class="max-w-xl mx-auto">
        <h1 class="text-3xl font-semibold mb-6">Edit Penghuni</h1>

        <form action="{{ route('penghuni.update', $penghuni) }}" method="POST" class="bg-white p-6 rounded-lg shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama" class="block font-medium mb-2">Nama</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $penghuni->nama) }}"
                       class="w-full p-3 border rounded-lg">
                @error('nama')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nik" class="block font-medium mb-2">Nomor Identitas (KTP)</label>
                <input type="text" name="nik" id="nik" maxlength="16" inputmode="numeric"
                       value="{{ old('nik', $penghuni->nik) }}" class="w-full p-3 border rounded-lg">
                @error('nik')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jk" class="block font-medium mb-2">Jenis Kelamin</label>
                <select name="jk" id="jk" class="w-full p-3 border rounded-lg">
                    <option value="">-- Pilih --</option>
                    <option value="Perempuan" {{ old('jk', $penghuni->jk) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    <option value="Laki-laki" {{ old('jk', $penghuni->jk) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                </select>
                @error('jk')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="pekerjaan" class="block font-medium mb-2">Pekerjaan</label>
                <textarea name="pekerjaan" id="pekerjaan" rows="3"
                          class="w-full p-3 border rounded-lg">{{ old('pekerjaan', $penghuni->pekerjaan) }}</textarea>
                @error('pekerjaan')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="kontakdarurat" class="block font-medium mb-2">Nomor Kontak Darurat</label>
                <input type="text" name="kontakdarurat" id="kontakdarurat" inputmode="tel"
                       value="{{ old('kontakdarurat', $penghuni->kontakdarurat) }}" class="w-full p-3 border rounded-lg">
                @error('kontakdarurat')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <a href="{{ route('penghuni.index') }}"
                   class="bg-gray-300 py-2 px-6 rounded-full hover:bg-gray-400">Kembali</a>
                <button type="submit"
                        class="bg-green-500 text-white py-2 px-6 rounded-full hover:bg-green-600">Update</button>
            </div>
        </form>
    </div>
@endsection