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

    <!--*******************
        Preloader start
        ********************-->
        <div id="preloader">
            <div class="sk-three-bounce">
                <div class="sk-child sk-bounce1"></div>
                <div class="sk-child sk-bounce2"></div>
                <div class="sk-child sk-bounce3"></div>
            </div>
        </div>
    <!--*******************
        Preloader end
        ********************-->


    <!--**********************************
        Main wrapper start
        ***********************************-->
        <div id="main-wrapper">

        <!--**********************************
            Nav header start
            ***********************************-->
            <div class="nav-header">
                <a href="index.html" class="brand-logo">
                    Mts Attaqwa Jatingarang
                    <!-- <img class="logo-abbr" src="{{url('assets')}}/images/logo.png" alt=""> -->
                    <!-- <img class="logo-compact" src="{{url('assets')}}/images/logo-text.png" alt=""> -->
                    <!-- <img class="brand-title" src="{{url('assets')}}/images/logo-text.png" alt=""> -->
                </a>

                <div class="nav-control">
                    <div class="hamburger">
                        <span class="line"></span><span class="line"></span><span class="line"></span>
                    </div>
                </div>
            </div>
        <!--**********************************
            Nav header end
            ***********************************-->

        <!--**********************************
            Header start
            ***********************************-->
            <div class="header">
                <div class="header-content">
                    <nav class="navbar navbar-expand">
                        <div class="collapse navbar-collapse justify-content-between">
                            <div class="header-left" style="visibility: hidden;">
                                <div class="search_bar dropdown">
                                    <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                        <i class="mdi mdi-magnify"></i>
                                    </span>
                                    <div class="dropdown-menu p-0 m-0">
                                        <form>
                                            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <ul class="navbar-nav header-right">
                                <li class="nav-item dropdown notification_dropdown">
                                    <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                        <i class="mdi mdi-bell"></i>
                                        <?php if (DB::table('notifikasi')->where('read_at',NULL)->where('jenis_notifikasi','Pengajuan Mutasi')->orWhere('jenis_notifikasi','Pengajuan Pemusnahan')->count()>0 AND auth()->user()->id_hak_akses==3): ?>
                                        <div class="pulse-css"></div>
                                        @elseif(auth()->user()->id_hak_akses==1 AND DB::table('notifikasi')->where('read_at',NULL)->where('jenis_notifikasi','Pengecekan Kondisi')->count()>0 OR DB::table('notifikasi')->where('read_at',NULL)->where('jenis_notifikasi','Persetujuan Mutasi')->count()>0 OR DB::table('notifikasi')->where('read_at',NULL)->where('jenis_notifikasi','Persetujuan Pemusnahan')->count()>0)
                                        <div class="pulse-css"></div>
                                        @elseif(auth()->user()->id_hak_akses==2 AND DB::table('notifikasi')->where('read_at',NULL)->where('jenis_notifikasi','Pengecekan Kondisi')->count()>0 OR DB::table('notifikasi')->where('read_at',NULL)->where('jenis_notifikasi','Persetujuan Mutasi')->count()>0 OR DB::table('notifikasi')->where('read_at',NULL)->where('jenis_notifikasi','Persetujuan Pemusnahan')->count()>0)

                                        <div class="pulse-css"></div>
                                    <?php else: ?>
                                    <?php endif ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        @foreach(DB::table('notifikasi')->orderBy('id','DESC')->limit(5)->get() as $value)
                                        <?php if (auth()->user()->id_hak_akses==3 AND $value->jenis_notifikasi=='Pengajuan Mutasi' OR $value->jenis_notifikasi=='Pengajuan Pemusnahan'): ?>
                                        <li class="media dropdown-item @if($value->read_at==NULL) {{'bg-light'}} @endif">
                                            <!-- <span class="success"><i class="ti-user"></i></span> -->
                                            <div class="media-body">
                                                <form action="{{url('notifikasi')}}" method="POST">
                                                    @method('patch')
                                                    @csrf
                                                    <input type="text" name="id_notifikasi" value="{{$value->id}}" hidden>
                                                    <button class="btn btn-custom @if($value->read_at==NULL) {{'font-weight-bold text-dark'}} @endif" type="submit">
                                                        <p class="text-left">{{$value->keterangan}}
                                                        </p>
                                                        <p class="text-left">{{$value->id_asset}}</p>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="notify-time pl-5">
                                                <p>{{date('H:i',strtotime($value->created_at))}}</p>
                                                <p>{{date('d/m/Y',strtotime($value->created_at))}}</p>
                                            </div>
                                        </li>
                                        @elseif(auth()->user()->id_hak_akses==1 AND $value->jenis_notifikasi=='Pengecekan Kondisi' OR $value->jenis_notifikasi=='Persetujuan Mutasi' OR $value->jenis_notifikasi=='Persetujuan Pemusnahan')
                                        <li class="media dropdown-item @if($value->read_at==NULL) {{'bg-light'}} @endif">
                                            <!-- <span class="success"><i class="ti-user"></i></span> -->
                                            <div class="media-body">
                                                <form action="{{url('notifikasi')}}" method="POST">
                                                    @method('patch')
                                                    @csrf
                                                    <input type="text" name="id_notifikasi" value="{{$value->id}}" hidden>
                                                    <button class="btn btn-custom @if($value->read_at==NULL) {{'font-weight-bold text-dark'}} @endif" type="submit">
                                                        <p class="text-left">{{$value->keterangan}}
                                                        </p>
                                                        <p class="text-left">{{$value->id_asset}}</p>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="notify-time pl-5">
                                                <p>{{date('H:i',strtotime($value->created_at))}}</p>
                                                <p>{{date('d/m/Y',strtotime($value->created_at))}}</p>
                                            </div>
                                        </li>
                                        @elseif(auth()->user()->id_hak_akses==2 AND $value->jenis_notifikasi=='Pengecekan Kondisi' OR $value->jenis_notifikasi=='Persetujuan Mutasi' OR $value->jenis_notifikasi=='Persetujuan Pemusnahan')
                                        <li class="media dropdown-item @if($value->read_at==NULL) {{'bg-light'}} @endif">
                                            <!-- <span class="success"><i class="ti-user"></i></span> -->
                                            <div class="media-body">
                                                <form action="{{url('notifikasi')}}" method="POST">
                                                    @method('patch')
                                                    @csrf
                                                    <input type="text" name="id_notifikasi" value="{{$value->id}}" hidden>
                                                    <button class="btn btn-custom @if($value->read_at==NULL) {{'font-weight-bold text-dark'}} @endif" type="submit">
                                                        <p class="text-left">{{$value->keterangan}}
                                                        </p>
                                                        <p class="text-left">{{$value->id_asset}}</p>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="notify-time pl-5">
                                                <p>{{date('H:i',strtotime($value->created_at))}}</p>
                                                <p>{{date('d/m/Y',strtotime($value->created_at))}}</p>
                                            </div>
                                        </li>
                                    <?php endif ?>
                                    @endforeach
                                </ul>
                                <a class="all-notification" href="{{url('notifikasi')}}">Lihat semua notifikasi <i
                                    class="ti-arrow-right"></i></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{url('user/profile')}}" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="./email-inbox.html" class="dropdown-item">
                                        <i class="icon-envelope-open"></i>
                                        <span class="ml-2">Inbox </span>
                                    </a>
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="icon-key"></i>
                                            <span class="ml-2">Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
            ***********************************-->

        <!--**********************************
            Sidebar start
            ***********************************-->
            <div class="quixnav">
                <div class="quixnav-scroll">
                    <ul class="metismenu" id="menu">
                        <li class="nav-label first">Main Menu</li>
                    <!-- <li><a href="index.html"><i class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                    </li> -->
                    <li><a href="/" aria-expanded="false"><i class="icon icon-single-04-2"></i><span
                        class="nav-text">Dashboard</span></a></li>

                        <li class="nav-label">Master Data</li>
                        @if(auth()->user()->id_hak_akses !==3)
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="icon icon-app-store"></i><span class="nav-text">Master Data</span></a>
                            <ul aria-expanded="false">
                                <li><a href="{{url('asset')}}">Aset</a></li>
                                <li><a href="{{url('kategori')}}">Kategori Aset</a></li>
                                <li><a href="{{url('jenis_asset')}}">Jenis Aset</a></li>
                                <li><a href="{{url('lokasi')}}">Lokasi Aset</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="icon icon-app-store"></i><span class="nav-text">Transaksi</span></a>
                            <ul aria-expanded="false">
                                <li><a href="{{url('asset/mutasi')}}">Mutasi</a></li>
                                <li><a href="./chart-flot.html">Penghapusan</a></li>
                            </ul>
                        </li>
                        @endif
                        @if(auth()->user()->id_hak_akses==3)
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="icon icon-chart-bar-33"></i><span class="nav-text">Laporan</span></a>
                            <ul aria-expanded="false">
                                <li><a href="{{url('laporan/mutasi')}}">Mutasi</a></li>
                                <li><a href="./chart-flot.html">Penghapusan</a></li>
                                <li><a href="./chart-flot.html">Laporan Aset</a></li>
                            </ul>
                        </li>
                        @endif
                        <li class="nav-label">Pengaturan</li>
                        @if(auth()->user()->id_hak_akses !==3)
                        <li>
                            <a href="{{url('user')}}" aria-expanded="false"><i class="icon-custom fa-solid fa-users"></i><span
                                class="nav-text">Admin</span></a>
                            </li>
                            @endif
                            <li>
                                <a href="{{url('user/profile')}}" aria-expanded="false"><i class="icon icon-single-04-2"></i><span
                                    class="nav-text">Profile</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
        <!--**********************************
            Sidebar end
            ***********************************-->



            @yield('konten')


                    <!--**********************************
            Footer start
            ***********************************-->
            <div class="footer">
                <div class="copyright">
                    <!-- <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Quixkit</a> 2019</p> -->
                </div>
            </div>
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
        <script>

            $('.main-checkbox').on('click',function(){
                if (this.checked) {
                    $('.asset-check').prop('checked',true);
                } else {
                    $('.asset-check').prop('checked',false);
                }
            });

            $(".modal-footer #mutasi-asset").on('click',function(){
                if ($(".asset-check").is(':checked')) {
                    var assetCheck = $(".asset-check:checked");
                    var mutasinama=$(".mutasi-form [name=nama]").val();
                    var mutasilokasi=$(".mutasi-form [name=lokasi").val();
                    var mutasideskripsi=$(".mutasi-form [name=deskripsi").val();
                    var id_mutasi=$(".mutasi-form [name=id_mutasi]").val();
                    var csrf=$('input[name=_token]').val();
                    

                    $.ajax({
                        url: "{{url('asset/mutasi')}}",
                        type:'POST',
                        data:{
                            nama:mutasinama,
                            lokasi:mutasilokasi,
                            deskripsi:mutasideskripsi,
                            id_mutasi:id_mutasi,
                            _token:csrf
                        },
                        success: function(e){
                            for (let i = 0; i < assetCheck.length; i++) {
                                var id_asset=$(assetCheck[i]).val();
                                var kode_lokasi=$(assetCheck[i]).data('lokasi');

                                $.ajax({
                                    url: "{{url('asset/transaksi_mutasi')}}",
                                    type:'POST',
                                    data:{
                                        id_mutasi:id_mutasi,
                                        id_asset:id_asset,
                                        kode_lokasi:kode_lokasi,
                                        _token:csrf
                                    },
                                    success: function(e){
                                        setTimeout(function (){
                                            window.location.href="{{url('asset/mutasi/')}}"+'/'+id_mutasi
                                        }, 0);
                                    }
                                });
                            }
                        }
                    });

                }
            })

        </script>

    </body>

    </html>