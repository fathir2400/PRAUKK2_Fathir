@extends('admin.index')

@section('content')

 <!-- Start::main-content -->
 <div class="main-content">
    <!-- Page Header -->
    <div class="md:flex block items-center justify-between mb-6 mt-[2rem]  page-header-breadcrumb">
        <div class="my-auto">
            <h5 class="page-title text-[1.3125rem] font-medium text-defaulttextcolor mb-0">Edit merk</h5>
            <nav>
                <ol class="flex items-center whitespace-nowrap min-w-0">
                    <li class="text-[12px]"> <a class="flex items-center text-primary hover:text-primary"
                        href="javascript:void(0);"> edit <i
                        class="ti ti-chevrons-right flex-shrink-0 mx-3 overflow-visible text-textmuted rtl:rotate-180"></i>
                    </a> </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="xl:col-span-6 col-span-12">
        <div class="box">
            <div class="box-header flex justify-between">
                <div class="box-title">
                    Edit merk
                </div>
            </div>
            <div class="box-body !-mt-4">
                <form action="{{ route('merk.update', $merk->id_merk) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Menandakan bahwa ini adalah update request -->

                    <!-- Kode merk -->
                    <div class="xl:col-span-12 col-span-12 mt-0">
                        <label for="kode_merk" class="form-label">Kode merk</label>
                        <input type="text" class="form-control" name="kode_merk" placeholder="Kode merk"
                               value="{{ old('kode_merk', $merk->kode_merk) }}" readonly>
                    </div>

                    <!-- Nama merk -->
                    <div class="xl:col-span-12 col-span-12 mt-0">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama_merk" placeholder="Nama merk"
                               value="{{ old('nama_merk', $merk->nama_merk) }}">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <!-- Keterangan merk -->
                   

                    <!-- Submit Button -->
                    <button type="submit" class="ti-btn ti-btn-primary-full mt-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
