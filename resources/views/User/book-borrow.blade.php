@extends('layouts.appUser')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Form Peminjaman Buku</h5>
                </div>
                <div class="card-body">
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

                    <div class="row mb-4">
                        <div class="col-md-4">
                            @if($book->gambar && file_exists(public_path('pustaka/' . $book->gambar)))
                                <img src="{{ asset('pustaka/' . $book->gambar) }}" 
                                     class="img-fluid rounded" alt="{{ $book->judul_pustaka }}">
                            @else
                                <img src="{{ asset('images/no-image.png') }}" 
                                     class="img-fluid rounded" alt="No Image">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h4>{{ $book->judul_pustaka }}</h4>
                            <p class="text-muted mb-2">Oleh: {{ $book->pengarang->nama_pengarang }}</p>
                            <p class="mb-2">ISBN: {{ $book->isbn }}</p>
                            <p class="mb-0">Status: 
                                <span class="badge {{ $book->fp == '1' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $book->fp == '1' ? 'Tersedia' : 'Dipinjam' }}
                                </span>
                            </p>
                        </div>
                    </div>

                    @if($book->fp == '1')
                        <form action="{{ route('transaksi.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_pustaka" value="{{ $book->id_pustaka }}">
                            <input type="hidden" name="id_anggota" value="{{ $anggota->id_anggota }}">

                            <div class="mb-3">
                                <label class="form-label">Nama Anggota</label>
                                <input type="text" class="form-control" value="{{ $anggota->nama_anggota }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kode Anggota</label>
                                <input type="text" class="form-control" value="{{ $anggota->kode_anggota }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Peminjaman</label>
                                <input type="date" class="form-control" name="tgl_pinjam" 
                                       value="{{ date('Y-m-d') }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Pengembalian</label>
                                <input type="date" class="form-control" name="tgl_kembali" 
                                       value="{{ date('Y-m-d', strtotime('+7 days')) }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Keterangan (opsional)</label>
                                <textarea class="form-control" name="keterangan" rows="3" 
                                          placeholder="Tambahkan catatan jika diperlukan"></textarea>
                            </div>

                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> Informasi Peminjaman:
                                <ul class="mb-0">
                                    <li>Maksimal peminjaman 7 hari</li>
                                    <li>Denda keterlambatan: Rp {{ number_format($book->denda_terlambat) }}/hari</li>
                                    <li>Denda buku hilang: Rp {{ number_format($book->denda_hilang) }}</li>
                                </ul>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
                                <a href="{{ route('book.show', $book->id_pustaka) }}" 
                                   class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            Maaf, buku ini sedang dipinjam. Silakan coba lagi nanti.
                        </div>
                        <a href="{{ route('book.show', $book->id_pustaka) }}" 
                           class="btn btn-secondary">Kembali</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 