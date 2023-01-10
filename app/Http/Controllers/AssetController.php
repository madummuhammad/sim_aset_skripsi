<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Collection;
use PDF;
use App\Models\Mutasi;
use App\Models\Lokasi;
use App\Models\Asset;
use App\Models\Kategori;
use App\Models\Jenis;
use App\Models\Pemusnahan;
use Validator;
use Carbon\Carbon;
use Storage;

class AssetController extends Controller
{
    public function index()
    {
        $data = [];
        $data['id_mutasi'] = $this->number_mutasi();
        $data['id_pemusnahan'] = $this->number_pemusnahan();
        $data['lokasi'] = Lokasi::get();
        $data['asset'] = Asset::where('status_aset','!=','Dimusnahkan')->with('lokasi')->orderBy('created_at','DESC')->get();
        return view('asset', $data);
    }


    public function dimusnahkan()
    {
        $data = [];
        $data['id_mutasi'] = $this->number_mutasi();
        $data['id_pemusnahan'] = $this->number_pemusnahan();
        $data['lokasi'] = Lokasi::get();
        $data['asset'] = Asset::where('status_aset','Dimusnahkan')->with('lokasi')->orderBy('id_asset','ASC')->get();
        return view('asset_dimusnahkan', $data);
    }

    public function laporan()
    {
        $data = [];
        $data['id_mutasi'] = $this->number_mutasi();
        $data['id_pemusnahan'] = $this->number_pemusnahan();
        $data['lokasi'] = Lokasi::get();
        $data['asset'] = Asset::where('status_aset','!=','Dimusnahkan')->with('lokasi')->orderBy('id_asset','ASC')->get();
        return view('laporanasset',$data);
    }

    public function pdf()
    {
        $bulanIndonesia = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $hariIndonesia = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
        $data = [];
        $data['lokasi'] = Lokasi::get();



        $data['tanggal']=$hariIndonesia[date("w")].','.' '.date('d').' '.$bulanIndonesia[date('n')-1].' '.date('Y');
        $data['asset'] = Asset::where('status_aset','!=','Dimusnahkan')->with('lokasi')->orderBy('id_asset','ASC')->get();
        $pdf = PDF::loadview('laporanassetpdf',$data);
        return $pdf->download('laporan-asset.pdf');
    }

    public function create()
    {
        $id_kategori=Kategori::orderByDesc('id_kategori_asset')->withTrashed()->limit(1)->first();
        if ($id_kategori !==NULL) {
            $a=preg_replace("/KTG-/", "", $id_kategori->id_kategori_asset)+1;
            $data['id_kategori']='KTG-'.$a;
        } else {
            $data['id_kategori']='KTG-1';
        }

        $id_jenis_asset=Jenis::orderByDesc('id_jenis_asset')->withTrashed()->limit(1)->first();
        if ($id_jenis_asset !==NULL) {
            $a=preg_replace("/JNS-/", "", $id_jenis_asset->id_jenis_asset)+1;
            $data['id_jenis_asset']='JNS-'.$a;
        } else {
            $data['id_jenis_asset']='JNS-1';
        }
        $data['kategori_asset']=Kategori::get();
        $data['jenis_asset']=Jenis::all();
        $data['lokasi']=Lokasi::all();
        return view('createasset',$data);
    }

    public function store(Request $request)
    {
        $dataValidation=[
            'nama_asset'=>$request->nama_asset,
            'harga_satuan'=>$request->harga_satuan,
            'kode_lokasi'=>$request->kode_lokasi,
            'id_jenis_asset'=>$request->id_jenis_asset,
            'id_kategori_asset'=>$request->id_kategori_asset,
            'id_user'=>auth()->user()->id_user,
            'kondisi'=>$request->kondisi,
            'tgl_input'=>$request->tgl_input,
            'satuan'=>$request->satuan,
            'tgl_pembelian'=>$request->tgl_pembelian,
            'umur_mulai'=>$request->umur_mulai,
            'umur_akhir'=>$request->umur_akhir,
            'jumlah'=>$request->jumlah,
            'status_aset'=>'Tersedia'
        ];

        $messageValidatioin=[
            'nama_asset.required'=>'Nama aset tidak boleh kosong',
            'nama_asset.regex'=>'Nama aset hanya berupa huruf dan spasi',
            'harga_satuan.required'=>'Harga satuan tidak boleh kosong',
            'harga_satuan.numeric'=>'Harga satuan harus berupa angka',
            'kode_lokasi.required'=>'Kode lokasi tidak boleh kosong',
            'id_jenis_asset.required'=>'Jenis aset tidak boleh kosong',
            'id_kategori_asset.required'=>'Kategori aset tidak boleh kosong',
            'kondisi.required'=>'Kondisi aset tidak boleh kosong',
            'jumlah.required'=>'Jumlah aset tidak boleh kosong',
            'jumlah.numeric'=>'Format jumlah aset salah',
            'tgl_input.required'=>'Tanggal input tidak boleh kosong',
            'satuan.required'=>'Satuan tidak boleh kosong',
            'umur_mulai.required'=>'Umur mulai tidak boleh kosong',
            'tgl_pembelian.required'=>'Umur mulai tidak boleh kosong',
            'umur_akhir.required'=>'Umur akhir tidak boleh kosong',
        ];


        $validator=Validator::make($dataValidation,[
            'nama_asset'=>'required|regex:/^[a-zA-Z ]+$/u',
            'harga_satuan'=>'required|numeric',
            'kode_lokasi'=>'required',
            'id_jenis_asset'=>'required',
            'id_kategori_asset'=>'required',
            'kondisi'=>'required',
            'jumlah'=>'required|numeric',
            'tgl_input'=>'required',
            'satuan'=>'required',
            'umur_mulai'=>'required',
            'tgl_pembelian'=>'required',
            'umur_akhir'=>'required',
        ],$messageValidatioin);

        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput($dataValidation);
        }

