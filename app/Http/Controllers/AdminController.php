<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Anggota;
use App\Models\Pustaka;
use App\Models\Transaksi;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\DDC;
use App\Models\Rak;
use App\Models\Format;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboardAdmin()
    {
        $dailyRegistrations = [];
        
        // Get registrations for last 7 days
        for($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = User::whereDate('created_at', $date)->count();
            $dailyRegistrations[] = $count;
        }

        return view('Admin.adminHome', compact('dailyRegistrations'));
    }

    public function profileAdmin(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function index()
    {
        // Get total earnings from late returns
        $totalDenda = Transaksi::whereNotNull('tgl_pengembalian')
            ->where('tgl_pengembalian', '>', 'tgl_kembali')
            ->get()
            ->sum(function ($transaksi) {
                $tglKembali = Carbon::parse($transaksi->tgl_kembali);
                $tglPengembalian = Carbon::parse($transaksi->tgl_pengembalian);
                $daysLate = $tglPengembalian->diffInDays($tglKembali);
                return $daysLate * $transaksi->pustaka->denda_terlambat;
            });

        // Get total active members
        $totalAnggota = Anggota::where('masa_aktif', '>=', now())->count();
        
        // Get new members this month
        $newAnggotaThisMonth = Anggota::whereMonth('tgl_daftar', now()->month)
            ->whereYear('tgl_daftar', now()->year)
            ->count();
        
        // Get total active loans
        $activePinjaman = Transaksi::where('status_approval', 'approved')
            ->whereNull('tgl_pengembalian')
            ->count();

        // Get daily registrations for the last 7 days
        $dailyRegistrations = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $count = Anggota::whereDate('tgl_daftar', $date)->count();
            $dailyRegistrations[] = $count;
        }

        // Additional statistics for cards
        $statistics = [
            'total_books' => Pustaka::count(),
            'total_publishers' => Penerbit::count(),
            'total_authors' => Pengarang::count(),
            'total_categories' => DDC::count(),
            'total_racks' => Rak::count(),
            'total_formats' => Format::count(),
        ];

        return view('admin.adminHome', compact(
            'totalDenda',
            'totalAnggota',
            'newAnggotaThisMonth',
            'activePinjaman',
            'dailyRegistrations',
            'statistics'
        ));
    }
}


