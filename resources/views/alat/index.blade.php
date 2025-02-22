@extends('admin.index')

@section('content')

<div class="main-content">
    <!-- Page Header -->
    <div class="md:flex block items-center justify-between mb-6 mt-[2rem] page-header-breadcrumb">
        <h3 class="text-2xl font-semibold text-gray-700">Manajemen Alat</h3>
    </div>

    <!-- Start:: Tabel Alat -->
    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-8 col-span-12">
            <div class="box custom-box shadow-lg rounded-md">
                <div class="box-header flex justify-between">
                    <h3 class="text-lg font-semibold text-gray-700">Daftar Alat</h3>
                    <a href="{{ route('alat.invoice') }}" class="ti-btn ti-btn-secondary-full" style="padding: 2px 6px; font-size: 0.75rem;">
                        Invoice
                        <i class="fe fe-arrow-right rtl:rotate-180 ms-1 rtl:ms-0 align-middle"></i>
                    </a>
                </div>
                <div class="table-responsive p-6">
                    <table class="table">
                        <thead class="bg-gray-200 text-gray-700">
                            <tr>
                                <th class="text-start px-3 py-2">No</th>
                                <th class="text-start px-3 py-2">Kode Alat</th>
                                <th class="text-start px-3 py-2">Gambar</th>
                                <th class="text-start px-3 py-2">Nama Alat</th>
                                <th class="text-start px-3 py-2">Stok</th>
                                <th class="text-start px-3 py-2">Keterangan</th>
                                <th class="text-start px-3 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alat as $key => $item)
                            <tr class="border-b">
                                <td class="px-3 py-2">{{ $key + 1 }}</td>
                                <td class="px-3 py-2">{{ $item->kode_alat }}</td>
                                <td class="px-3 py-2">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" width="50" height="50" alt="Gambar Alat">
                                </td>
                                <td class="px-3 py-2">{{ $item->nama_alat }}</td>
                                <td class="px-3 py-2">{{ $item->stok }}</td>
                                <td class="px-3 py-2">{{ $item->keterangan }}</td>
                                <td class="px-3 py-2">
                                    <div class="flex gap-2">
                                    <a href="javascript:void(0);" class="ti-btn ti-btn-sm ti-btn-success-full edit-btn"
   data-id="{{ $item->id_alat }}"
   data-kode="{{ $item->kode_alat }}"
   data-nama="{{ $item->nama_alat }}"
   data-stok="{{ $item->stok }}"
   data-keterangan="{{ $item->keterangan }}"
   data-gambar="{{ $item->gambar }}"> <!-- Pastikan ada atribut ini -->
   <i class="ri-edit-line"></i>
</a>
                                        <form action="{{ route('alat.destroy', $item->id_alat) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="ti-btn ti-btn-sm ti-btn-danger-full"
                                                onclick="return confirm('Yakin ingin menghapus {{ $item->nama_alat }}?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $alat->links() }}
                </div>
            </div>
        </div>

        <!-- Start:: Form Tambah/Edit -->
        <div class="xl:col-span-4 col-span-12">
            <div class="box custom-box shadow-lg rounded-md">
                <div class="box-header bg-primary text-white rounded-t-md p-3">
                    <h3 id="form-title" class="text-lg font-semibold">Tambah Alat</h3>
                </div>
                <div class="box-body p-4">
                <form id="alat-form" action="{{ route('alat.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" id="form-method" name="_method" value="POST">
                        <input type="hidden" id="alat_id" name="id_alat">
                        <input type="hidden" name="gambar_lama" value="{{ $alat->gambar ?? '' }}">

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

                        <!-- Input for Keterangan -->
                        <div class="xl:col-span-12 col-span-12 mt-0">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea id="keterangan" name="keterangan" class="form-control" required placeholder="Masukkan Keterangan Alat"></textarea>
                        </div>

                     <!-- Input for Gambar -->
<div class="xl:col-span-12 col-span-12 mt-0">
    <label for="gambar" class="form-label">Gambar</label>
    <input type="file" name="gambar" class="form-control">
    <p>Gambar :</p>
    <img id="image-preview" src="" width="150px" style="display:none;" alt="Gambar Alat">
</div>


                        <!-- Buttons -->
                        <div class="flex gap-2 mt-4">
                            <button type="submit" class="ti-btn ti-btn-primary-full px-4 py-2">Simpan</button>
                            <button type="button" id="reset-btn" class="ti-btn ti-btn-secondary-full px-4 py-2">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End:: Form -->
    </div>
</div>

<!-- SCRIPT UNTUK EDIT DAN RESET -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('alat-form');
    const formTitle = document.getElementById('form-title');
    const alatIdInput = document.getElementById('alat_id');
    const kodeInput = document.getElementById('kode_alat');
    const namaInput = document.getElementById('nama_alat');
    const stokInput = document.getElementById('stok');
    const keteranganInput = document.getElementById('keterangan');
    const formMethod = document.getElementById('form-method');
    const resetBtn = document.getElementById('reset-btn');
    const imagePreview = document.getElementById('image-preview'); // Tambahkan id di <img> tag

    // **FUNGSI EDIT DATA**
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const alatId = this.getAttribute('data-id');
            const kode = this.getAttribute('data-kode');
            const nama = this.getAttribute('data-nama');
            const stok = this.getAttribute('data-stok');
            const keterangan = this.getAttribute('data-keterangan');
            const gambar = this.getAttribute('data-gambar'); // Ambil data gambar

            // Ubah action form ke URL update
            form.action = `/alat/${alatId}`;
            formMethod.value = "PUT";

            // Isi data ke form
            alatIdInput.value = alatId;
            kodeInput.value = kode;
            namaInput.value = nama;
            stokInput.value = stok;
            keteranganInput.value = keterangan;

            // Tampilkan gambar
            if (gambar && imagePreview) {
                imagePreview.src = `/storage/${gambar}`;
                imagePreview.style.display = 'block';
            }

            formTitle.textContent = "Edit Alat";
        });
    });

    // **FUNGSI RESET FORM**
    resetBtn.addEventListener('click', function() {
        form.action = "{{ route('alat.store') }}"; // Kembali ke mode tambah
        formMethod.value = "POST";
        alatIdInput.value = "";
        kodeInput.value = "";
        namaInput.value = "";
        stokInput.value = "";
        keteranganInput.value = "";

        // Reset gambar
        if (imagePreview) {
            imagePreview.src = '';
            imagePreview.style.display = 'none';
        }

        formTitle.textContent = "Tambah Alat";
    });
});

</script>

@endsection
