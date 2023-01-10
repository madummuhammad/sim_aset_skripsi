       @extends('main')

       @section('judul_halaman', 'Aset')

       @section('konten')
       <div class="content-body">
           <div class="container-fluid">
               <div class="row page-titles mx-0">
                   <div class="col-sm-6 p-md-0">
                       <div class="welcome-text">
                           <h4>Hi, {{ auth()->user()->nama_user }}!</h4>
                           <span>Halaman ini digunakan untuk melihat detail mutasi yang di ajukan.</span>
                       </div>
                   </div>
                   <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                       <ol class="breadcrumb">
                           <li class="breadcrumb-item text-capitalize"><a
                               href="{{url('asset/pemusnahan')}}">{{ Request::segment(2) }}</a></li>
                               <li class="breadcrumb-item text-capitalize"><a
                                   href="javascript:void(0)">Detail</a></li>
                                   </ol>
                               </div>
                           </div>
                           <!-- row -->
                           <div class="row text-dark">
                               <div class="col-12">
                                   <div class="card">
                                       <div class="card-header">
                                           <h4 class="card-title">Dokumen Pemusnahan Asset</h4>
                                           @if ($pemusnahan->status_pemusnahan == 'Sudah Disetujui')
                                           <a href="{{url('asset/pemusnahan/bukti/')}}/{{Request::segment(3)}}" class="btn btn-primary">Upload Bukti Pelaksanaan <i class="fa-solid fa-arrow-up-from-bracket"></i></a>
                                           @endif
                                           @if ($pemusnahan->status_pemusnahan == 'Sudah Dilaksanakan')
                                           <a href="{{ url('laporan/pemusnahan/pdf/') }}/{{ Request::segment(3) }}"
                                           class="btn btn-primary">Berita Acara <i class="fa-solid fa-file-pdf"></i></a>
                                           @endif
                                           @if ($pemusnahan->status_pemusnahan == 'Sudah Disetujui')
                                           @elseif($pemusnahan->status_pemusnahan == 'Proses Pengajuan')
                                           @elseif($pemusnahan->status_pemusnahan=='Proses Pemusnahan')
                                           <button data-target="#ubahmutasi" data-toggle="modal" class="btn btn-success">Ubah <i
                                               class="fas fa-edit"></i></button>
                                               <div class="modal fade" id="ubahmutasi" tabindex="-1" role="dialog"
                                               aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                               <div class="modal-dialog modal-dialog-centered" role="document">
                                                   <form action="{{ url('asset/pemusnahan') }}" method="POST">
                                                       @csrf
                                                       @method('patch')
                                                       <div class="modal-content">
                                                           <div class="modal-header">
                                                               <h5 class="modal-title" id="exampleModalLongTitle">Edit Dokumen
                                                               Pemusnahan</h5>
                                                               <button type="button" class="close" data-dismiss="modal"
                                                               aria-label="Close">
                                                               <span aria-hidden="true">&times;</span>
                                                           </button>
                                                       </div>
                                                       <div class="modal-body">
                                                           <div class="form-row">
                                                               <div class="form-group col-md-12">
                                                                   <label>Alasan Pemusnahan</label>
                                                                   <input type="text" name="nama"
                                                                   value="{{ $pemusnahan->nama }}" class="form-control"
                                                                   placeholder="">
                                                                   <input type="text" name="id_pemusnahan"
                                                                   value="{{ $pemusnahan->id_pemusnahan }}" hidden>
                                                               </div>
                                                               <div class="form-group col-md-12">
                                                                   <label>Deskripsi</label>
                                                                   <textarea name="deskripsi" id="" cols="30" rows="4" class="form-control">{{ $pemusnahan->deskripsi }}</textarea>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="modal-footer">
                                                           <button type="button" class="btn btn-secondary"
                                                           data-dismiss="modal">Tutup</button>
                                                           <button class="btn btn-primary" type="submit">Simpan Perubahan
                                                               <i class="fa-solid fa-floppy-disk"></i></button>
                                                           </div>
                                                       </div>
                                                   </form>
                                               </div>
                                           </div>
                                           @endif
                                       </div>
                                       <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">                                        
                                               <div class="row py-2">
                                                   <div class="col-5">ID Pemusnahan</div>
                                                   <div class="col-7">: {{ $pemusnahan->id_pemusnahan }}</div>
                                               </div>
                                               <div class="row py-2">
                                                   <div class="col-5">Alasan Pemusnahan</div>
                                                   <div class="col-7">: {{ $pemusnahan->nama }}</div>
                                               </div>
                                               <div class="row py-2">
                                                   <div class="col-5">Penanggung Jawab</div>
                                                   @foreach ($pemusnahan->users as $penanggung_jawab)
                                                   <div class="col-7">: {{ $penanggung_jawab->nama_user }}</div>
                                                   @endforeach
                                               </div>
                                               <div class="row py-2">
                                                   <div class="col-5">Tanggal Pengajuan pemusnahan</div>
                                                   <div class="col-7">: {{ date('Y-m-d') }}</div>
                                               </div>
                                               <div class="row py-2">
                                                   <div class="col-5">Deskripsi</div>
                                                   <div class="col-7">: {{ $pemusnahan->deskripsi }}</div>
                                               </div>
                                               <div class="row py-2">
                                                   <div class="col-5">Status</div>
                                                   <div class="col-7">:
                                                       @if ($pemusnahan->status_pemusnahan == 'Sudah Disetujui')
                                                       <p class="badge badge-success text-white">Sudah Disetujui</p>
                                                       @elseif($pemusnahan->status_pemusnahan == 'Proses Pengajuan')
                                                       <p class="badge badge-warning text-white">Menunggu Persetujuan Kepala Sekolah
                                                       </p>
                                                       @elseif($pemusnahan->status_pemusnahan=='Proses Pemusnahan')
                                                       <p class="badge badge-danger text-white">Selesaikan Pengisian Data !</p>
                                                       @elseif($pemusnahan->status_pemusnahan=='Sudah Dilaksanakan')
                                                       <p class="badge badge-outline-success text-success">Sudah Dilaksanakan</p>
                                                       @else
                                                       <p class="badge badge-outline-danger text-danger">Ditolak</p>
                                                       @endif
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="col-4">
                                               <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach($asset as $index => $value)
                                                    <div class="carousel-item @if($index==0) active @endif">
                                                      <img src="{{$value->asset[0]->gambar}}" class="d-block w-100" alt="...">
                                                      <div class="carousel-caption d-none d-md-block">
                                                        <h5></h5>
                                                        <p>{{$value->asset[0]->id_asset}}</p>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @if ($pemusnahan->status_pemusnahan == 'Sudah Disetujui')
                                @elseif($pemusnahan->status_pemusnahan == 'Proses Pengajuan')
                                @elseif($pemusnahan->status_pemusnahan=='Proses Pemusnahan')
                                <a href="#tambahmutasi" data-toggle="modal"
                                class="btn btn-primary btn-sm my-2">Tambah Aset <i class="fas fa-plus"></i></a>
                                <div class="modal fade" id="tambahmutasi" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                   <form action="{{ url('asset/transaksi_pemusnahan') }}" method="POST">
                                       @method('post')
                                       @csrf
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h5 class="modal-title" id="exampleModalLabel">Pilih Aset</h5>
                                               <button type="button" class="close" data-dismiss="modal"
                                               aria-label="Close">
                                               <span aria-hidden="true">&times;</span>
                                           </button>
                                       </div>
                                       <div class="modal-body">
                                           <input type="text" value="{{ $pemusnahan->id_pemusnahan }}"
                                           name="id_pemusnahan" hidden>
                                           <input type="text" name="type" value="additional" hidden>
                                           <select class="multi-select" name="asset[]"
                                           multiple="multiple">
                                           @foreach ($inventory as $value)
                                           <option value="{{ $value->id_asset }}">
                                               {{ $value->id_asset . ' - ' . $value->nama_asset }}
                                           </option>
                                           @endforeach
                                       </select>
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary"
                                       data-dismiss="modal">Close</button>
                                       <button type="submit" class="btn btn-primary">Kirim</button>
                                   </div>
                               </div>
                           </form>
                       </div>
                   </div>
                   @endif
                   <div class="table-responsive mt-3">
                       <table class="table table-bordered table-responsive-sm text-dark">
                           <thead>
                               <tr>
                                   <th>Kode Asset</th>
                                   <th>Nama Asset</th>
                                   <th>Harga Per Satuan</th>
                                   <th>Lokasi Aset</th>
                                   <th>Kondisi</th>
                                   <th>Umur</th>
                                   <th>Tanggal Pembelian</th>
                                   <th>Aksi</th>
                               </tr>
                           </thead>
                           <tbody>
                               @php $no=1; @endphp
                               @foreach ($asset as $value)
                               <tr>
                                   <td>{{ $value->id_asset }}</td>
                                   @foreach ($value->asset as $assets)
                                   <td>{{ $assets->nama_asset }}</td>
                                   <td>{{ $assets->harga_satuan }}/{{ $assets->satuan }}</td>
                                   @foreach ($assets->lokasi as $lokasi)
                                   <td>{{ $lokasi->nama_lokasi }}</td>
                                   @endforeach
                                   <td>{{ $assets->kondisi }}</td>
                                   @endforeach
                                   <td>

                                    @php
                                    $tanggal1 = new DateTime($assets->umur_awal);
                                    $tanggal2 = new DateTime($assets->umur_akhir);
                                    $interval = $tanggal1->diff($tanggal2);
                                    echo $interval->format('%R%a Hari');
                                    @endphp

                                </td>
                                <td>{{date('d-m-Y',strtotime($assets->tgl_pembelian))}}</td>
                                <td>
                                   @if ($pemusnahan->status_pemusnahan == 'Proses Pemusnahan')
                                   <form action="{{ url('asset/transaksi_pemusnahan') }}"
                                   method="POST">
                                   @csrf
                                   @method('delete')
                                   <input type="text" name="id_pemusnahan"
                                   value="{{ $pemusnahan->id_pemusnahan }}" hidden>
                                   <input type="text" name="id_asset"
                                   value="{{ $value->id_asset }}" hidden>
                                   <input type="text" name="id_transaksi"
                                   value="{{ $value->id_transaksi }}" hidden>
                                   <button class="btn btn-danger btn-sm" type="submit"><i
                                       class="fa-solid fa-ban"></i></button>
                                   </form>
                                   @endif
                               </td>
                           </tr>
                           @endforeach
                       </tbody>
                   </table>
               </div>
               <div class="d-flex justify-content-center">
                   <a href="{{ url('asset/pemusnahan') }}" class="btn btn-warning mx-2"><i
                       class="fa-solid fa-angle-left"></i> Kembali</a>
                       @if($pemusnahan->status_pemusnahan=='Proses Pengajuan')
                       <button class="btn btn-danger mx-2" data-toggle="modal" data-target="#batalkan-pengajuan"><i class="fa-solid fa-ban"></i>
                       Batalkan Pengajuan</button>
                       <div id="batalkan-pengajuan" class="modal fade">
                         <div class="modal-dialog model-sm modal-dialog-centered">
                           <div class="modal-content">
                            <div class="modal-body">
                              <div class="d-flex align-items-center">                          
                                <div class="text-warning pr-4" style="font-size: 40px;">
                                  <i class="fa-solid fa-exclamation"></i>
                              </div>
                              <div>
                                <p class="font-weight-bold text-warning text-center m-0">Silahkan konfirmasi kepada Kepala Sekolah!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($pemusnahan->status_pemusnahan=='Proses Pemusnahan')
        <button class="btn btn-danger mx-2" data-toggle="modal"
        data-target="#deletepemusnahan"><i class="fa-solid fa-ban"></i> Batal
    Pengisian</button>
    <div id="deletepemusnahan" class="modal fade" tabindex="-1">
       <div class="modal-dialog model-sm modal-dialog-centered">
           <div class="modal-content">
               <div class="modal-body">
                   <p class="font-weight-bold my-0 text-center">Anda yakin akan
                   membatalkan pengisian data pemusnahan ini?</p>
                   <p class="font-weight-bold text-danger my-0 text-center">Semua
                   data yang di isi akan terhapus!!</p>
               </div>
               <div class="modal-footer border-0 pt-0">
                   <button type="button" class="btn btn-secondary btn-sm"
                   data-dismiss="modal">Batal</button>
                   <form action="{{ url('asset/pemusnahan') }}" method="POST">
                       @csrf
                       @method('delete')
                       @foreach ($asset as $value)
                       <input type="text" name="id_asset[]"
                       value="{{ $value->id_asset }}" hidden>
                       @endforeach
                       <input type="text" name="id_pemusnahan"
                       value="{{ $pemusnahan->id_pemusnahan }}" hidden>
                       <button type="submit"
                       class="btn btn-danger btn-sm">Hapus</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
   <div id="ajukan-pemusnahan" class="modal fade" tabindex="-1">
       <div class="modal-dialog model-sm modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-body">
              <div class="d-flex">                          
                <div class="text-warning pr-4" style="font-size: 40px;">
                  <i class="fa-solid fa-exclamation"></i>
              </div>
              <div>
                <p class="font-weight-bold text-warning text-center m-0">Anda yakin akan mengajuakn pemusnahan?</p>
                <p class="text-warning font-weight-bold m-0">Data yang diajukan tidak bisa dibatalkan</p>
            </div>
        </div>
        <form action="{{ url('asset/pemusnahan') }}" method="POST">
         @csrf
         @method('PATCH')
         <input type="text" name="id_pemusnahan"
         value="{{ $pemusnahan->id_pemusnahan }}" hidden>
         <input type="text" name="status" value="Proses Pengajuan" hidden>
         <div class="d-flex justify-content-end">
            <button class="btn btn-success mx-2"><i
               class="fa-solid fa-floppy-disk"></i>
           Ajukan pemusnahan</button>
       </div>
   </form>
</div>
</div>
</div>
</div>
<button class="btn btn-success" data-toggle="modal" data-target="#ajukan-pemusnahan"><i
 class="fa-solid fa-floppy-disk"></i>
Ajukan pemusnahan</button>
@endif
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
