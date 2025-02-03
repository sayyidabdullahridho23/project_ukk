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
        // Debug data yang akan disimpan
        \Log::info('Data transaksi yang akan disimpan:', [
            'id_pustaka' => $request->id_pustaka,
            'id_anggota' => $request->id_anggota,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali
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

            // Debug transaksi yang tersimpan
            \Log::info('Transaksi berhasil disimpan:', $transaksi->toArray());

            // Update status buku menjadi dipinjam
            $transaksi->pustaka->update(['fp' => '0']);

            return redirect()->route('User.home')
                ->with('success', 'Permintaan peminjaman buku berhasil diajukan.');
        } catch (\Exception $e) {
            \Log::error('Error saat menyimpan transaksi: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengajukan peminjaman.');
        }
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

    public function userHistory()
    {
        $anggota = auth()->user()->anggota;
        
        if (!$anggota) {
            return redirect()->route('anggota.create')
                ->with('error', 'Anda harus mendaftar sebagai anggota terlebih dahulu.');
        }

        // Debug query SQL
        \Log::info('Query SQL:', [
            'sql' => Transaksi::where('id_anggota', $anggota->id_anggota)->toSql(),
            'bindings' => ['id_anggota' => $anggota->id_anggota]
        ]);

        // Debug hasil query
        $rawTransaksi = Transaksi::where('id_anggota', $anggota->id_anggota)->get();
        \Log::info('Jumlah transaksi:', ['count' => $rawTransaksi->count()]);
        \Log::info('Data transaksi:', $rawTransaksi->toArray());

        $transactions = Transaksi::with(['pustaka', 'pustaka.pengarang'])
            ->where('id_anggota', $anggota->id_anggota)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('user.borrowing-history', compact('transactions'));
    }
} 