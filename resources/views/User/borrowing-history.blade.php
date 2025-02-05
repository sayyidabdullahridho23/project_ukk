@extends('layouts.user')

@section('content')
<div class="container">
    <h2 class="mb-4">History Peminjaman Buku</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Transaksi</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $transaksi)
                <tr>
                    <td>TRX-{{ str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $transaksi->pustaka->judul_pustaka }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaksi->tgl_pinjam)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaksi->tgl_kembali)->format('d/m/Y') }}</td>
                    <td>
                        @if($transaksi->status_approval == 'pending')
                            <span class="badge bg-warning">Menunggu Persetujuan</span>
                        @elseif($transaksi->status_approval == 'approved' && !$transaksi->tgl_pengembalian)
                            <span class="badge bg-warning">Dipinjam</span>
                        @elseif($transaksi->status_approval == 'approved' && $transaksi->tgl_pengembalian)
                            <span class="badge bg-success">Dikembalikan</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
