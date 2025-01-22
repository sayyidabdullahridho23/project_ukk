@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Manajemen DDC</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data DDC</h6>
            <a href="{{ route('admin.ddc.create') }}" class="btn btn-primary float-right">Tambah DDC</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Rak</th>
                            <th>Kode DDC</th>
                            <th>DDC</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ddcs as $ddc)
                        <tr>
                            <td>{{ $ddc->rak->rak }}</td>
                            <td>{{ $ddc->kode_ddc }}</td>
                            <td>{{ $ddc->ddc }}</td>
                            <td>{{ $ddc->keterangan }}</td>
                            <td>
                                <a href="{{ route('admin.ddc.edit', $ddc->id_ddc) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.ddc.destroy', $ddc->id_ddc) }}" method="POST" class="d-inline">
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