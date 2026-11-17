@extends('layouts.app')

@section('title', 'Detail Penghuni')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">
        <h1 class="text-3xl font-bold mb-6">{{ $penghuni->nama }}</h1>

        <dl class="space-y-3">
            <div>
                <dt class="text-sm text-gray-500">Nomor Identitas (KTP)</dt>
                <dd class="font-semibold">{{ $penghuni->nik }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">Jenis Kelamin</dt>
                <dd class="font-semibold">{{ $penghuni->jk }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">Pekerjaan</dt>
                <dd class="font-semibold whitespace-pre-line">{{ $penghuni->pekerjaan }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">Nomor Kontak Darurat</dt>
                <dd class="font-semibold">{{ $penghuni->kontakdarurat }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">Dibuat pada</dt>
                <dd>{{ $penghuni->created_at->format('d M Y, H:i') }}</dd>
            </div>
        </dl>

        <a href="{{ route('penghuni.index') }}"
           class="inline-block mt-6 bg-gray-300 py-2 px-6 rounded-full hover:bg-gray-400">Kembali</a>
    </div>
@endsection