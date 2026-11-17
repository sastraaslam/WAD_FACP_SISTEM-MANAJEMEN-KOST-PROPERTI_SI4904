<?php

namespace App\Http\Controllers;

use App\Models\Penghuni;
use Illuminate\Http\Request;

class PenghuniController extends Controller
{
    // Pengecek: penghuni tidak boleh buka data milik orang lain
    private function cekAkses(Penghuni $penghuni): void
    {
        $user = auth()->user();

        abort_if(
            !$user->isPemilik() && $penghuni->user_id !== $user->id,
            403,
            'Ini bukan data Anda.'
        );
    }

    public function index()
    {
        $user = auth()->user();

        // Pemilik lihat semua, penghuni hanya miliknya
        $penghunis = $user->isPemilik()
            ? Penghuni::latest()->get()
            : Penghuni::where('user_id', $user->id)->latest()->get();

        return view('penghuni.index', compact('penghunis'));
    }

    public function create()
    {
        return view('penghuni.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'          => 'required|string|max:255',
            'nik'           => 'required|digits:16',
            'jk'            => 'required|in:Perempuan,Laki-laki',
            'pekerjaan'     => 'required|string',
            'kontakdarurat' => ['required', 'regex:/^[0-9+\-\s]{8,15}$/'],
        ]);

        // Pemilik data = akun yang sedang login (bukan dari input form)
        $data['user_id'] = auth()->id();

        Penghuni::create($data);

        return redirect()->route('penghuni.index')
            ->with('success', 'Data penghuni berhasil ditambahkan!');
    }

    public function show(Penghuni $penghuni)
    {
        $this->cekAkses($penghuni);

        return view('penghuni.show', compact('penghuni'));
    }

    public function edit(Penghuni $penghuni)
    {
        $this->cekAkses($penghuni);

        return view('penghuni.edit', compact('penghuni'));
    }

    public function update(Request $request, Penghuni $penghuni)
    {
        $this->cekAkses($penghuni);

        $data = $request->validate([
            'nama'          => 'required|string|max:255',
            'nik'           => 'required|digits:16',
            'jk'            => 'required|in:Perempuan,Laki-laki',
            'pekerjaan'     => 'required|string',
            'kontakdarurat' => ['required', 'regex:/^[0-9+\-\s]{8,15}$/'],
        ]);

        $penghuni->update($data);

        return redirect()->route('penghuni.index')
            ->with('success', 'Data penghuni berhasil diperbarui!');
    }

    public function destroy(Penghuni $penghuni)
    {
        $penghuni->delete();

        return redirect()->route('penghuni.index')
            ->with('success', 'Data penghuni berhasil dihapus!');
    }
}