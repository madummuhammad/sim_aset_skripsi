 @extends('main')

 @section('judul_halaman','Dashboard')

 @section('konten')
        <!--**********************************
            Content body start
            ***********************************-->
            <div class="content-body">
                <div class="container-fluid">
                    <div class="row page-titles mx-0">
                        <div class="col-sm-6 p-md-0">
                            <div class="welcome-text">
                                <h4>Selamat Datang, {{auth()->user()->nama}}</h4>
                                <p class="mb-0">Kelola Asetmu</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <a href="{{url('asset')}}">                                
                                <div class="card">
                                    <div class="stat-widget-one card-body d-flex align-items-center">
                                        <div class="stat-icon text-primary">
                                            <i class="fa-solid fa-boxes-stacked"></i>
                                        </div>
                                        <div class="stat-content">
                                            <div class="stat-text ">Jumlah Aset</div>
                                            <div class="stat-digit">{{$jml_asset}}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <a href="{{url('asset')}}">                                
                                <div class="card">
                                    <div class="stat-widget-one card-body d-flex align-items-center">
                                        <div class="stat-icon text-primary">
                                            <i class="fa-solid fa-boxes-stacked"></i>
                                        </div>
                                        <div class="stat-content">
                                            <div class="stat-text ">Aset Proses Mutasi</div>
                                            <div class="stat-digit">{{$mutasi}}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <a href="{{url('asset')}}">                                
                                <div class="card">
                                    <div class="stat-widget-one card-body d-flex align-items-center">
                                        <div class="stat-icon text-primary">
                                            <i class="fa-solid fa-boxes-stacked"></i>
                                        </div>
                                        <div class="stat-content">
                                            <div class="stat-text ">Aset Proses Pemusnahan</div>
                                            <div class="stat-digit">{{$pemusnahan}}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <a href="{{url('asset/mutasi')}}">                                
                                <div class="card">
                                    <div class="stat-widget-one card-body d-flex align-items-center">
                                        <div class="stat-icon text-primary">
                                            <i class="fa-solid fa-boxes-stacked"></i>
                                        </div>
                                        <div class="stat-content">
                                            <div class="stat-text ">Dokumen Pengajuan Mutasi</div>
                                            <div class="stat-digit">{{$pengajuan_mutasi}}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <a href="{{url('asset/pemusnahan')}}">                                
                                <div class="card">
                                    <div class="stat-widget-one card-body d-flex align-items-center">
                                        <div class="stat-icon text-primary">
                                            <i class="fa-solid fa-boxes-stacked"></i>
                                        </div>
                                        <div class="stat-content">
                                            <div class="stat-text ">Dokumen Pengajuan Pemusnahan</div>
                                            <div class="stat-digit">{{$pengajuan_pemusnahan}}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <a href="{{url('asset/mutasi')}}">                                
                                <div class="card">
                                    <div class="stat-widget-one card-body d-flex align-items-center">
                                        <div class="stat-icon text-primary">
                                            <i class="fa-solid fa-boxes-stacked"></i>
                                        </div>
                                        <div class="stat-content">
                                            <div class="stat-text ">Dokumen Mutasi Disetujui</div>
                                            <div class="stat-digit">{{$mutasi_disetujui}}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <a href="{{url('asset/pemusnahan')}}">                                
                                <div class="card">
                                    <div class="stat-widget-one card-body d-flex align-items-center">
                                        <div class="stat-icon text-primary">
                                            <i class="fa-solid fa-boxes-stacked"></i>
                                        </div>
                                        <div class="stat-content">
                                            <div class="stat-text ">Dokumen Pemusnahan Disetujui</div>
                                            <div class="stat-digit">{{$pemusnahan_disetujui}}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <!--**********************************
            Content body end
            ***********************************-->

            @endsection