<!-- resources/views/admin/ddc/edit.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit DDC</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.ddc.update', $ddc->id_ddc) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="id_rak">Rak</label>
                            <select class="form-control @error('id_rak') is-invalid @enderror" id="id_rak" name="id_rak" required>
                                <option value="">Pilih Rak</option>
                                @foreach($raks as $rak)
                                    <option value="{{ $rak->id_rak }}" {{ old('id_rak', $ddc->id_rak) == $rak->id_rak ? 'selected' : '' }}>
                                        {{ $rak->rak }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_rak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kode_ddc">Kode DDC</label>
                            <input type="text" class="form-control @error('kode_ddc') is-invalid @enderror" 
                                   id="kode_ddc" name="kode_ddc" value="{{ old('kode_ddc', $ddc->kode_ddc) }}" required>
                            @error('kode_ddc')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ddc">DDC</label>
                            <input type="text" class="form-control @error('ddc') is-invalid @enderror" 
                                   id="ddc" name="ddc" value="{{ old('ddc', $ddc->ddc) }}" required>
                            @error('ddc')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" 
                                   id="keterangan" name="keterangan" value="{{ old('keterangan', $ddc->keterangan) }}">
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.ddc.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection