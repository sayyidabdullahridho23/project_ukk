@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Detail Transaksi</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="mb-3">Informasi Peminjaman</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="150">Tanggal Pinjam</td>
                                    <td>: {{ $transaksi->tgl_pinjam->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Batas Kembali</td>
                                    <td>: {{ $transaksi->tgl_kembali->format('d/m/Y') }}</td>
                                </tr>
                                @if($transaksi->tgl_pengembalian)
                                <tr>
                                    <td>Tanggal Kembali</td>
                                    <td>: {{ $transaksi->tgl_pengembalian->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Denda</td>
                                    <td>: Rp {{ number_format($transaksi->denda, 0, ',', '.') }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td>Status</td>
                                    <td>: 
                                        @if($transaksi->tgl_pengembalian)
                                            <span class="badge badge-success">Dikembalikan</span>
                                        @else
                                            <span class="badge badge-{{ Carbon\Carbon::now()->gt($transaksi->tgl_kembali) ? 'danger' : 'warning' }}">
                                                {{ Carbon\Carbon::now()->gt($transaksi->tgl_kembali) ? 'Terlambat' : 'Dipinjam' }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <h6 class="mb-3">Informasi Anggota</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="150">Kode Anggota</td>
                                    <td>: {{ $transaksi->anggota->kode_anggota }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>: {{ $transaksi->anggota->nama_anggota }}</td>
                                </tr>
                                <tr>
                                    <td>No. HP</td>
                                    <td>: {{ $transaksi->anggota->no_hp }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>: {{ $transaksi->anggota->email }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="mb-3">Informasi Pustaka</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="150">Kode Pustaka</td>
                                    <td>: {{ $transaksi->pustaka->kode_pustaka }}</td>
                                </tr>
                                <tr>
                                    <td>Judul</td>
                                    <td>: {{ $transaksi->pustaka->judul_pustaka }}</td>
                                </tr>
                                <tr>
                                    <td>Penerbit</td>
                                    <td>: {{ $transaksi->pustaka->penerbit->nama_penerbit }}</td>
                                </tr>
                                <tr>
                                    <td>Pengarang</td>
                                    <td>: {{ $transaksi->pustaka->pengarang->nama_pengarang }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($transaksi->keterangan)
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h6 class="mb-2">Keterangan:</h6>
                            <p>{{ $transaksi->keterangan }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary">Kembali</a>
                        @if(!$transaksi->tgl_pengembalian)
                            <form action="{{ route('admin.transaksi.pengembalian', $transaksi->id_transaksi) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success" 
                                        onclick="return confirm('Konfirmasi pengembalian buku?')">
                                    Kembalikan Buku
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 

<!-- Di bagian head -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

<!-- Di bagian scripts -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> 