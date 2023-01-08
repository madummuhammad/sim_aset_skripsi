       @extends('main')

       @section('judul_halaman','Mutasi')

       @section('konten')

        <!--**********************************
            Content body start
            ***********************************-->
            <div class="content-body">
                <div class="container-fluid">
                    <div class="row page-titles mx-0">
                        <div class="col-sm-6 p-md-0">
                            <div class="welcome-text">
                                <h4>Hi, {{auth()->user()->nama_user}}</h4>
                            </div>
                        </div>
                        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                            <ol class="breadcrumb">
                            </ol>
                        </div>
                    </div>
                    <!-- row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="profile">
                                <div class="profile-head">
                                    <div class="profile-info">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-8">
                                                <div class="row">
                                                    <div class="col-xl-4 col-sm-4 border-right-1 prf-col">
                                                        <div class="profile-name">
                                                            <h4 class="text-primary">{{auth()->user()->nama_user}}</h4>
                                                            <p>{{DB::table('hak_akses')->where('id_hak_akses',auth()->user()->id_hak_akses)->first()->nama_hak_akses}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-sm-4 border-right-1 prf-col">
                                                        <div class="profile-email">
                                                            <h4 class="text-muted">{{auth()->user()->email}}</h4>
                                                            <p>Email</p>
                                                        </div>
                                                    </div>
                                                <!-- <div class="col-xl-4 col-sm-4 prf-col">
                                                    <div class="profile-call">
                                                        <h4 class="text-muted">(+1) 321-837-1030</h4>
                                                        <p>Phone No.</p>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="profile-tab">
                                <div class="custom-tab-1">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a href="#profile" data-toggle="tab" class="nav-link active">Profile</a>
                                        </li>
                                        <li class="nav-item"><a href="#password" data-toggle="tab" class="nav-link">Ganti Password</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                     <div id="profile" class="tab-pane fade active show">
                                        <div class="pt-3">
                                            <div class="settings-form">
                                                <form action="{{url('user/profile')}}" method="POST">
                                                    @method('patch')
                                                    @csrf
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Email</label>
                                                            <input type="email" name="email" placeholder="Email" class="form-control" value="{{auth()->user()->email}}">
                                                            <input type="text" name="id_user" value="{{auth()->user()->id_user}}" hidden>
                                                            <input type="text" name="halaman" value="profile" hidden>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Username</label>
                                                            <input type="text" placeholder="Username" class="form-control" value="{{auth()->user()->username}}" name="username">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Nama User</label>
                                                            <input type="text" placeholder="Nama User" class="form-control" value="{{auth()->user()->nama_user}}" name="nama_user">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Telepon</label>
                                                            <input type="text" placeholder="No Telepon" class="form-control" value="{{auth()->user()->telepon}}" name="telepon">
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary" type="submit">Kirim Perubahan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="password" class="tab-pane fade">
                                        <div class="profile-about-me">
                                            <div class="pt-4 border-bottom-1 pb-4">
                                                <form>
                                                    <div class="form-group">
                                                        <label>Password lama</label>
                                                        <input type="text" placeholder="Password Lama" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password Baru</label>
                                                        <input type="text" placeholder="Password Baru" class="form-control">
                                                    </div>
                                                    <button class="btn btn-primary" type="submit">Ubah Sandi</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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
            <div class="footer">
                <div class="copyright">
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
        @endsection