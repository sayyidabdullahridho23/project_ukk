<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pustaka;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['pustaka', 'anggota'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function create($id)
    {
        // Ambil data buku
        $book = Pustaka::findOrFail($id);
        
        // Ambil data anggota yang sedang login
        $anggota = Anggota::where('email', auth()->user()->email)->first();
        
        // Cek apakah user sudah terdaftar sebagai anggota
        if (!$anggota) {
            return redirect()->route('anggota.create')
                ->with('error', 'Anda harus mendaftar sebagai anggota terlebih dahulu.');
        }

        // Cek apakah keanggotaan masih aktif
        if ($anggota->masa_aktif < now()) {
            return redirect()->route('anggota.profile')
                ->with('error', 'Masa keanggotaan Anda telah berakhir. Silakan perpanjang keanggotaan Anda.');
        }

        return view('user.book-borrow', compact('book', 'anggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pustaka' => 'required|exists:tbl_pustaka,id_pustaka',
            'id_anggota' => 'required|exists:tbl_anggota,id_anggota',
            'keterangan' => 'nullable|string|max:50'
        ]);

        // Cek apakah anggota masih memiliki peminjaman aktif
        $activeBorrows = Transaksi::where('id_anggota', $request->id_anggota)
            ->whereNull('tgl_pengembalian')
            ->where('status_approval', 'approved')
            ->count();

        if ($activeBorrows >= 3) {
            return back()->with('error', 'Maaf, Anda telah mencapai batas maksimal peminjaman.');
        }

        // Buat transaksi baru dengan status pending
        $transaksi = Transaksi::create([
            'id_pustaka' => $request->id_pustaka,
            'id_anggota' => $request->id_anggota,
            'tgl_pinjam' => now(),
            'tgl_kembali' => now()->addDays(7),
            'fp' => '0',
            'keterangan' => $request->keterangan,
            'status_approval' => 'pending'
        ]);

        return redirect()->route('home')
            ->with('success', 'Pengajuan peminjaman buku berhasil! Silakan menunggu persetujuan admin.');
    }

    public function pengembalian($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        
        // Update transaksi
        $transaksi->update([
            'tgl_pengembalian' => now(),
            'fp' => '1'
        ]);

        // Update status buku
        $transaksi->pustaka->update(['fp' => '1']);

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }

    // Tambahkan method baru untuk approval
    public function approve($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        
        // Update status transaksi
        $transaksi->update([
            'status_approval' => 'approved'
        ]);

        // Update status buku
        $transaksi->pustaka->update(['fp' => '0']);

        return back()->with('success', 'Peminjaman buku berhasil disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'reject_reason' => 'required|string|max:255'
        ]);

        $transaksi = Transaksi::findOrFail($id);
        
        // Update status transaksi
        $transaksi->update([
            'status_approval' => 'rejected',
            'reject_reason' => $request->reject_reason
        ]);

        // Kembalikan status buku menjadi tersedia
        $transaksi->pustaka->update(['fp' => '1']);

        return back()->with('success', 'Peminjaman buku telah ditolak.');
    }
} 