<?php

namespace App\Http\Controllers;

use App\Models\Pustaka;
use App\Models\DDC;
use App\Models\Format;
use App\Models\Penerbit;
use App\Models\Pengarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PustakaController extends Controller
{
    public function index()
    {
        $pustaka = Pustaka::with(['ddc', 'format', 'penerbit', 'pengarang'])->get();
        // dd($pustaka);
        return view('admin.pustaka.index', compact('pustaka'));
    }

    public function create()
    {
        $ddcs = DDC::all();
        $formats = Format::all();
        $penerbits = Penerbit::all();
        $pengarangs = Pengarang::all();
        
        return view('admin.pustaka.create', compact('ddcs', 'formats', 'penerbits', 'pengarangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_ddc' => 'required|exists:tbl_ddc,id_ddc',
            'id_format' => 'required|exists:tbl_format,id_format',
            'id_penerbit' => 'required',
            'id_pengarang' => 'required',
            'isbn' => 'required|string|max:20',
            'judul_pustaka' => 'required|string|max:100',
            'tahun_terbit' => 'required|string|max:4',
            'keyword' => 'required|string|max:50',
            'harga_buku' => 'required|integer',
            'kondisi_buku' => 'required|string|max:15',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarPath = $gambar->storeAs('pustaka', $gambar->hashName(), 'public');
            $gambarPath = basename($gambarPath);
        }

        Pustaka::create([
            'id_ddc' => $request->id_ddc,
            'id_format' => $request->id_format,
            'id_penerbit' => $request->id_penerbit,
            'id_pengarang' => $request->id_pengarang,
            'isbn' => $request->isbn,
            'judul_pustaka' => $request->judul_pustaka,
            'tahun_terbit' => $request->tahun_terbit,
            'keyword' => $request->keyword,
            'keterangan_fisik' => $request->keterangan_fisik,
            'keterangan_tambahan' => $request->keterangan_tambahan,
            'abstraksi' => $request->abstraksi,
            'gambar' => $gambarPath ?? null,
            'harga_buku' => $request->harga_buku,
            'kondisi_buku' => $request->kondisi_buku,
            'fp' => $request->fp ?? '0',
            'jml_pinjam' => 0,
            'denda_terlambat' => $request->denda_terlambat ?? 0,
            'denda_hilang' => $request->denda_hilang ?? 0,
        ]);

        return redirect()->route('admin.pustaka.index')
            ->with('success', 'Pustaka berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pustaka = Pustaka::findOrFail($id);
        $ddcs = DDC::all();
        $formats = Format::all();
        $penerbits = Penerbit::all();
        $pengarangs = Pengarang::all();
        
        return view('admin.pustaka.edit', compact('pustaka', 'ddcs', 'formats', 'penerbits', 'pengarangs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_ddc' => 'required',
            'id_format' => 'required',
            'id_penerbit' => 'required',
            'id_pengarang' => 'required',
            'isbn' => 'required|string|max:20',
            'judul_pustaka' => 'required|string|max:100',
            'tahun_terbit' => 'required|string|max:4',
            'keyword' => 'required|string|max:50',
            'harga_buku' => 'required|integer',
            'kondisi_buku' => 'required|string|max:15',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pustaka = Pustaka::findOrFail($id);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($pustaka->gambar) {
                Storage::disk('public')->delete($pustaka->gambar);
            }
            
            // Upload gambar baru
            $gambar = $request->file('gambar');
            $gambarPath = $gambar->store('pustaka', 'public');
            
            $pustaka->gambar = $gambarPath;
        }

        $pustaka->update([
            'id_ddc' => $request->id_ddc,
            'id_format' => $request->id_format,
            'id_penerbit' => $request->id_penerbit,
            'id_pengarang' => $request->id_pengarang,
            'isbn' => $request->isbn,
            'judul_pustaka' => $request->judul_pustaka,
            'tahun_terbit' => $request->tahun_terbit,
            'keyword' => $request->keyword,
            'keterangan_fisik' => $request->keterangan_fisik,
            'keterangan_tambahan' => $request->keterangan_tambahan,
            'abstraksi' => $request->abstraksi,
            'harga_buku' => $request->harga_buku,
            'kondisi_buku' => $request->kondisi_buku,
            'fp' => $request->fp,
            'denda_terlambat' => $request->denda_terlambat,
            'denda_hilang' => $request->denda_hilang,
        ]);

        return redirect()->route('admin.pustaka.index')
            ->with('success', 'Pustaka berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pustaka = Pustaka::findOrFail($id);
        
        // Hapus file gambar jika ada
        if ($pustaka->gambar) {
            Storage::disk('public')->delete('pustaka/' . $pustaka->gambar);
        }
        
        $pustaka->delete();
        
        return redirect()->route('admin.pustaka.index')
            ->with('success', 'Pustaka berhasil dihapus');
    }
} 