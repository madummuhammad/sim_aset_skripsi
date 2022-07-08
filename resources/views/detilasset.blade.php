       @extends('main')

       @section('judul_halaman','Aset')

       @section('konten')
        <!--**********************************
            Content body start
            ***********************************-->
            <div class="content-body">
                <div class="container-fluid">
                    <div class="row page-titles mx-0">
                        <div class="col-sm-6 p-md-0">
                            <div class="welcome-text">
                                <h4>Hi, {{auth()->user()->nama_user}}!</h4>
                            </div>
                        </div>
                        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active"><a href="javascript:void(0)">Detail</a></li>
                            </ol>
                        </div>
                    </div>
                    <!-- row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title text-underline text-center text-uppercase w-100">{{$asset->nama_asset.' - '.$asset->id_asset}}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="basic-form">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>ID Asset</label>
                                                <p class="font-weight-bold text-dark">{{$asset->id_asset}}</p>
                                            </div>
                                            <input type="text" name="id_grup_aset" value="{{Request::segment(3)}}" hidden>
                                            <div class="form-group col-md-6">
                                                <label>Nama Asset</label>
                                                <p class="font-weight-bold text-dark">{{$asset->nama_asset}}</p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Harga Satuan</label>
                                                <p class="font-weight-bold text-dark">{{$asset->harga_satuan}}</p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Jenis Asset</label>
                                                <p class="font-weight-bold text-dark">{{$asset->id_jenis_asset.'-'.$asset->nama_jenis}}</p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Kategori Asset</label>
                                                <p class="font-weight-bold text-dark">{{$asset->id_kategori_asset.'-'.$asset->nama_kategori}}</p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Lokasi</label>
                                                <p class="font-weight-bold text-dark">{{$asset->kode_lokasi.'-'.$asset->nama_lokasi}}</p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Kondisi</label>
                                                <p class="font-weight-bold text-dark">{{$asset->kondisi}}</p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Satuan</label>
                                                <p class="font-weight-bold text-dark">{{$asset->satuan}}</p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Rentang Umur Ekonomis</label>
                                                <p class="font-weight-bold text-dark">{{$asset->umur_mulai}} - {{$asset->umur_akhir}}</p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>QR Code</label>
                                                <p>{!!QrCode::size(100)->generate(url('/asset/resultqr/'.$asset->id_asset))!!}</p>
                                            </div>
                                        </div>
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