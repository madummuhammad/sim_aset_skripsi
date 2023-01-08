       @extends('main')

       @section('judul_halaman', 'Aset')

       @section('konten')
       <div class="content-body">
         <div class="container-fluid">
             <div class="row page-titles mx-0">
                 <div class="col-sm-6 p-md-0">
                     <div class="welcome-text">
                         <h4>Hi, {{ auth()->user()->nama_user }}!</h4>

                     </div>
                 </div>
                 <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                     <ol class="breadcrumb">

                     </ol>
                 </div>
             </div>
             <!-- row -->
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <div class="card-header">
                             <h4 class="card-title">Asset</strong></u></h4>
                         </div>
                         <div class="card-body">
                             <div class="mb-3">
                                 <a href="{{ url('asset/create') }}" class="btn btn-primary btn-sm">Tambah Aset <i
                                     class="fa fa-plus text-white"></i></a>
                                     <a href="#mutasi" data-toggle="modal" class="btn btn-success btn-sm"
                                     id="mutasi-asset">Mutasi Aset <i class="fa-solid fa-rotate"></i></a>
                                     <a href="#pemusnahan" data-toggle="modal" class="btn btn-danger btn-sm"
                                     id="pemusnahan-asset">Pemusnahan Aset <i class="fas fa-trash"></i></a>

                                     <div class="modal fade" id="mutasi" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                     <div class="modal-dialog modal-dialog-centered" role="document">
                                         <div class="modal-content">
                                             <div class="modal-header">
                                                 <h5 class="modal-title" id="exampleModalLongTitle">Dokumen Mutasi
                                                 </h5>
                                                 <button type="button" class="close" data-dismiss="modal"
                                                 aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                             </button>
                                         </div>
                                         <div class="modal-body">
                                             <form class="mutasi-form">
                                                 @csrf
                                                 <div class="form-row">
                                                     <div class="form-group col-md-12">
                                                         <label>ID Mutasi</label>
                                                         <input type="text" name="id_mutasi"
                                                         class="form-control" placeholder=""
                                                         value="{{$id_mutasi}}" readonly>
                                                     </div>
                                                     <div class="form-group col-md-12">
                                                         <label>Nama</label>
                                                         <input type="text" name="nama" class="form-control"
                                                         placeholder="">
                                                     </div>
                                                     <div class="form-group col-md-12">
                                                         <label>Status Mutasi</label>
                                                         <input type="text" name="nama" class="form-control"
                                                         placeholder="" value="Dalam Proses" disabled>
                                                     </div>
                                                     <div class="form-group col-md-12">
                                                         <label>Lokasi Mutasi</label>
                                                         <select id="inputState" name="lokasi"
                                                         class="form-control">
                                                         <option selected value="">Pilih Lokasi...
                                                         </option>
                                                         @foreach ($lokasi as $value)
                                                         <option value="{{ $value->kode_lokasi }}">
                                                             {{ $value->nama_lokasi }}</option>
                                                             @endforeach
                                                         </select>
                                                     </div>
                                                     <div class="form-group col-md-12">
                                                         <label>Deskripsi</label>
                                                         <textarea name="deskripsi" id="" cols="30" rows="4" class="form-control"></textarea>
                                                     </div>
                                                 </div>
                                             </form>
                                         </div>
                                         <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary"
                                             data-dismiss="modal">Tutup</button>
                                             <button id="mutasi-asset" class="btn btn-primary">Kirim </button>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="modal fade" id="pemusnahan" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                             <div class="modal-dialog modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h5 class="modal-title" id="exampleModalLongTitle">Dokumen Pemusnahan
                                         </h5>
                                         <button type="button" class="close" data-dismiss="modal"
                                         aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>
                                 <div class="modal-body">
                                     <form class="pemusnahan-form">
                                         @csrf
                                         <div class="form-row">
                                             <div class="form-group col-md-12">
                                                 <label>ID Pemusnahan</label>
                                                 @if ($id_pemusnahan == null)
                                                 <input type="text" name="id_pemusnahan"
                                                 class="form-control" placeholder=""
                                                 value="1" readonly>
                                                 @else
                                                 <input type="text" name="id_pemusnahan"
                                                 class="form-control" placeholder=""
                                                 value="{{$id_pemusnahan}}"
                                                 readonly>
                                                 @endif
                                             </div>
                                             <div class="form-group col-md-12">
                                                 <label>Alasan Pemusnahan</label>
                                                 <input type="text" name="nama"
                                                 class="form-control" placeholder="">
                                             </div>
                                             <div class="form-group col-md-12">
                                                 <label>Status Pemusnahan</label>
                                                 <input type="text" name="status_pemusnahan"
                                                 class="form-control" placeholder=""
                                                 value="Dalam Proses" disabled>
                                             </div>
                                             <div class="form-group col-md-12">
                                                 <label>Deskripsi</label>
                                                 <textarea name="deskripsi" id="" cols="30" rows="4" class="form-control"></textarea>
                                             </div>
                                         </div>
                                     </form>
                                 </div>
                                 <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary"
                                     data-dismiss="modal">Tutup</button>
                                     <button id="pemusnahan-asset" class="btn btn-primary">Kirim
                                     </button>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <!-- <a href="" class="btn btn-success btn-sm" id="mutasi-inventory">Mutasi Aset <i class="fa-solid fa-arrow-rotate-left"></i></a> -->
                 </div>
                 <div class="table-responsive">
                     <table id="exampl" class="display table" style="min-width: 845px">
                         <thead>
                             <tr>
                                <th>No</th>
                                 <th>
                                     <input type="checkbox" class="main-checkbox">
                                 </th>
                                 <th>ID Asset</th>
                                 <th>Nama Asset</th>
                                 <!-- <th>Foto</th> -->
                                 <th>Lokasi</th>
                                 <th>Kondisi</th>
                                 <th>Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                             @php $no=1; @endphp
                             @foreach ($asset as $value)
                             <tr>
                                <td>{{$no++}}</td>
                                 <td>
                                     @if ($value->status_aset == 'Proses Mutasi')
                                     <a href="{{ url('asset/mutasi/') }}/{{ DB::table('transaksi_mutasi')->where('id_asset', $value->id_asset)->orderBy('id_mutasi', 'DESC')->first()->id_mutasi }}"
                                         class="badge badge-warning text-white">Proses Mutasi</a>
                                         @elseif ($value->status_aset == 'Proses Pemusnahan')
                                         <a href="{{ url('asset/pemusnahan/') }}/{{ DB::table('transaksi_pemusnahan')->where('id_asset', $value->id_asset)->orderBy('id_pemusnahan', 'DESC')->first()->id_pemusnahan }}"
                                             class="badge badge-warning text-white">Proses
                                         Pemusnahan</a>
                                         @else
                                         <input type="checkbox" class="asset-check"
                                         value="{{ $value->id_asset }}"
                                         data-lokasi="{{ $value->kode_lokasi }}">
                                         {{ $value->status_asset }}
                                         @endif
                                     </td>
                                     <td>{{ $value->id_asset }}</td>
                                     <td>{{ $value->nama_asset }}</td>
                                     @foreach ($value->lokasi as $lokasi)
                                     <td>{{ $lokasi->nama_lokasi }}</td>
                                     @endforeach
                                     <td>{{ $value->kondisi }}</td>
                                     <td>
                                         <img src="{{$value->gambar}}" alt="" style="width:100px;height: 100px;">
                                     </td>
                                     <td>
                                         <div class="btn-group">
                                             <a href="{{ url('asset/generateqr/') }}/{{ $value->id_asset }}"
                                                 class="btn btn-outline-dark btn-sm ">Unduh QR</a>
                                                 <a href="{{ url('asset/detil/') }}/{{ $value->id_asset }}"
                                                     class="btn btn-outline-primary btn-sm"><i
                                                     class="fas fa-eye"></i></a>
                                                     <a href="{{ url('asset/show/') }}/{{ $value->id_asset }}"
                                                         class="btn btn-outline-success btn-sm"><i
                                                         class="fa fa-edit"></i></a>
                                                         <button class="btn btn-outline-danger btn-sm"
                                                         data-toggle="modal"
                                                         data-target="#deleteasset{{ $no }}"><i
                                                         class="fa fa-trash"></i></button>
                                                         <div id="deleteasset{{ $no }}"
                                                         class="modal fade" tabindex="-1">
                                                         <div
                                                         class="modal-dialog model-sm modal-dialog-centered">
                                                         <div class="modal-content">
                                                             <div class="modal-body">
                                                                 <p class="font-weight-bold">Hapus data ini?
                                                                 </p>
                                                                 <p
                                                                 class="font-weight-bold text-danger text-center">
                                                                 Penghapusan ini hanya dilakukan ketika
                                                             ada kesalahan penginputan data!!</p>
                                                         </div>
                                                         <div class="modal-footer">
                                                             <button type="button"
                                                             class="btn btn-secondary"
                                                             data-dismiss="modal">Batal</button>
                                                             <form method="POST"
                                                             action="{{ url('asset') }}">
                                                             @csrf
                                                             @method('delete')
                                                             <input type="text" name="id_asset"
                                                             value="{{ $value->id_asset }}"
                                                             hidden>
                                                             <button type="submit"
                                                             class="btn btn-danger">Hapus</button>
                                                         </form>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </td>
                             </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
 </div>
</div>
</div>

@endsection
