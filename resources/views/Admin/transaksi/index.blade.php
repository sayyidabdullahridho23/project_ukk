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
            <h6 class="m-0 font-weight-bold text-primary">Data Transaksi Peminjaman</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode Transaksi</th>
                            <th>Anggota</th>
                            <th>Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                            <th>Denda</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksis as $t)
                        <tr>
                            <td>TRX-{{ str_pad($t->id_transaksi, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                {{ $t->anggota->nama_anggota }}<br>
                                <small class="text-muted">{{ $t->anggota->kode_anggota }}</small>
                            </td>
                            <td>
                                {{ $t->pustaka->judul_pustaka }}<br>
                                <small class="text-muted">ISBN: {{ $t->pustaka->isbn }}</small>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($t->tgl_pinjam)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($t->tgl_kembali)->format('d/m/Y') }}</td>
                            <td>
                                @if($t->status_approval == 'pending')
                                    <span class="badge bg-warning">Menunggu Persetujuan</span>
                                @elseif($t->status_approval == 'approved')
                                    @if(!$t->tgl_pengembalian)
                                        @if(\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($t->tgl_kembali)))
                                            <span class="badge bg-danger">Terlambat</span>
                                        @else
                                            <span class="badge bg-info">Dipinjam</span>
                                        @endif
                                    @else
                                        <span class="badge bg-success">Dikembalikan</span>
                                    @endif
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $denda = 0;
                                    if ($t->kondisi_buku == 'Rusak') {
                                        $denda = $t->denda_rusak; // Ambil denda rusak
                                    }
                                    if ($t->kondisi_buku == 'Hilang') {
                                        $denda += $t->pustaka->denda_hilang; // Ambil denda hilang
                                    }
                                    if(!$t->tgl_pengembalian) {
                                        $tglKembali = \Carbon\Carbon::parse($t->tgl_kembali);
                                        if($tglKembali->lt(\Carbon\Carbon::now())) {
                                            $denda += $tglKembali->diffInDays(\Carbon\Carbon::now()) * $t->pustaka->denda_terlambat;
                                        }
                                    }
                                @endphp
                                Rp {{ number_format($denda) }}
                            </td>
                            <td>
                                @if($t->status_approval == 'pending')
                                    <form action="{{ route('admin.transaksi.approve', $t->id_transaksi) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm"
                                                onclick="return confirm('Setujui peminjaman ini?')">
                                            Setujui
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-danger btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#rejectModal{{ $t->id_transaksi }}">
                                        Tolak
                                    </button>
                                @elseif($t->status_approval == 'approved' && !$t->tgl_pengembalian)
                                    <form action="{{ route('admin.transaksi.pengembalian', $t->id_transaksi) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Konfirmasi pengembalian buku?')">
                                            Terima Kembali
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>Selesai</button>
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

<!-- Modal Reject -->
@foreach($transaksis as $t)
<div class="modal fade" id="rejectModal{{ $t->id_transaksi }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.transaksi.reject', $t->id_transaksi) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Tolak Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Alasan Penolakan</label>
                        <textarea class="form-control" name="reject_reason" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak Peminjaman</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endsection 