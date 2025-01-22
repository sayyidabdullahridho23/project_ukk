@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Jenis Anggota</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.jenis-anggota.update', $jenisAnggota->id_jenis_anggota) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="kode_jenis_anggota">Kode Jenis Anggota</label>
                    <input type="text" class="form-control @error('kode_jenis_anggota') is-invalid @enderror" 
                           id="kode_jenis_anggota" name="kode_jenis_anggota" 
                           value="{{ old('kode_jenis_anggota', $jenisAnggota->kode_jenis_anggota) }}" required>
                    @error('kode_jenis_anggota')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jenis_anggota">Jenis Anggota</label>
                    <input type="text" class="form-control @error('jenis_anggota') is-invalid @enderror" 
                           id="jenis_anggota" name="jenis_anggota" 
                           value="{{ old('jenis_anggota', $jenisAnggota->jenis_anggota) }}" required>
                    @error('jenis_anggota')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="max_pinjam">Maksimal Pinjam</label>
                    <input type="number" class="form-control @error('max_pinjam') is-invalid @enderror" 
                           id="max_pinjam" name="max_pinjam" 
                           value="{{ old('max_pinjam', $jenisAnggota->max_pinjam) }}" required>
                    @error('max_pinjam')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control @error('keterangan') is-invalid @enderror" 
                           id="keterangan" name="keterangan" 
                           value="{{ old('keterangan', $jenisAnggota->keterangan) }}">
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.jenis-anggota.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection 