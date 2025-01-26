@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Manajemen Pustaka</h1>
    
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
            <h6 class="m-0 font-weight-bold text-primary">Data Pustaka</h6>
            <a href="{{ route('admin.pustaka.create') }}" class="btn btn-primary float-right">Tambah Pustaka</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Judul Pustaka</th>
                            <th>ISBN</th>
                            <th>Kategori</th>
                            <th>Penerbit</th>
                            <th>Pengarang</th>
                            <th>Kondisi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pustaka as $buku)
                        <tr>
                            <td>
                                @if($buku->gambar && file_exists(public_path('pustaka/' . $buku->gambar)))
                                    <img src="{{ asset('pustaka/' . $buku->gambar) }}" 
                                         class="img-thumbnail" style="max-height: 200px;" alt="{{ $buku->judul_pustaka }}"><br>
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" 
                                         class="img-thumbnail" style="max-height: 50px;" alt="No Image"><br>
                                @endif
                                {{ $buku->judul_pustaka }}
                            </td>
                            <td>{{ $buku->isbn }}</td>
                            <td>{{ $buku->ddc->ddc ?? 'N/A' }}</td>
                            <td>{{ $buku->penerbit->nama_penerbit }}</td>
                            <td>{{ $buku->pengarang->nama_pengarang }}</td>
                            <td>{{ $buku->kondisi_buku }}</td>
                            <td>{{ $buku->fp == '1' ? 'Tersedia' : 'Dipinjam' }}</td>
                            <td>
                                <a href="{{ route('admin.pustaka.edit', $buku->id_pustaka) }}" 
                                   class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.pustaka.destroy', $buku->id_pustaka) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
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
