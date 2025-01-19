@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Penerbit</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.penerbit.update', $penerbit->id_penerbit) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="kode_penerbit">Kode Penerbit</label>
                            <input type="text" class="form-control @error('kode_penerbit') is-invalid @enderror" 
                                   id="kode_penerbit" name="kode_penerbit" value="{{ old('kode_penerbit', $penerbit->kode_penerbit) }}" required>
                            @error('kode_penerbit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_penerbit">Nama Penerbit</label>
                            <input type="text" class="form-control @error('nama_penerbit') is-invalid @enderror" 
                                   id="nama_penerbit" name="nama_penerbit" value="{{ old('nama_penerbit', $penerbit->nama_penerbit) }}" required>
                            @error('nama_penerbit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat_penerbit">Alamat</label>
                            <input type="text" class="form-control @error('alamat_penerbit') is-invalid @enderror" 
                                   id="alamat_penerbit" name="alamat_penerbit" value="{{ old('alamat_penerbit', $penerbit->alamat_penerbit) }}" required>
                            @error('alamat_penerbit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_telp">No. Telepon</label>
                            <input type="text" class="form-control @error('no_telp') is-invalid @enderror" 
                                   id="no_telp" name="no_telp" value="{{ old('no_telp', $penerbit->no_telp) }}" required>
                            @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $penerbit->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="fax">Fax</label>
                            <input type="text" class="form-control @error('fax') is-invalid @enderror" 
                                   id="fax" name="fax" value="{{ old('fax', $penerbit->fax) }}">
                            @error('fax')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="website">Website</label>
                            <input type="text" class="form-control @error('website') is-invalid @enderror" 
                                   id="website" name="website" value="{{ old('website', $penerbit->website) }}">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kontak">Kontak</label>
                            <input type="text" class="form-control @error('kontak') is-invalid @enderror" 
                                   id="kontak" name="kontak" value="{{ old('kontak', $penerbit->kontak) }}" required>
                            @error('kontak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.penerbit.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection