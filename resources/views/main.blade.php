<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('judul_halaman')</title>
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="{{ asset('assets/vendor/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/chartist/css/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/icons/fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}">

</head>

@php
use App\Models\Notifikasi;

$hak_akses=auth()->user()->id_hak_akses;

if($hak_akses==3)
{
    $notifikasi=Notifikasi::where('jenis_notifikasi','Pengajuan Mutasi')->orWhere('jenis_notifikasi','Pengajuan Pemusnahan')->get();
}

if($hak_akses==1 OR $hak_akses==2)
{    
    $notifikasi=Notifikasi::where('jenis_notifikasi', 'Persetujuan Mutasi')->orWhere('jenis_notifikasi', 'Persetujuan Pemusnahan')->orWhere('jenis_notifikasi','Pengecekan Kondisi')->get();
}

$data=[];

foreach($notifikasi as $key=> $value){
    if($value->read_at==null){
        $data[$key]=$value;
    }
}

$jumlah=count($data);


@endphp
<body>

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="nav-header">
            <a class="brand-logo">
                Mts Attaqwa Jatingarang
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
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
                                        <input class="form-control" type="search" placeholder="Search"
                                        aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-bell"></i>
                                    @if($jumlah>0)
                                    <div class="pulse-css"></div>
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        @foreach ($notifikasi as $value)
                                        @if($value->read_at==null)
                                        <li class="media dropdown-item @if ($value->read_at == null) {{ 'bg-light' }} @endif">
                                            <div class="media-body">
                                                <form action="{{ url('notifikasi') }}" method="POST">
                                                    @method('patch')
                                                    @csrf
                                                    <input type="text" name="id_notifikasi"
                                                    value="{{ $value->id }}" hidden>
                                                    <button
                                                    class="btn btn-custom @if ($value->read_at == null) {{ 'font-weight-bold text-dark' }} @endif"
                                                    type="submit">
                                                    <p class="text-left">{{ $value->keterangan }}
                                                    </p>
                                                    <p class="text-left">{{ $value->id_asset }}</p>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="notify-time pl-5">
                                            <p>{{ date('H:i', strtotime($value->created_at)) }}</p>
                                            <p>{{ date('d/m/Y', strtotime($value->created_at)) }}</p>
                                        </div>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                                <a class="all-notification" href="{{ url('notifikasi') }}">Lihat semua notifikasi
                                    <i class="ti-arrow-right"></i></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ url('user/profile') }}" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
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
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <li><a href="/" aria-expanded="false"><i class="icon icon-single-04-2"></i><span
                        class="nav-text">Dashboard</span></a></li>

                        <li class="nav-label">Master Data</li>
                        @if (auth()->user()->id_hak_akses !== 3)
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="icon icon-app-store"></i><span class="nav-text">Master Data</span></a>
                            <ul aria-expanded="false">
                                <li><a href="{{ url('asset') }}">Semua Aset</a></li>
                                <li><a href="{{ url('asset_dimusnahkan') }}">Aset Dimusnahkan</a></li>
                                <li><a href="{{ url('kategori') }}">Kategori Aset</a></li>
                                <li><a href="{{ url('jenis_asset') }}">Jenis Aset</a></li>
                                <li><a href="{{ url('lokasi') }}">Lokasi Aset</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="icon icon-app-store"></i><span class="nav-text">Transaksi</span></a>
                            <ul aria-expanded="false">
                                <li><a href="{{ url('asset/mutasi') }}">Mutasi</a></li>
                                <li><a href="{{ url('asset/pemusnahan') }}">Pemusnahan</a></li>
                            </ul>
                        </li>
                        @endif
                        @if (auth()->user()->id_hak_akses == 3)
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="icon icon-chart-bar-33"></i><span class="nav-text">Laporan</span></a>
                            <ul aria-expanded="false">
                                <li><a href="{{ url('laporan/mutasi') }}">Mutasi</a></li>
                                <li><a href="{{url('laporan/pemusnahan')}}">Pemusnahan</a></li>
                                <li><a href="{{url('laporan/asset')}}">Laporan Aset</a></li>
                            </ul>
                        </li>
                        @endif
                        <li class="nav-label">Pengaturan</li>
                        @if (auth()->user()->id_hak_akses !== 3 and auth()->user()->id_hak_akses !== 2)
                        <li>
                            <a href="{{ url('user') }}" aria-expanded="false"><i
                                class="icon-custom fa-solid fa-users"></i><span class="nav-text">Admin</span></a>
                            </li>
                            @endif
                            <li>
                                <a href="{{ url('user/profile') }}" aria-expanded="false"><i
                                    class="icon icon-single-04-2"></i><span class="nav-text">Profile</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    @yield('konten')
                    <div class="footer">
                        <div class="copyright">

                        </div>
                    </div>
                </div>
                <!-- Required vendors -->
                <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
                <script src="{{ asset('assets/js/quixnav-init.js') }}"></script>
                <script src="{{ asset('assets/js/custom.min.js') }}"></script>

                <script src="{{ asset('assets/vendor/chartist/js/chartist.min.js') }}"></script>

                <script src="{{ asset('assets/vendor/moment/moment.min.js') }}"></script>
                <script src="{{ asset('assets/vendor/pg-calendar/js/pignose.calendar.min.js') }}"></script>


                <script src="{{ asset('assets/js/dashboard/dashboard-2.js') }}"></script>
                <!-- Circle progress -->

                <!-- Datatable -->
                <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
                <script src="{{ asset('assets/js/plugins-init/datatables.init.js') }}"></script>
                <script src="{{ asset('assets/icons/fontawesome/js/all.js') }}"></script>

                <script src="{{ asset('assets/vendor/select2/js/select2.full.min.js') }}"></script>
                <script src="{{ asset('assets/js/plugins-init/select2-init.js') }}"></script>
                <script src="{{ asset('assets/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}">
                </script>
                <script src="{{ asset('assets/js/plugins-init/material-date-picker-init.js') }}"></script>
                <script>
                    $('.main-checkbox').on('click', function() {
                        if (this.checked) {
                            $('.asset-check').prop('checked', true);
                        } else {
                            $('.asset-check').prop('checked', false);
                        }
                    });

                    $(".modal-footer #mutasi-asset").on('click', function() {
                        if ($(".asset-check").is(':checked')) {
                            $(this).attr('disabled',true);
                            var assetCheck = $(".asset-check:checked");
                            var mutasinama = $(".mutasi-form [name=nama]").val();
                            var mutasilokasi = $(".mutasi-form [name=lokasi").val();
                            var mutasideskripsi = $(".mutasi-form [name=deskripsi").val();
                            var id_mutasi = $(".mutasi-form [name=id_mutasi]").val();
                            var csrf = $('input[name=_token]').val();
                            var asset=[];
                            for (var i = 0; i < assetCheck.length; i++) {
                                asset[i]={
                                    id_asset:assetCheck[i].value,
                                    lokasi_sebelumnya:$(assetCheck[i]).data('lokasi')
                                }
                            }
                            mutasi(mutasinama,mutasilokasi,mutasideskripsi,id_mutasi,asset,csrf,$(this))

                        }
                    });

                    function mutasi(mutasinama,mutasilokasi,mutasideskripsi,id_mutasi,asset,csrf,button)
                    {
                        $.ajax({
                            url: "{{ url('asset/mutasi') }}",
                            type: 'POST',
                            data: {
                                nama: mutasinama,
                                lokasi: mutasilokasi,
                                deskripsi: mutasideskripsi,
                                id_mutasi: id_mutasi,
                                _token: csrf
                            },
                            success: function(e) {
                                console.log('mutasi',e);
                                if(e.status!=='error'){
                                    transaksi_mutasi(id_mutasi,asset,csrf,button)
                                } else {
                                    button.removeAttr('disabled');
                                }

                            }
                        });
                    }

                    function transaksi_mutasi(id_mutasi,asset,csrf,button)
                    {
                        $.ajax({
                            url: "{{ url('asset/transaksi_mutasi') }}",
                            type: 'POST',
                            data: {
                                id_mutasi: id_mutasi,
                                asset: asset,
                                _token: csrf
                            },
                            success: function(e) {
                                console.log('transaksi_mutasi',e);
                                if(e.status=='success'){                            
                                    setTimeout(function() {
                                        window.location.href =
                                        "{{ url('asset/mutasi/') }}" + '/' +
                                        id_mutasi
                                    }, 0);
                                } else {
                                    button.removeAttr('disabled');
                                }
                            }
                        });
                    }

                    $(".modal-footer #pemusnahan-asset").on('click', function() {
                        if ($(".asset-check").is(':checked')) {
                            $(this).attr('disabled',true);
                            var assetCheck = $(".asset-check:checked");
                            var pemusnahannama = $(".pemusnahan-form [name=nama]").val();
                            var pemusnahanlokasi = $(".pemusnahan-form [name=lokasi").val();
                            var pemusnahandeskripsi = $(".pemusnahan-form [name=deskripsi").val();
                            var id_pemusnahan = $(".pemusnahan-form [name=id_pemusnahan]").val();
                            var csrf = $('input[name=_token]').val();
                            var asset=[];
                            for (var i = 0; i < assetCheck.length; i++) {
                                asset[i]=assetCheck[i].value;
                            }
                            pemusnahan(pemusnahannama,pemusnahandeskripsi,id_pemusnahan,csrf,asset,$(this));

                        }
                    })

                    function pemusnahan(pemusnahannama,pemusnahandeskripsi,id_pemusnahan,csrf,asset,button)
                    {
                        $.ajax({
                            url: "{{ url('asset/pemusnahan') }}",
                            type: 'POST',
                            data: {
                                nama: pemusnahannama,
                                deskripsi: pemusnahandeskripsi,
                                id_pemusnahan: id_pemusnahan,
                                _token: csrf
                            },
                            success: function(e) {
                                console.log('pemusnahan',e);
                                if(e.status!=='error'){
                                    $(this).attr('disabled',true);
                                    transaksi_pemusnahan(asset,csrf,id_pemusnahan,button);
                                } else {
                                    button.removeAttr('disabled');
                                }
                            }
                        });
                    }

                    function transaksi_pemusnahan(asset,csrf,id_pemusnahan,button)
                    {
                        $.ajax({
                            url: "{{ url('asset/transaksi_pemusnahan') }}",
                            type: 'POST',
                            data: {
                                id_pemusnahan: id_pemusnahan,
                                asset: asset,
                                _token: csrf
                            },
                            success: function(e) {
                                console.log('transaksi pemusnahan',e);
                                if(e.status=='success')
                                {                            
                                    $(this).attr('disabled',true);
                                    window.location.href ="{{ url('asset/pemusnahan/') }}" +'/' +id_pemusnahan
                                } else {
                                    button.removeAttr('disabled');
                                }
                            }
                        });
                    }
                </script>

            </body>

            </html>
