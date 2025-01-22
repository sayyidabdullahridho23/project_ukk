@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Manajemen Pengarang</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pengarang</h6>
            <a href="{{ route('admin.pengarang.create') }}" class="btn btn-primary float-right">Tambah Pengarang</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Lengkap</th>
                            <th>Kontak</th>
                            <th>Website</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengarangs as $pengarang)
                        <tr>
                            <td>{{ $pengarang->kode_pengarang }}</td>
                            <td>
                                {{ $pengarang->gelar_depan ? $pengarang->gelar_depan . ' ' : '' }}
                                {{ $pengarang->nama_pengarang }}
                                {{ $pengarang->gelar_belakang ? ', ' . $pengarang->gelar_belakang : '' }}
                            </td>
                            <td>
                                Tel: {{ $pengarang->no_telp }}<br>
                                {{ $pengarang->email }}
                            </td>
                            <td>{{ $pengarang->website }}</td>
                            <td>
                                <a href="{{ route('admin.pengarang.edit', $pengarang->id_pengarang) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.pengarang.destroy', $pengarang->id_pengarang) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
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