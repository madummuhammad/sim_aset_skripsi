<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>QR-Code {{$asset->id_asset}}</title>
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

.table{
    width: 100%;
}

.table th, .table td {
    padding: 0.2rem;
    vertical-align: top;
    border: 1px solid #000000; 
}
.table thead th {
    vertical-align: bottom;
    border: 2px solid #000000; 
}

.kop-surat{
    width: 100%;
    align-items: center;
}

.kop{
    line-height: 10px;
    text-align: center;
    margin-left: 12%;
}

.kop .alamat p{
    line-height: 4px !important;
    margin-top: -4px;
}

.logo{
    position: absolute;
}

.logo img{
    width: 100px;
}

.fs-60px{
    font-size: 23px;
}

.line{
    width: 100%;
}

.w-100{
    width: 100%;
}

.tanda-tangan{
    margin-right: 0;
    width: 100%;
}

.ttd{
    right: 10px;
    position: absolute;
    text-align: center;
    height: 100px;
}
.ttd_grup{
    position: absolute;
}
.ttd_img{
    width: 200px;
    margin: 10px;
    position: absolute;
}
</style>
<body>
    <table class="w-100">
        <tbody>
            <tr>
                <td>ID Asset</td>
                <td>:</td>
                <td>{{$asset->id_asset}}</td>
            </tr>
            <tr>
                <td>QR Code</td>
                <td>:</td>
                {!!QrCode::generate(url('asset/resultqr/'.$asset->id_asset), '../public/assets/qrcode/'.$asset->id_asset.'.svg');!!}
                <td><img src="{{public_path('assets/qrcode/'.$asset->id_asset.'.svg')}}" alt=""></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
