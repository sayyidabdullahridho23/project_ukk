@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tambah Rak</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.rak.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="kode_rak">Kode Rak</label>
                    <input type="text" class="form-control @error('kode_rak') is-invalid @enderror" 
                           id="kode_rak" name="kode_rak" value="{{ old('kode_rak') }}" required>
                    @error('kode_rak')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="rak">Rak</label>
                    <input type="text" class="form-control @error('rak') is-invalid @enderror" 
                           id="rak" name="rak" value="{{ old('rak') }}" required>
                    @error('rak')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control @error('keterangan') is-invalid @enderror" 
                           id="keterangan" name="keterangan" value="{{ old('keterangan') }}">
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.rak.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection