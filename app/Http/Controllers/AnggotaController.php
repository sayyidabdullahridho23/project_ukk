<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\JenisAnggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AnggotaController extends Controller
{
    public function create()
    {
        $jenisAnggota = JenisAnggota::all();
        return view('User.daftar-anggota', compact('jenisAnggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_anggota' => 'required|string|max:50|unique:tbl_anggota',
            'id_jenis_anggota' => 'required|exists:tbl_jenis_anggota,id_jenis_anggota',
            'tempat' => 'required|string|max:20',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string|max:50',
            'no_telp' => 'required|string|max:15',
            'email' => 'required|email|max:30',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'username' => 'required|string|max:50|unique:tbl_anggota',
            'password' => 'required|string|min:6|max:50',
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('anggota-photos', 'public');
        }

        // Generate kode anggota (contoh: ANG-2024-0001)
        $tahun = date('Y');
        $lastAnggota = Anggota::whereYear('created_at', $tahun)->latest()->first();
        $urutan = $lastAnggota ? intval(substr($lastAnggota->kode_anggota, -4)) + 1 : 1;
        $kodeAnggota = 'ANG-' . $tahun . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);

        Anggota::create([
            'kode_anggota' => $kodeAnggota,
            'id_jenis_anggota' => $request->id_jenis_anggota,
            'nama_anggota' => $request->nama_anggota,
            'tempat' => $request->tempat,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'tgl_daftar' => Carbon::now(),
            'masa_aktif' => Carbon::now()->addYear(),
            'fa' => 'T',
            'foto' => $foto,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('home')
            ->with('success', 'Pendaftaran anggota berhasil! Silahkan menunggu verifikasi dari admin.');
    }
} 