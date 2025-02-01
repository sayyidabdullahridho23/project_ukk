@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Profil Perpustakaan</h5>
                </div>
                <div class="card-body">
                    @if($perpustakaan)
                        <div class="text-center mb-4">
                            <h3>{{ $perpustakaan->nama_perpustakaan }}</h3>
                            <p class="text-muted">Dikelola oleh: {{ $perpustakaan->nama_pustakawan }}</p>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-primary">Informasi Kontak</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <td><i class="fas fa-map-marker-alt"></i> Alamat</td>
                                        <td>: {{ $perpustakaan->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-phone"></i> Telepon</td>
                                        <td>: {{ $perpustakaan->no_telp }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-envelope"></i> Email</td>
                                        <td>: {{ $perpustakaan->email }}</td>
                                    </tr>
                                    @if($perpustakaan->website)
                                    <tr>
                                        <td><i class="fas fa-globe"></i> Website</td>
                                        <td>: <a href="{{ $perpustakaan->website }}" target="_blank">{{ $perpustakaan->website }}</a></td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                            <div class="col-md-6">
                                @if($perpustakaan->keterangan)
                                    <h6 class="text-primary">Keterangan</h6>
                                    <p>{{ $perpustakaan->keterangan }}</p>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="text-center">
                            <p>Profil perpustakaan belum tersedia.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 