@extends('layouts.appUser')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                @if($book->gambar && file_exists(public_path('pustaka/' . $book->gambar)))
                    <img src="{{ asset('pustaka/' . $book->gambar) }}" 
                         class="card-img-top" alt="{{ $book->judul_pustaka }}">
                @else
                    <img src="{{ asset('images/no-image.png') }}" 
                         class="card-img-top" alt="No Image">
                @endif
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">{{ $book->judul_pustaka }}</h2>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-3 text-muted">ISBN</div>
                        <div class="col-md-9">{{ $book->isbn }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 text-muted">Pengarang</div>
                        <div class="col-md-9">{{ $book->pengarang->nama_pengarang }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 text-muted">Penerbit</div>
                        <div class="col-md-9">{{ $book->penerbit->nama_penerbit }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 text-muted">Tahun Terbit</div>
                        <div class="col-md-9">{{ $book->tahun_terbit }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 text-muted">Kategori</div>
                        <div class="col-md-9">{{ $book->ddc->nama_ddc }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 text-muted">Format</div>
                        <div class="col-md-9">{{ $book->format->nama_format }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 text-muted">Status</div>
                        <div class="col-md-9">
                            <span class="badge {{ $book->fp == '1' ? 'bg-success' : 'bg-danger' }}">
                                {{ $book->fp == '1' ? 'Tersedia' : 'Dipinjam' }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 text-muted">Kata Kunci</div>
                        <div class="col-md-9">{{ $book->keyword }}</div>
                    </div>
                    @if($book->abstraksi)
                    <div class="row mb-3">
                        <div class="col-md-3 text-muted">Abstraksi</div>
                        <div class="col-md-9">{{ $book->abstraksi }}</div>
                    </div>
                    @endif
                    
                    <div class="mt-4">
                        @if($book->fp == '1')
                            <a href="{{ route('transaksi.create', $book->id_pustaka) }}" 
                               class="btn btn-primary">
                                <i class="fas fa-book-reader mr-2"></i>Pinjam Buku
                            </a>
                        @else
                            <button class="btn btn-secondary" disabled>
                                <i class="fas fa-clock mr-2"></i>Sedang Dipinjam
                            </button>
                        @endif
                        <a href="{{ route('home') }}" class="btn btn-secondary ml-2">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 