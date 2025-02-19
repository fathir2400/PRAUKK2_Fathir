@extends('admin.index')

@section('content')
    <div class="main-content">
        <div class="md:flex block items-center justify-between mb-6 mt-[2rem] page-header-breadcrumb">
            <div class="my-auto">
                <h5 class="page-title text-[1.3125rem] font-medium text-defaulttextcolor mb-0">Edit Alat</h5>
                <nav>
                    <ol class="flex items-center whitespace-nowrap min-w-0">
                        <li class="text-[12px]">
                            <a class="flex items-center text-primary hover:text-primary" href="javascript:void(0);">Edit
                                <i class="ti ti-chevrons-right flex-shrink-0 mx-3 overflow-visible text-textmuted rtl:rotate-180"></i>
                            </a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-header flex justify-between">
                    <h3>Edit Alat</h3>
                </div>

                <div class="box-body !-mt-4">
                    <!-- Form for editing Alat -->
                    <form action="{{ route('alat.update', $alat->id_alat) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Input for Kode Alat (Read-Only) -->
                        <div class="xl:col-span-12 col-span-12 mt-0">
                            <label for="kode_alat" class="form-label">Kode Alat</label>
                            <input type="text" class="form-control" id="kode_alat" name="kode_alat" value="{{ $alat->kode_alat }}" readonly>
                        </div>

                        <!-- Input for Nama Alat -->
                        <div class="xl:col-span-12 col-span-12 mt-0">
                            <label for="nama_alat" class="form-label">Nama Alat</label>
                            <input type="text" class="form-control" id="nama_alat" name="nama_alat" required value="{{ $alat->nama_alat }}">
                        </div>

                        <!-- Input for Stok -->
                        <div class="xl:col-span-12 col-span-12 mt-0">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" required value="{{ $alat->stok }}">
                        </div>

                        <!-- Dropdown for selecting Satuan -->
                        

                        <!-- Input for Keterangan -->
                        <div class="xl:col-span-12 col-span-12 mt-0">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea id="keterangan" name="keterangan" class="form-control" required>{{ $alat->keterangan }}</textarea>
                        </div>

                        <!-- Input for Gambar -->
                        <div class="xl:col-span-12 col-span-12 mt-0">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" name="gambar" class="form-control">
                            <p>Gambar saat ini:</p>
                            <img src="{{ asset('storage/' . $alat->gambar) }}" width="150px">
                        </div>

                        <!-- Submit Button -->
                        <div class="xl:col-span-12 col-span-12 mt-4">
                            <button type="submit" class="ti-btn ti-btn-primary-full">Update Alat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
