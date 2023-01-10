<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Laporan Mutasi</title>
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">

</head>
<style>
    body {
        margin: 0;
        font-family: "Roboto", serif;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1.5;
        text-align: left;
    }

    table {
        border-collapse: collapse;
        margin-bottom: 1rem;
        padding-right: 15px;
        padding-left: 15px;
    }

    .table {
        width: 100%;
    }

    .table th,
    .table td {
        padding: 0.2rem;
        vertical-align: top;
        border: 1px solid #000000;
    }

    .table thead th {
        vertical-align: bottom;
        border: 2px solid #000000;
    }

    .kop-surat {
        width: 100%;
        align-items: center;
    }

    .kop {
        line-height: 10px;
        text-align: center;
        margin-left: 12%;
    }

    .kop .alamat p {
        line-height: 4px !important;
        margin-top: -4px;
    }

    .logo {
        position: absolute;
    }

    .logo img {
        width: 100px;
    }

    .fs-60px {
        font-size: 23px;
    }

    .line {
        width: 100%;
    }

    .w-100 {
        width: 100%;
    }

    .tanda-tangan {
        margin-right: 0;
        width: 100%;
    }

    .ttd {
        right: 10px;
        position: absolute;
        text-align: center;
        height: 100px;
    }

    .ttd_grup {
        position: absolute;
    }

    .ttd_img {
        width: 200px;
        margin: 10px;
        position: absolute;
    }
</style>

<body>
    <div class="kop-surat">
        <div class="logo">
            <img src="{{url('assets/images/logo_mts.png')}}" alt="">
        </div>
        <div class="kop">
            <h2>YAYASAN AT - TAQWA JATINGARANG</h2>
            <h1 class="fs-60px">MADRASAH TSANAWIYAH (MTs) AT-TAQWA</h1>
            <h2>TERAKREDITASI A</h2>
            <div class="alamat">
                <p>Alamat : Jl. Bodeh-Watukumpul Jatingarang Bodeh Pemalang</p>
                <p>52365 +6287830584333 E-mail : mtsattaqwa2005@gmail.com</p>
            </div>
        </div>
        <img class="line" src="{{url('assets/images/line.png')}}" alt="">
        <p style="text-align: center; font-weight:bold; text-decoration:underline">Berita Acara</p>
        <p style="text-align: center; font-weight:bold;">{{$pemusnahan->id_pemusnahan}}</p>
    </div>
    <table>
        <tbody>
            <tr>
                <td>ID Pemusnahan</td>
                <td>:</td>
                <td>{{ $pemusnahan->id_pemusnahan }}</td>
            </tr>
            <tr>
                <td>Alasan Pemusnahan</td>
                <td>:</td>
                <td>{{ $pemusnahan->nama }}</td>
            </tr>
            <tr>
                <td>Penanggung Jawab</td>
                <td>:</td>
                @foreach($pemusnahan->users as $value)
                <td>{{ $value->nama_user }}</td>
                @endforeach
            </tr>
            <tr>
                <td>Tanggal Pengajuan Pemusnahan</td>
                <td>:</td>
                <td>{{ date('Y-m-d') }}</td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td>:</td>
                <td>{{ $pemusnahan->deskripsi }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>:</td>
                <td>Dilaksanakan</td>
            </tr>
        </tbody>
    </table>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Asset</th>
                <th>Nama Asset</th>
                <th>Harga Per Satuan</th>
                <th>Kondisi</th>
                <th>Tanggal Pembelian</th>
                <th>Umur Ekonomis</th>
            </tr>
        </thead>
        <tbody>
            @php $no=0; @endphp
            @foreach ($asset as $value)
            @php $no++ @endphp
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $value->id_asset }}</td>
                @foreach($value->asset as $values)
                <td>{{ $values->nama_asset }}</td>
                <td>{{ $values->harga_satuan }}/{{ $values->satuan }}</td>
                <td>{{ $values->kondisi }}</td>
                <td>{{date('d-m-Y',strtotime($values->tgl_pembelian))}}</td>
                <td>
                    @php
                    $tanggal1 = new DateTime(date('Y-m-d'));
                    $tanggal2 = new DateTime($values->umur_akhir);
                    $interval = $tanggal1->diff($tanggal2);
                    echo $interval->format('%R%a Hari');
                    @endphp
                </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="tanda-tangan">
        <div class="ttd">
            <div style="padding-bottom:0px">Kepala Madrasah</div>
            <div class="ttd_grup">
                <img class="ttd_img" style="top: 40px" src="{{$ttd}}"
                alt="">
                <img class="ttd_img" style="width:180px; top: -10px"
                src="{{url('assets/images/stempel.png')}}" alt="">
            </div>
            <div style="padding-top:120px">ABDUL GAFUR KHOLIDIN,S.Pd.I</div>
        </div>
    </div>
</body>

</html>
