@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Hasil Pencarian: "{{ $keyword }}"</h2>
            <p>Ditemukan {{ $books->total() }} buku</p>
        </div>
    </div>

    <div class="row">
        @forelse($books as $book)
            <div class="col-md-2 mb-4">
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
                    Tidak ada buku yang ditemukan dengan kata kunci tersebut.
                </div>
            </div>
        @endforelse
    </div>

    <div class="row">
        <div class="col-12">
            {{ $books->appends(['keyword' => $keyword])->links() }}
        </div>
    </div>
</div>
@endsection 