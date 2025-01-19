<?php

namespace App\Http\Controllers;

use App\Models\DDC;
use App\Models\Rak;
use Illuminate\Http\Request;

class DDCController extends Controller
{
    public function index()
    {
        $ddcs = DDC::with('rak')->get();
        return view('admin.ddc.index', compact('ddcs'));
    }

    public function create()
    {
        $raks = Rak::all();
        return view('admin.ddc.create', compact('raks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_rak' => 'required|exists:tbl_rak,id_rak',
            'kode_ddc' => 'required|unique:tbl_ddc,kode_ddc|max:10',
            'ddc' => 'required|unique:tbl_ddc,ddc|max:100',
            'keterangan' => 'nullable|max:100'
        ]);

        DDC::create($request->all());
        return redirect()->route('admin.ddc.index')->with('success', 'DDC berhasil ditambahkan');
    }

    public function edit(DDC $ddc)
    {
        $raks = Rak::all();
        return view('admin.ddc.edit', compact('ddc', 'raks'));
    }

    public function update(Request $request, DDC $ddc)
    {
        $request->validate([
            'id_rak' => 'required|exists:tbl_rak,id_rak',
            'kode_ddc' => 'required|unique:tbl_ddc,kode_ddc,'.$ddc->id_ddc.',id_ddc|max:10',
            'ddc' => 'required|unique:tbl_ddc,ddc,'.$ddc->id_ddc.',id_ddc|max:100',
            'keterangan' => 'nullable|max:100'
        ]);

        $ddc->update($request->all());
        return redirect()->route('admin.ddc.index')->with('success', 'DDC berhasil diperbarui');
    }

    public function destroy(DDC $ddc)
    {
        $ddc->delete();
        return redirect()->route('admin.ddc.index')->with('success', 'DDC berhasil dihapus');
    }
}