@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Pendaftaran Anggota Perpustakaan</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_anggota">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" required value="{{ old('nama_anggota') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_jenis_anggota">Jenis Anggota</label>
                                    <select class="form-control" id="id_jenis_anggota" name="id_jenis_anggota" required>
                                        <option value="">Pilih Jenis Anggota</option>
                                        @foreach($jenisAnggota as $jenis)
                                            <option value="{{ $jenis->id_jenis_anggota }}">{{ $jenis->jenis_anggota }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tempat">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat" name="tempat" required value="{{ old('tempat') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required value="{{ old('tgl_lahir') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="2" required>{{ old('alamat') }}</textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_telp">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="no_telp" name="no_telp" required value="{{ old('no_telp') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                            <small class="text-muted">Format: JPG, JPEG, PNG (Max: 2MB)</small>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required value="{{ old('username') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Daftar Anggota</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .card-header {
        border-radius: 15px 15px 0 0 !important;
    }
    .form-control {
        border-radius: 8px;
    }
    .btn-primary {
        border-radius: 8px;
        padding: 10px 20px;
    }
</style>
@endsection 