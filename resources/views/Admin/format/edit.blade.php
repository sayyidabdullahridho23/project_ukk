@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Format</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.format.update', $format->id_format) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="kode_format">Kode Format</label>
                            <input type="text" class="form-control @error('kode_format') is-invalid @enderror" 
                                   id="kode_format" name="kode_format" value="{{ old('kode_format', $format->kode_format) }}" required>
                            @error('kode_format')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="format">Format</label>
                            <input type="text" class="form-control @error('format') is-invalid @enderror" 
                                   id="format" name="format" value="{{ old('format', $format->format) }}" required>
                            @error('format')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" 
                                   id="keterangan" name="keterangan" value="{{ old('keterangan', $format->keterangan) }}">
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.format.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection