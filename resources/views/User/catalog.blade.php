@extends('layouts.user')

@section('content')
<div class="container">

    <h2 class="mb-4">Katalog</h2>

    <!-- Search Form -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form action="{{ route('books.search') }}" method="GET" class="d-flex">
                <input type="text" name="keyword" class="form-control me-2" placeholder="Cari judul buku atau pengarang...">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>
    </div>

    <!-- Books Grid -->
    <div class="row">
        @forelse($books as $book)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if($book->gambar)
                        <img src="{{ asset('pustaka/' . $book->gambar) }}" class="card-img-top" alt="{{ $book->judul_pustaka }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-book fa-3x"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->judul_pustaka }}</h5>
                        <p class="card-text">
                            <small class="text-muted">
                                Oleh: {{ $book->pengarang->nama_pengarang }}<br>
                                Penerbit: {{ $book->penerbit->nama_penerbit }}
                            </small>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('book.show', $book->id_pustaka) }}" class="btn btn-primary btn-sm">Detail</a>
                            <form action="{{ route('user.favorites.toggle', $book->id_pustaka) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-heart {{ auth()->user()->hasFavorite($book->id_pustaka) ? 'text-danger' : '' }}"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Tidak ada buku yang tersedia saat ini.
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $books->links() }}
    </div>
</div>
@endsection 