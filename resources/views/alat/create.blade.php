@extends('admin.index')

@section('content')
    <!-- Start::main-content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="md:flex block items-center justify-between mb-6 mt-[2rem] page-header-breadcrumb">
            <div class="my-auto">
                <h5 class="page-title text-[1.3125rem] font-medium text-defaulttextcolor mb-0">Tambah Alat</h5>
                <nav>
                    <ol class="flex items-center whitespace-nowrap min-w-0">
                        <li class="text-[12px]">
                            <a class="flex items-center text-primary hover:text-primary" href="javascript:void(0);">Tambah
                                <i class="ti ti-chevrons-right flex-shrink-0 mx-3 overflow-visible text-textmuted rtl:rotate-180"></i>
                            </a>
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="flex xl:my-auto right-content align-items-center">
                <div class="pe-1 xl:mb-0">
                    <button type="button" class="ti-btn ti-btn-info-full text-white ti-btn-icon me-2 btn-b !mb-0">
                        <i class="mdi mdi-filter-variant"></i>
                    </button>
                </div>
                <div class="pe-1 xl:mb-0">
                    <button type="button" class="ti-btn ti-btn-danger-full text-white ti-btn-icon me-2 !mb-0">
                        <i class="mdi mdi-star"></i>
                    </button>
                </div>
                <div class="pe-1 xl:mb-0">
                    <button type="button" class="ti-btn ti-btn-warning-full text-white ti-btn-icon me-2 !mb-0">
                        <i class="mdi mdi-refresh"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Start::form to Add Alat -->
        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-header flex justify-between">
                    <h3>Tambah Alat</h3>
                </div>

                <div class="box-body !-mt-4">
                    <!-- Form for adding new Alat -->
                    <form action="{{ route('alat.store') }}" method="POST">
                        @csrf
                        
                        <!-- Input for Kode Alat -->
                        <div class="xl:col-span-12 col-span-12 mt-0">
    <label for="kode_alat" class="form-label">Kode Alat</label>
    <input type="text" class="form-control" id="kode_alat" name="kode_alat" value="{{ 'ALT' . str_pad(App\Models\Data_alat::count() + 1, 3, '0', STR_PAD_LEFT) }}" readonly>
</div>


                        <!-- Input for Nama Alat -->
                        <div class="xl:col-span-12 col-span-12 mt-0">
                            <label for="nama_alat" class="form-label">Nama Alat</label>
                            <input type="text" class="form-control" id="nama_alat" name="nama_alat" required placeholder="Masukkan Nama Alat">
                        </div>

                        <!-- Input for Stok -->
                        <div class="xl:col-span-12 col-span-12 mt-0">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" required placeholder="Masukkan Jumlah Stok">
                        </div>

                        <!-- Dropdown for selecting Satuan -->
                        <div class="xl:col-span-12 col-span-12 mt-0">
                            <label for="kode_satuan" class="form-label">Satuan</label>
                            <select id="kode_satuan" name="kode_satuan" class="form-control" required>
                                <option value="" disabled selected>Pilih Satuan</option>
                                @foreach($satuan as $item)
                                    <option value="{{ $item->kode_satuan }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Input for Keterangan -->
                        <div class="xl:col-span-12 col-span-12 mt-0">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea id="keterangan" name="keterangan" class="form-control" required placeholder="Masukkan Keterangan Alat"></textarea>
                        </div>
                        <div class="xl:col-span-12 col-span-12 mt-0">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input type="file" name="gambar" id="file-input" class="block w-full border border-gray-200 focus:shadow-sm dark:focus:shadow-white/10 rounded-sm text-sm focus:z-10 focus:outline-0 focus:border-gray-200 dark:focus:border-white/10 dark:border-white/10 dark:text-white/50
                                       file:border-0
                                      file:bg-light file:me-4
                                      file:py-3 file:px-4
                                      dark:file:bg-black/20 dark:file:text-white/50" value="{{old('gambar')}}">
                                      @error('gambar')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                </div>

                        <!-- Submit Button -->
                        <div class="xl:col-span-12 col-span-12 mt-4">
                            <button type="submit" class="ti-btn ti-btn-primary-full">Tambah Alat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End::main-content -->
@endsection
