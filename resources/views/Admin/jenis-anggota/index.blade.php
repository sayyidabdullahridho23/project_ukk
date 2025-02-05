@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Manajemen Jenis Anggota</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Jenis Anggota</h6>
            <a href="{{ route('admin.jenis-anggota.create') }}" class="btn btn-primary float-right">Tambah Jenis Anggota</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode Jenis Anggota</th>
                            <th>Jenis Anggota</th>
                            <th>Max Pinjam</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jenisAnggota as $jenis)
                        <tr>
                            <td>{{ $jenis->kode_jenis_anggota }}</td>
                            <td>{{ $jenis->jenis_anggota }}</td>
                            <td>{{ $jenis->max_pinjam }}</td>
                            <td>{{ $jenis->keterangan }}</td>
                            <td>
                                <a href="{{ route('admin.jenis-anggota.edit', $jenis->id_jenis_anggota) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.jenis-anggota.destroy', $jenis->id_jenis_anggota) }}" method="POST" class="d-inline">
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