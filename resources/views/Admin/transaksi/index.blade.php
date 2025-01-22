@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Manajemen Transaksi</h1>
    
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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
            <a href="{{ route('admin.transaksi.create') }}" class="btn btn-primary float-right">Tambah Peminjaman</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal Pinjam</th>
                            <th>Anggota</th>
                            <th>Pustaka</th>
                            <th>Batas Kembali</th>
                            <th>Status</th>
                            <th>Denda</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksis as $transaksi)
                        <tr>
                            <td>{{ $transaksi->tgl_pinjam->format('d/m/Y') }}</td>
                            <td>{{ $transaksi->anggota->nama_anggota }}</td>
                            <td>{{ $transaksi->pustaka->judul_pustaka }}</td>
                            <td>{{ $transaksi->tgl_kembali->format('d/m/Y') }}</td>
                            <td>
                                @if($transaksi->tgl_pengembalian)
                                    <span class="badge badge-success">Dikembalikan</span>
                                @else
                                    <span class="badge badge-{{ Carbon\Carbon::now()->gt($transaksi->tgl_kembali) ? 'danger' : 'warning' }}">
                                        {{ Carbon\Carbon::now()->gt($transaksi->tgl_kembali) ? 'Terlambat' : 'Dipinjam' }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                {{ $transaksi->denda ? 'Rp '.number_format($transaksi->denda, 0, ',', '.') : '-' }}
                            </td>
                            <td>
                                <a href="{{ route('admin.transaksi.show', $transaksi->id_transaksi) }}" 
                                   class="btn btn-info btn-sm">Detail</a>
                                @if(!$transaksi->tgl_pengembalian)
                                    <form action="{{ route('admin.transaksi.pengembalian', $transaksi->id_transaksi) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm" 
                                                onclick="return confirm('Konfirmasi pengembalian buku?')">
                                            Kembalikan
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 