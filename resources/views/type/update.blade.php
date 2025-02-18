@extends('admin.index')

@section('content')

<!-- Start::main-content -->
<div class="main-content">
    <!-- Page Header -->
    <div class="md:flex block items-center justify-between mb-6 mt-[2rem] page-header-breadcrumb">
        <div class="my-auto">
            <h5 class="page-title text-[1.3125rem] font-medium text-defaulttextcolor mb-0">Edit Type</h5>
        </div>
    </div>

    <div class="xl:col-span-6 col-span-12">
        <div class="box">
            <div class="box-header flex justify-between">
                <div class="box-title">
                    Form Edit Type
                </div>
            </div>
            <div class="box-body">
                <form action="{{ route('type.update', $type->id_type) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Kode Jenis -->
                    <div class="mb-4">
                        <label for="kode_jenis" class="form-label">Jenis</label>
                        <select name="kode_jenis" class="form-control @error('kode_jenis') is-invalid @enderror">
                            <option value="">Pilih jenis</option>
                            @foreach($jenis as $item)
                                <option value="{{ $item->kode_jenis }}" 
                                    {{ $item->kode_jenis == $type->kode_jenis ? 'selected' : '' }}>
                                    {{ $item->nama_jenis }}
                                </option>
                            @endforeach
                        </select>
                        @error('kode_jenis')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Merk -->
                    <div class="mb-4">
                        <label for="kode_merk" class="form-label">Merk</label>
                        <select name="kode_merk" class="form-control @error('kode_merk') is-invalid @enderror">
                            <option value="">Pilih merk</option>
                            @foreach($merk as $item)
                                <option value="{{ $item->kode_merk }}" 
                                    {{ $item->kode_merk == $type->kode_merk ? 'selected' : '' }}>
                                    {{ $item->nama_merk }}
                                </option>
                            @endforeach
                        </select>
                        @error('kode_merk')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nama Type -->
                    <div class="mb-4">
                        <label for="nama_type" class="form-label">Nama Type</label>
                        <input type="text" class="form-control @error('nama_type') is-invalid @enderror"
                               name="nama_type" placeholder="Masukkan nama type"
                               value="{{ old('nama_type', $type->nama_type) }}">
                        @error('nama_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tahun -->
                    <div class="mb-4">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="number" class="form-control @error('tahun') is-invalid @enderror"
                               name="tahun" placeholder="Masukkan tahun"
                               value="{{ old('tahun', $type->tahun) }}">
                        @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit & Cancel Buttons -->
                    <button type="submit" class="ti-btn ti-btn-primary-full mt-2">Update</button>
                    <a href="{{ route('type.index') }}" class="ti-btn ti-btn-secondary-full mt-2">Batal</a>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
