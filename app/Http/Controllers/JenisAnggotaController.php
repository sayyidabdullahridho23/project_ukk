<?php

namespace App\Http\Controllers;

use App\Models\JenisAnggota;
use Illuminate\Http\Request;

class JenisAnggotaController extends Controller
{
    public function index()
    {
        $jenisAnggota = JenisAnggota::all();
        return view('admin.jenis-anggota.index', compact('jenisAnggota'));
    }

    public function create()
    {
        return view('admin.jenis-anggota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_jenis_anggota' => 'required|unique:tbl_jenis_anggota',
            'jenis_anggota' => 'required',
            'max_pinjam' => 'required|numeric',
            'keterangan' => 'nullable'
        ]);

        JenisAnggota::create($request->all());

        return redirect()->route('admin.jenis-anggota.index')
            ->with('success', 'Jenis anggota berhasil ditambahkan.');
    }

    public function edit($jenisAnggota)
    {
        $jenisAnggota = JenisAnggota::find($jenisAnggota);
        
        return view('admin.jenis-anggota.edit', compact('jenisAnggota'));

    }

    public function update(Request $request, JenisAnggota $jenisAnggota)
    {
        $request->validate([
            'kode_jenis_anggota' => 'required|unique:tbl_jenis_anggota,kode_jenis_anggota,' . $jenisAnggota->id_jenis_anggota . ',id_jenis_anggota',
            'jenis_anggota' => 'required',
            'max_pinjam' => 'required|numeric',
            'keterangan' => 'nullable'
        ]);

        $jenisAnggota->update($request->all());

        return redirect()->route('admin.jenis-anggota.index')
            ->with('success', 'Jenis anggota berhasil diperbarui.');
    }

    public function destroy( $jenisAnggota)
    {
        $jenisAnggota = JenisAnggota::find($jenisAnggota);
        if ($jenisAnggota->anggota()-> count()   > 0) {
            return redirect()->back()
            ->with('danger', 'Jenis anggota gagal dihapus.'); 
        }
        $jenisAnggota->delete();

        return redirect()->route('admin.jenis-anggota.index')
            ->with('success', 'Jenis anggota berhasil dihapus.');
    }
} 