<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = kategori::paginate(25);
        return view('kategoris.index', compact('kategori'));
    }

    public function add()
    {
        return view('kategoris.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'keterangan' => 'required',
        ]);

        kategori::create($request->except('id'));

        return redirect()->route('kategoris.index')->with('success', 'Data kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategori = kategori::findOrFail($id);
        return view('kategoris.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'keterangan' => 'required',
        ]);

        $kategori = kategori::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('kategoris.index')->with('success', 'Data kategori berhasil diperbarui');
    }

    public function delete($id)
    {
        $kategori = kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategoris.index')->with('success', 'Data kategori berhasil dihapus');
    }
}