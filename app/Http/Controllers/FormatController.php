<?php

namespace App\Http\Controllers;

use App\Models\Format;
use Illuminate\Http\Request;

class FormatController extends Controller
{
    public function index()
    {
        $formats = Format::all();
        return view('admin.format.index', compact('formats'));
    }

    public function create()
    {
        return view('admin.format.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_format' => 'required|unique:tbl_format,kode_format|max:10',
            'format' => 'required|unique:tbl_format,format|max:25',
            'keterangan' => 'nullable|max:50'
        ]);

        Format::create($request->all());
        return redirect()->route('admin.format.index')->with('success', 'Format berhasil ditambahkan');
    }

    public function edit(Format $format)
    {
        return view('admin.format.edit', compact('format'));
    }

    public function update(Request $request, Format $format)
    {
        $request->validate([
            'kode_format' => 'required|unique:tbl_format,kode_format,'.$format->id_format.',id_format|max:10',
            'format' => 'required|unique:tbl_format,format,'.$format->id_format.',id_format|max:25',
            'keterangan' => 'nullable|max:50'
        ]);

        $format->update($request->all());
        return redirect()->route('admin.format.index')->with('success', 'Format berhasil diperbarui');
    }

    public function destroy(Format $format)
    {
        $format->delete();
        return redirect()->route('admin.format.index')->with('success', 'Format berhasil dihapus');
    }
}