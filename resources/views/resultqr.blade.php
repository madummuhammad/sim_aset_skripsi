<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('judul_halaman')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="{{asset('assets/vendor/pg-calendar/css/pignose.calendar.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/chartist/css/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/icons/fontawesome/css/all.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/vendor/select2/css/select2.min.css')}}">

</head>

<body>


    <!--**********************************
        Main wrapper start
        ***********************************-->
        <div id="main-wrapper">

        <!--**********************************
            Content body start
            ***********************************-->
            <div class="content-ody">
                <div class="container-fluid">
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

                    <!--**********************************
            Footer start
            ***********************************-->
           <!--  <div class="footer">
                <div class="copyright">
                    <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Quixkit</a> 2019</p>
                </div>
            </div> -->
        <!--**********************************
            Footer end
            ***********************************-->

        <!--**********************************
           Support ticket button start
           ***********************************-->

        <!--**********************************
           Support ticket button end
           ***********************************-->


       </div>
    <!--**********************************
        Main wrapper end
        ***********************************-->

    <!--**********************************
        Scripts
        ***********************************-->
        <!-- Required vendors -->
        <script src="{{asset('assets/vendor/global/global.min.js')}}"></script>
        <script src="{{asset('assets/js/quixnav-init.js')}}"></script>
        <script src="{{asset('assets/js/custom.min.js')}}"></script>

        <script src="{{asset('assets/vendor/chartist/js/chartist.min.js')}}"></script>

        <script src="{{asset('assets/vendor/moment/moment.min.js')}}"></script>
        <script src="{{asset('assets/vendor/pg-calendar/js/pignose.calendar.min.js')}}"></script>


        <script src="{{asset('assets/js/dashboard/dashboard-2.js')}}"></script>
        <!-- Circle progress -->

        <!-- Datatable -->
        <script src="{{asset('assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/js/plugins-init/datatables.init.js')}}"></script>
        <script src="{{asset('assets/icons/fontawesome/js/all.js')}}"></script>

        <script src="{{asset('assets/vendor/select2/js/select2.full.min.js')}}"></script>
        <script src="{{asset('assets/js/plugins-init/select2-init.js')}}"></script>
        <script src="{{asset('assets/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
        <script src="{{asset('assets/js/plugins-init/material-date-picker-init.js')}}"></script>
    </body>

    </html>