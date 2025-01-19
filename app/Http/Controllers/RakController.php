<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use Illuminate\Http\Request;

class RakController extends Controller
{
    public function index()
    {
        $raks = Rak::all();
        return view('admin.rak.index', compact('raks'));
    }

    public function create()
    {
        return view('admin.rak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_rak' => 'required|unique:tbl_rak,kode_rak|max:10',
            'rak' => 'required|unique:tbl_rak,rak|max:25',
            'keterangan' => 'nullable|max:50'
        ]);

        Rak::create($request->all());
        return redirect()->route('admin.rak.index')->with('success', 'Rak berhasil ditambahkan');
    }

    public function edit(Rak $rak)
    {
        return view('admin.rak.edit', compact('rak'));
    }

    public function update(Request $request, Rak $rak)
    {
        $request->validate([
            'kode_rak' => 'required|unique:tbl_rak,kode_rak,'.$rak->id_rak.',id_rak|max:10',
            'rak' => 'required|unique:tbl_rak,rak,'.$rak->id_rak.',id_rak|max:25',
            'keterangan' => 'nullable|max:50'
        ]);

        $rak->update($request->all());
        return redirect()->route('admin.rak.index')->with('success', 'Rak berhasil diperbarui');
    }

    public function destroy(Rak $rak)
    {
        $rak->delete();
        return redirect()->route('admin.rak.index')->with('success', 'Rak berhasil dihapus');
    }
}