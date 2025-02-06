@php
use Illuminate\Support\Facades\File;
@endphp

@extends('layouts.user')

@section('content')
<div class="container">
    <!-- Hero Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-5">
                <h2 class="display-5 text-primary mb-4" style="font-family: 'Poppins', sans-serif; text-align: center;">Cari Buku</h2>
                <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
                    <form action="{{ route('books.search') }}" method="GET">
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control" name="keyword" 
                                placeholder="Masukkan judul buku atau kata kunci..." 
                                value="{{ request('keyword') }}"
                                aria-label="Search books">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                        <div class="text-muted mt-2">
                            <small>Contoh: Novel, Sejarah, Teknologi, atau masukkan judul buku</small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Links Section -->
    <div class="row mb-4 justify-content-center">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-user fa-3x mb-3 text-primary"></i>
                    <h5 class="card-title">Profile Anggota</h5>
                    <p class="card-text"></p>
                    <a href="{{ route('anggota.profile') }}" class="btn btn-primary">Lihat Profile</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-book fa-3x mb-3 text-primary"></i>
                    <h5 class="card-title">Katalog Buku</h5>
                    <p class="card-text"></p>
                    <a href="{{ route('books.catalog') }}" class="btn btn-primary">Lihat Katalog</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-bookmark fa-3x mb-3 text-primary"></i>
                    <h5 class="card-title">Buku Favorit</h5>
                    <p class="card-text"></p>
                    <a href="{{ route('user.favorites') }}" class="btn btn-primary">Lihat Favorit</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Books Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-4">Buku </h2>
        </div>
        @forelse($latestBooks as $book)
        <div class="col-md-2">
            <div class="card h-100">
                @if($book->gambar && file_exists(public_path('pustaka/' . $book->gambar)))
                    <img src="{{ asset('pustaka/' . $book->gambar) }}" 
                         class="card-img-top" alt="{{ $book->judul_pustaka }}"
                         style="height: 200px; object-fit: cover;">
                @else
                    <img src="{{ asset('images/no-image.png') }}" 
                         class="card-img-top" alt="No Image"
                         style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h6 class="card-title text-truncate" title="{{ $book->judul_pustaka }}">
                        {{ $book->judul_pustaka }}
                    </h6>
                    <p class="card-text small text-muted mb-2">
                        {{ $book->pengarang->nama_pengarang }}
                    </p>
                    <a href="{{ route('book.show', $book->id_pustaka) }}" 
                       class="btn btn-primary btn-sm">Detail</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">
                Belum ada buku yang ditambahkan.
            </div>
        </div>
        @endforelse
    </div>

    <!-- Announcement Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header bg-info text-white text-center">
    <h5 class="mb-0">Pengumuman</h5>
</div>

                <div class="card-body">
                    <div class="alert alert-info mb-0">
                        <h5>Jam Operasional Perpustakaan</h5>
                        <p class="mb-0">Senin - Jumat: 08.00 - 16.00 WIB<br>
                        Sabtu: 09.00 - 13.00 WIB<br>
                        Minggu: Tutup</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection

