@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tambah Pengarang</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pengarang.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kode_pengarang">Kode Pengarang</label>
                                    <input type="text" class="form-control @error('kode_pengarang') is-invalid @enderror" 
                                           id="kode_pengarang" name="kode_pengarang" value="{{ old('kode_pengarang') }}" required>
                                    @error('kode_pengarang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gelar_depan">Gelar Depan</label>
                                    <input type="text" class="form-control @error('gelar_depan') is-invalid @enderror" 
                                           id="gelar_depan" name="gelar_depan" value="{{ old('gelar_depan') }}">
                                    @error('gelar_depan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="nama_pengarang">Nama Pengarang</label>
                                    <input type="text" class="form-control @error('nama_pengarang') is-invalid @enderror" 
                                           id="nama_pengarang" name="nama_pengarang" value="{{ old('nama_pengarang') }}" required>
                                    @error('nama_pengarang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="gelar_belakang">Gelar Belakang</label>
                                    <input type="text" class="form-control @error('gelar_belakang') is-invalid @enderror" 
                                           id="gelar_belakang" name="gelar_belakang" value="{{ old('gelar_belakang') }}">
                                    @error('gelar_belakang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="no_telp">No. Telepon</label>
                                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror" 
                                           id="no_telp" name="no_telp" value="{{ old('no_telp') }}" required>
                                    @error('no_telp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="website">Website</label>
                            <input type="text" class="form-control @error('website') is-invalid @enderror" 
                                   id="website" name="website" value="{{ old('website') }}">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="biografi">Biografi</label>
                            <textarea class="form-control @error('biografi') is-invalid @enderror" 
                                      id="biografi" name="biografi" rows="4">{{ old('biografi') }}</textarea>
                            @error('biografi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" 
                                   id="keterangan" name="keterangan" value="{{ old('keterangan') }}">
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.pengarang.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection