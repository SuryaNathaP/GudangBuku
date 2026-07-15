<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\kategori;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        // Eager load category to prevent N+1 query issue
        $bukus = Buku::with('kategori')->paginate(25);
        return view('bukus.index', compact('bukus'));
    }

    public function add()
    {
        $kategoris = kategori::all();
        return view('bukus.add', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|numeric',
            'rak' => 'required',
        ]);

        Buku::create($request->except('id'));

        return redirect()->route('bukus.index')->with('success', 'Data buku berhasil ditambahkan');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = kategori::all();
        return view('bukus.edit', compact('buku', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|numeric',
            'rak' => 'required',
        ]);

        $buku = Buku::findOrFail($id);
        $buku->update($request->all());

        return redirect()->route('bukus.index')->with('success', 'Data buku berhasil diperbarui');
    }

    public function delete($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect()->route('bukus.index')->with('success', 'Data buku berhasil dihapus');
    }
}
