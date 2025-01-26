<?php

namespace App\Http\Controllers;

use App\Models\Perpustakaan;
use Illuminate\Http\Request;

class PerpustakaanController extends Controller
{
    public function index()
    {
        $perpustakaan = Perpustakaan::first();
        return view('admin.perpustakaan.index', compact('perpustakaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perpustakaan' => 'required|string|max:50|unique:tbl_perpustakaan',
            'nama_pustakawan' => 'required|string|max:50',
            'alamat' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:tbl_perpustakaan',
            'website' => 'nullable|string|max:50',
            'no_telp' => 'required|string|max:15',
            'keterangan' => 'nullable|string|max:50'
        ]);

        Perpustakaan::create($request->all());
        return redirect()->route('admin.perpustakaan.index')
            ->with('success', 'Profil perpustakaan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $perpustakaan = Perpustakaan::findOrFail($id);
        
        $request->validate([
            'nama_perpustakaan' => 'required|string|max:50|unique:tbl_perpustakaan,nama_perpustakaan,'.$id.',id_perpustakaan',
            'nama_pustakawan' => 'required|string|max:50',
            'alamat' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:tbl_perpustakaan,email,'.$id.',id_perpustakaan',
            'website' => 'nullable|string|max:50',
            'no_telp' => 'required|string|max:15',
            'keterangan' => 'nullable|string|max:50'
        ]);

        $perpustakaan->update($request->all());
        return redirect()->route('admin.perpustakaan.index')
            ->with('success', 'Profil perpustakaan berhasil diperbarui!');
    }

    public function show()
    {
        $perpustakaan = Perpustakaan::first();
        return view('User.perpustakaan', compact('perpustakaan'));
    }
} 