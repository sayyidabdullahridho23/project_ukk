@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Data Penerbit</h6>
                    <a href="{{ route('admin.penerbit.create') }}" class="btn btn-primary float-end">Tambah Penerbit</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
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
    </div>
</div>
@endsection