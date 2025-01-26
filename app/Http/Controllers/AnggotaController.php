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
        // Cek apakah user sudah terdaftar sebagai anggota
        $existingAnggota = Anggota::where('email', auth()->user()->email)->first();
        if ($existingAnggota) {
            return redirect()->route('anggota.profile')
                ->with('info', 'Anda sudah terdaftar sebagai anggota.');
        }

        $jenisAnggota = JenisAnggota::all();
        return view('user.daftar-anggota', compact('jenisAnggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_anggota' => 'required|string|max:50',
            'id_jenis_anggota' => 'required|exists:tbl_jenis_anggota,id_jenis_anggota',
            'tempat' => 'required|string|max:20',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string|max:50',
            'no_telp' => 'required|string|max:15',
            'email' => 'required|email|max:30|unique:tbl_anggota,email',
            'foto' => 'nullable|image|max:2048',
            'username' => 'required|string|max:50|unique:tbl_anggota,username',
            'password' => 'required|string|min:6',
        ]);

        // Generate kode anggota (contoh: ANG-2024-001)
        $tahun = date('Y');
        $lastAnggota = Anggota::whereYear('created_at', $tahun)->latest()->first();
        $sequence = $lastAnggota ? intval(substr($lastAnggota->kode_anggota, -3)) + 1 : 1;
        $kodeAnggota = 'ANG-' . $tahun . '-' . str_pad($sequence, 3, '0', STR_PAD_LEFT);

        // Handle upload foto
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->hashName(); // Hanya mengambil nama file
            $foto->storeAs('public/foto', $fotoPath); // Simpan di folder foto
        }

        // Set tanggal daftar dan masa aktif
        $tglDaftar = Carbon::now();
        $masaAktif = $tglDaftar->copy()->addYear();

        Anggota::create([
            'kode_anggota' => $kodeAnggota,
            'id_jenis_anggota' => $request->id_jenis_anggota,
            'nama_anggota' => $request->nama_anggota,
            'tempat' => $request->tempat,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'tgl_daftar' => $tglDaftar,
            'masa_aktif' => $masaAktif,
            'fa' => 'T',
            'foto' => $fotoPath,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('anggota.profile')
            ->with('success', 'Pendaftaran anggota berhasil!');
    }

    public function profile()
    {
        $anggota = Anggota::where('email', auth()->user()->email)->first();
        return view('user.profile-anggota', compact('anggota'));
    }

    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|max:2048',
        ]);

        $anggota = Anggota::where('email', auth()->user()->email)->first();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($anggota->foto && file_exists(public_path('foto/' . $anggota->foto))) {
                unlink(public_path('foto/' . $anggota->foto));
            }

            // Upload foto baru
            $foto = $request->file('foto');
            $fotoPath = $foto->hashName();
            $foto->storeAs('public/foto', $fotoPath);

            // Update database
            $anggota->update([
                'foto' => $fotoPath
            ]);
        }

        return redirect()->route('anggota.profile')
            ->with('success', 'Foto profil berhasil diperbarui!');
    }
} 