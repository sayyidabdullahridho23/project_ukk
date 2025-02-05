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
        $book = Pustaka::findOrFail($id);
        $anggota = Anggota::where('email', auth()->user()->email)->first();

        if (!$anggota) {
            return redirect()->route('anggota.create')
                ->with('error', 'Anda harus mendaftar sebagai anggota terlebih dahulu.');
        }

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
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date|after_or_equal:tgl_pinjam',
        ]);

        try {
            $transaksi = Transaksi::create([
                'id_pustaka' => $request->id_pustaka,
                'id_anggota' => $request->id_anggota,
                'tgl_pinjam' => $request->tgl_pinjam,
                'tgl_kembali' => $request->tgl_kembali,
                'status_approval' => 'pending',
                'fp' => '0'
            ]);

            $transaksi->pustaka->update(['fp' => '0']);

            return redirect()->route('user.borrowing.history')
                ->with('success', 'Permintaan peminjaman buku berhasil diajukan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengajukan peminjaman.');
        }
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

    public function pengembalian($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        
        // Update the return date and status
        $transaksi->update([
            'tgl_pengembalian' => now(),
            'fp' => '1', // Mark the book as available
            'status_pengembalian' => 'completed'
        ]);

        // Update the status of the associated book
        $transaksi->pustaka->update(['fp' => '1']);

        return back()->with('success', 'Pengembalian buku berhasil dikonfirmasi.');
    }

    public function borrowingHistory()
    {
        $anggota = Anggota::where('email', auth()->user()->email)->first();
        $transaksis = Transaksi::with('pustaka')
            ->where('id_anggota', $anggota->id_anggota)
            ->orderBy('tgl_pinjam', 'desc')
            ->get();

        return view('user.borrowing-history', compact('transaksis'));
    }

    // Other methods...
}