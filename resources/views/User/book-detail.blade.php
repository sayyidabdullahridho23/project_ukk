@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                @if($book->gambar && Storage::disk('public')->exists($book->gambar))
                    <img src="{{ asset('storage/' . $book->gambar) }}" 
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
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-3">
        <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection 