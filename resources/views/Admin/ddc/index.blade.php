@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Data DDC</h6>
                    <a href="{{ route('admin.ddc.create') }}" class="btn btn-primary float-end">Tambah DDC</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
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
    </div>
</div>
@endsection