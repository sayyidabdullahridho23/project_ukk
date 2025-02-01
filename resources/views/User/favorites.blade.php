@extends('layouts.user')

@section('content')
<div class="container">

    <h2 class="mb-4">Buku Favorit</h2>

    <div class="row">
        @forelse($favorites as $book)
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
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-heart"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Anda belum memiliki buku favorit.
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $favorites->links() }}
    </div>
</div>
@endsection 