        for ($i=0; $i < $request->jumlah ; $i++) {
            $data=[
                'id_asset'=>$this->number_asset(),
                'nama_asset'=>$request->nama_asset,
                'harga_satuan'=>$request->harga_satuan,
                'kode_lokasi'=>$request->kode_lokasi,
                'id_jenis_asset'=>$request->id_jenis_asset,
                'id_kategori_asset'=>$request->id_kategori_asset,
                'id_user'=>auth()->user()->id_user,
                'kondisi'=>$request->kondisi,
                'tgl_input'=>date('d/m/Y'),
                'satuan'=>$request->satuan,
                'umur_mulai'=>$request->umur_mulai,
                'tgl_pembelian'=>$request->tgl_pembelian,
                'umur_akhir'=>$request->umur_akhir,
                'status_aset'=>'Tersedia',
                'gambar'=>'https://ionicframework.com/docs/img/demos/thumbnail.svg'
            ];

            Asset::create($data);

        }
        return redirect('asset');

    }

    public function show($id_asset)
    {
        $data['kategori_asset']=Kategori::all();
        $data['jenis_asset']=Jenis::all();
        $data['lokasi']=Lokasi::all();
        $data['asset']=Asset::where('id_asset',$id_asset)->first();
        return view('showasset',$data);
    }

    public function detail($id_asset)
    {
        $data['kategori_asset']=Kategori::all();
        $data['jenis_asset']=Jenis::all();
        $data['lokasi']=Lokasi::all();
        $data['asset']=Asset::with('lokasi')->with('kategori')->with('jenis')->where('id_asset',$id_asset)->first();

        return view('detilasset',$data);
    }

    public function resultqr($id_asset)
    {

        $data['kategori_asset']=Kategori::all();
        $data['jenis_asset']=Jenis::all();
        $data['lokasi']=Lokasi::all();
        $data['asset']=Asset::with('lokasi')->with('kategori')->with('jenis')->where('id_asset',$id_asset)->first();
        return view('resultqr',$data);
    }

    public function update(Request $request)
    {
        $foto=$_FILES['foto']['error'];
        $data=[
            'nama_asset'=>$request->nama_asset,
            'harga_satuan'=>$request->harga_satuan,
            'kode_lokasi'=>$request->kode_lokasi,
            'id_user'=>auth()->user()->id_user,
            'kondisi'=>$request->kondisi,
            'satuan'=>$request->satuan,
            'umur_mulai'=>$request->umur_mulai,
            'umur_akhir'=>$request->umur_akhir
        ];

        $dataValidation=[
            'nama_asset'=>$request->nama_asset,
            'harga_satuan'=>$request->harga_satuan,
            'kode_lokasi'=>$request->kode_lokasi,
            'id_user'=>auth()->user()->id_user,
            'kondisi'=>$request->kondisi,
            'satuan'=>$request->satuan,
            'umur_mulai'=>$request->umur_mulai,
            'umur_akhir'=>$request->umur_akhir
        ];

        $messageValidatioin=[
            'nama_asset.required'=>'Nama aset tidak boleh kosong',
            'nama_asset.regex'=>'Nama aset hanya berupa huruf dan spasi',
            'harga_satuan.required'=>'Harga satuan tidak boleh kosong',
            'harga_satuan.numeric'=>'Harga satuan harus berupa angka',
            'kode_lokasi.required'=>'Kode lokasi tidak boleh kosong',
            'id_jenis_asset.required'=>'Jenis aset tidak boleh kosong',
            'id_kategori_asset.required'=>'Kategori aset tidak boleh kosong',
            'kondisi.required'=>'Kondisi aset tidak boleh kosong',
            'satuan.required'=>'Satuan tidak boleh kosong',
            'umur_mulai.required'=>'Umur mulai tidak boleh kosong',
            'umur_akhir.required'=>'Umur akhir tidak boleh kosong',
        ];


        $validator=Validator::make($dataValidation,[
            'nama_asset'=>'required|regex:/^[a-zA-Z ]+$/u',
            'harga_satuan'=>'required|numeric',
            'kode_lokasi'=>'required',
            'id_user'=>'required',
            'kondisi'=>'required',
            'satuan'=>'required',
            'umur_mulai'=>'required',
            'umur_akhir'=>'required',
        ],$messageValidatioin);

        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput($dataValidation);
        }

        Asset::find($request->id_asset)->update($data);


        if($foto==0)
        {
            $disk = Storage::disk('public')->put('image', $request->file('foto'));
            $url_image=asset('storage/').'/'.$disk;
            Asset::find($request->id_asset)->update(['gambar'=>$url_image]);
        }
        return back();
    }

    public function destroy(Request $id)
    {
        Asset::find($id->id_asset)->delete();

        return redirect('asset');
    }

    public function Allasset()
    {
        return Asset::whereNotIn('status_aset',['Proses Mutasi','Proses Pemusnahan'])->get();
    }

    public function generateqr($id_asset)
    {
       $data['kategori_asset']=Kategori::all();
       $data['jenis_asset']=Jenis::all();
       $data['lokasi']=Lokasi::all();
       $data['asset']=Asset::with('lokasi')->with('kategori')->with('jenis')->where('id_asset',$id_asset)->first();
       $data['qrcode']=QrCode::size(100)->generate(url(''));
       $pdf = PDF::loadview('generateqrasset',$data);
       return $pdf->download('QR-Code-'.$id_asset.'.pdf');
   }

   public function jml_asset()
   {
    return Asset::where('status_aset','!=','Dimusnahkan')->count();
}

public function dashboard()
{
    $data['jml_asset']=Asset::where('status_aset','!=','Dimusnahkan')->count();
    $data['mutasi']=Asset::where('status_aset','Proses Mutasi')->count();
    $data['pemusnahan']=Asset::where('status_aset','Proses Pemusnahan')->count();
    $data['pengajuan_mutasi']=Mutasi::where('status_mutasi','Proses Mutasi')->count();
    $data['mutasi_disetujui']=Mutasi::where('status_mutasi','Sudah Disetujui')->count();
    $data['pengajuan_pemusnahan']=Pemusnahan::where('status_pemusnahan','Proses Pemusnahan')->count();
    $data['pemusnahan_disetujui']=Pemusnahan::where('status_pemusnahan','Sudah Disetujui')->orWhere('status_pemusnahan','Sudah Dilaksanakan')->count();
    return view('dashboard',$data);
}

function number_pemusnahan()
{
    $now = Carbon::now();
    $pemusnahan = Pemusnahan::whereMonth('created_at', '=', $now->month)->whereYear('created_at', '=', $now->year)->withTrashed()->get();
    if(count($pemusnahan)==0)
    {
        $nomor=1;
    } else {
        $nomor=count($pemusnahan)+1;
    }
    return $id_pemusnahan='PEMUSNAHAN-'.date('Y').date('m').'-'.sprintf("%04d",$nomor);
}

function number_mutasi()
{
    $now = Carbon::now();
    $mutasi = Mutasi::whereMonth('created_at', '=', $now->month)->whereYear('created_at', '=', $now->year)->withTrashed()->get();
    if(count($mutasi)==0)
    {
        $nomor=1;
    } else {
        $nomor=count($mutasi)+1;
    }
    return $id_mutasi='MUTASI-'.date('Y').date('m').'-'.sprintf("%04d",$nomor);
}

function number_asset()
{
    $now = Carbon::now();
    $asset = Asset::whereMonth('created_at', '=', $now->month)->whereYear('created_at', '=', $now->year)->where('id_kategori_asset',request('id_kategori_asset'))->where('id_jenis_asset',request('id_jenis_asset'))->withTrashed()->get();
    if(count($asset)==0)
    {
        $nomor=1;
    } else {
        $nomor=count($asset)+1;
    }
    return $id_mutasi='ASST_'.request('id_kategori_asset').'_'.request('id_jenis_asset').'_'.date('Y').date('m').'_'.sprintf("%05d",$nomor);
}


}