@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Data Format</h6>
                    <a href="{{ route('admin.format.create') }}" class="btn btn-primary float-end">Tambah Format</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>Kode Format</th>
                                    <th>Format</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($formats as $format)
                                <tr>
                                    <td>{{ $format->kode_format }}</td>
                                    <td>{{ $format->format }}</td>
                                    <td>{{ $format->keterangan }}</td>
                                    <td>
                                        <a href="{{ route('admin.format.edit', $format->id_format) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.format.destroy', $format->id_format) }}" method="POST" class="d-inline">
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