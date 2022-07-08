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
                        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Layout</a></li>
                                <li class="breadcrumb-item active"><a href="javascript:void(0)">Blank</a></li>
                            </ol>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
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
                        </div>
                    </div>
                </div>
            </div>
        <!--**********************************
            Content body end
            ***********************************-->

            @endsection