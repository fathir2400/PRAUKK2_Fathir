@extends('admin.index')

@section('content')

 <!-- Start::main-content -->
 <div class="main-content">
                <!-- Page Header -->
                <!-- Page Header -->
                <div class="md:flex block items-center justify-between mb-6 mt-[2rem]  page-header-breadcrumb">
                  <div class="my-auto">
                    <h5 class="page-title text-[1.3125rem] font-medium text-defaulttextcolor mb-0">Tambah User</h5>
                    <nav>
                      <ol class="flex items-center whitespace-nowrap min-w-0">
                        <li class="text-[12px]"> <a class="flex items-center text-primary hover:text-primary"
                            href="javascript:void(0);"> tambah <i
                              class="ti ti-chevrons-right flex-shrink-0 mx-3 overflow-visible text-textmuted rtl:rotate-180"></i>
                          </a> </li>
                        
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
                      <button type="button" class="ti-btn ti-btn-warning-full text-white  ti-btn-icon me-2 !mb-0">
                        <i class="mdi mdi-refresh"></i>
                      </button>
                    </div>
                    
                  </div>
                </div>

                        <div class="xl:col-span-6 col-span-12">
                            <div class="box">
                                <div class="box-header flex justify-between">
                                    <div class="box-title">
                                        Tambah
                                    </div>
                                   
                                </div>
                                <div class="box-body !-mt-4">
                                    <form action="{{ url ('merk') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <div class="xl:col-span-12 col-span-12 mt-0">
                                            <label for="text" class="form-label">Kode merk</label>
                                            <input type="text" class="form-control" name="kode_merk" placeholder="Kode merk"
                                                  value="{{ 'MRK' . str_pad(App\Models\merk::count() + 1, 3, '0', STR_PAD_LEFT) }}" readonly>
                                        </div>

                                    
                                    <div class="xl:col-span-12 col-span-12 mt-0">
                                        <label for="text" class="form-label">Nama Merk</label>
                                        <input type="text" class="form-control "  name="nama_merk" placeholder="nama merk"
                                        value="{{old('nama_merk')}}">
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                    </div>
                                    
                                  
                            
                                        <button type="submit" class="ti-btn ti-btn-primary-full mt-2">Submit</button>
                                    </form>
                                </div>
                               

                                </div>
                            </div>
                        </div>
                        @endsection