@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tambah Transaksi</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Transaksi Baru</h6>
        </div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('admin.transaksi.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="id_anggota">Anggota</label>
                    <select class="form-control @error('id_anggota') is-invalid @enderror" 
                            id="id_anggota" name="id_anggota" required>
                        <option value="">Pilih Anggota</option>
                        @foreach($anggotas as $anggota)
                            <option value="{{ $anggota->id_anggota }}">
                                {{ $anggota->kode_anggota }} - {{ $anggota->nama_anggota }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_anggota')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="id_pustaka">Buku</label>
                    <select class="form-control @error('id_pustaka') is-invalid @enderror" 
                            id="id_pustaka" name="id_pustaka" required>
                        <option value="">Pilih Buku</option>
                        @foreach($pustakas as $pustaka)
                            <option value="{{ $pustaka->id_pustaka }}">
                                {{ $pustaka->isbn }} - {{ $pustaka->judul_pustaka }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_pustaka')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tgl_pinjam">Tanggal Pinjam</label>
                    <input type="date" class="form-control @error('tgl_pinjam') is-invalid @enderror" 
                           id="tgl_pinjam" name="tgl_pinjam" value="{{ date('Y-m-d') }}" required>
                    @error('tgl_pinjam')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tgl_kembali">Tanggal Kembali</label>
                    <input type="date" class="form-control @error('tgl_kembali') is-invalid @enderror" 
                           id="tgl_kembali" name="tgl_kembali" 
                           value="{{ date('Y-m-d', strtotime('+7 days')) }}" required>
                    @error('tgl_kembali')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                              id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Inisialisasi select2 untuk dropdown yang panjang
    $(document).ready(function() {
        $('#id_anggota').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Anggota'
        });
        
        $('#id_pustaka').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Buku'
        });
    });
</script>
@endpush 