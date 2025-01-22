@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Manajemen Penerbit</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Penerbit</h6>
            <a href="{{ route('admin.penerbit.create') }}" class="btn btn-primary float-right">Tambah Penerbit</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. Telp</th>
                            <th>Email</th>
                            <th>Kontak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penerbits as $penerbit)
                        <tr>
                            <td>{{ $penerbit->kode_penerbit }}</td>
                            <td>{{ $penerbit->nama_penerbit }}</td>
                            <td>{{ $penerbit->alamat_penerbit }}</td>
                            <td>{{ $penerbit->no_telp }}</td>
                            <td>{{ $penerbit->email }}</td>
                            <td>{{ $penerbit->kontak }}</td>
                            <td>
                                <a href="{{ route('admin.penerbit.edit', $penerbit->id_penerbit) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.penerbit.destroy', $penerbit->id_penerbit) }}" method="POST" class="d-inline">
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