@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Profil Perpustakaan</h6>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ $perpustakaan ? route('admin.perpustakaan.update', $perpustakaan->id_perpustakaan) : route('admin.perpustakaan.store') }}" 
                  method="POST">
                @csrf
                @if($perpustakaan)
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Perpustakaan</label>
                            <input type="text" class="form-control @error('nama_perpustakaan') is-invalid @enderror" 
                                   name="nama_perpustakaan" value="{{ old('nama_perpustakaan', $perpustakaan->nama_perpustakaan ?? '') }}">
                            @error('nama_perpustakaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Pustakawan</label>
                            <input type="text" class="form-control @error('nama_pustakawan') is-invalid @enderror" 
                                   name="nama_pustakawan" value="{{ old('nama_pustakawan', $perpustakaan->nama_pustakawan ?? '') }}">
                            @error('nama_pustakawan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" 
                           name="alamat" value="{{ old('alamat', $perpustakaan->alamat ?? '') }}">
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email', $perpustakaan->email ?? '') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Website</label>
                            <input type="text" class="form-control @error('website') is-invalid @enderror" 
                                   name="website" value="{{ old('website', $perpustakaan->website ?? '') }}">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No. Telepon</label>
                            <input type="text" class="form-control @error('no_telp') is-invalid @enderror" 
                                   name="no_telp" value="{{ old('no_telp', $perpustakaan->no_telp ?? '') }}">
                            @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" 
                                   name="keterangan" value="{{ old('keterangan', $perpustakaan->keterangan ?? '') }}">
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ $perpustakaan ? 'Update Profil' : 'Simpan Profil' }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection 