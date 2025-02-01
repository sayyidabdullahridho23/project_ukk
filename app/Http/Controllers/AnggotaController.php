<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\JenisAnggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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
            'foto' => 'nullable|image',
            'username' => 'required|string|max:50|unique:tbl_anggota,username',
            'password' => 'required|string|min:6',
        ]);

        // Handle foto upload
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoName = time().'.'.$request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('avatars'), $fotoName);
            $fotoPath = $fotoName;
        }

        // Check if user exists, if not create new user
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $user = User::create([
                'name' => $request->nama_anggota,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'type' => 0,
                'avatar' => $fotoPath
            ]);
        }

        // Generate kode anggota
        $lastAnggota = Anggota::latest()->first();
        $kodeAnggota = 'ANG-' . date('Y') . '-' . sprintf('%03d', ($lastAnggota ? intval(substr($lastAnggota->kode_anggota, -3)) + 1 : 1));

        // Create new anggota
        $anggota = Anggota::create([
            'id_user' => $user->id,
            'kode_anggota' => $kodeAnggota,
            'id_jenis_anggota' => $request->id_jenis_anggota,
            'nama_anggota' => $request->nama_anggota,
            'tempat' => $request->tempat,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'tgl_daftar' => now(),
            'masa_aktif' => now()->addYear(),
            'fa' => 'T',
            'foto' => $fotoPath,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')
            ->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    public function profile()
    {
        $anggota = Anggota::where('email', auth()->user()->email)->first();
        return view('user.profile-anggota', compact('anggota'));
    }

    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image',
        ]);

        $anggota = Anggota::where('email', auth()->user()->email)->first();

        // Hapus foto lama jika ada
        if ($anggota->foto && file_exists(public_path('avatars/'.$anggota->foto))) {
            unlink(public_path('avatars/'.$anggota->foto));
        }

        // Upload foto baru
        $fotoName = time().'.'.$request->foto->getClientOriginalExtension();
        $request->foto->move(public_path('avatars'), $fotoName);

        // Update database
        $anggota->update(['foto' => $fotoName]);
        
        // Update user avatar juga
        $anggota->user->update(['avatar' => $fotoName]);

        return redirect()->route('anggota.profile')
            ->with('success', 'Foto profil berhasil diperbarui!');
    }
} 