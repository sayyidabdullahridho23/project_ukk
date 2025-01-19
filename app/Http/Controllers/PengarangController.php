<?php

namespace App\Http\Controllers;

use App\Models\Pengarang;
use Illuminate\Http\Request;

class PengarangController extends Controller
{
    public function index()
    {
        $pengarangs = Pengarang::all();
        return view('admin.pengarang.index', compact('pengarangs'));
    }

    public function create()
    {
        return view('admin.pengarang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_pengarang' => 'required|unique:tbl_pengarang,kode_pengarang|max:10',
            'gelar_depan' => 'nullable|max:10',
            'nama_pengarang' => 'required|unique:tbl_pengarang,nama_pengarang|max:50',
            'gelar_belakang' => 'nullable|max:10',
            'no_telp' => 'required|max:15',
            'email' => 'nullable|email|max:30',
            'website' => 'nullable|max:50',
            'biografi' => 'nullable',
            'keterangan' => 'nullable|max:50'
        ]);

        Pengarang::create($request->all());
        return redirect()->route('admin.pengarang.index')->with('success', 'Pengarang berhasil ditambahkan');
    }

    public function edit(Pengarang $pengarang)
    {
        return view('admin.pengarang.edit', compact('pengarang'));
    }

    public function update(Request $request, Pengarang $pengarang)
    {
        $request->validate([
            'kode_pengarang' => 'required|unique:tbl_pengarang,kode_pengarang,'.$pengarang->id_pengarang.',id_pengarang|max:10',
            'gelar_depan' => 'nullable|max:10',
            'nama_pengarang' => 'required|unique:tbl_pengarang,nama_pengarang,'.$pengarang->id_pengarang.',id_pengarang|max:50',
            'gelar_belakang' => 'nullable|max:10',
            'no_telp' => 'required|max:15',
            'email' => 'nullable|email|max:30',
            'website' => 'nullable|max:50',
            'biografi' => 'nullable',
            'keterangan' => 'nullable|max:50'
        ]);

        $pengarang->update($request->all());
        return redirect()->route('admin.pengarang.index')->with('success', 'Pengarang berhasil diperbarui');
    }

    public function destroy(Pengarang $pengarang)
    {
        $pengarang->delete();
        return redirect()->route('admin.pengarang.index')->with('success', 'Pengarang berhasil dihapus');
    }
}