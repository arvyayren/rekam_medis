<!DOCTYPE html>
<html lang="en">
<head>
  <title>Kartu Tanda Berobat</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body onload="window.print()">
 
<div class="container">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="text-center">KARTU TANDA BEROBAT</h5>
                <h6 class="text-center">KLINIK PRATAMA ALAM MEDIKA PLUIT</h6>
                <div class="row">
                    <div class="col-md-3">
                        <img src="{{asset('img_avatar3.png')}}" alt="John Doe" class="mr-3 mt-3 rounded-circle text-center" style="width:50px;">
                    </div>
                    <div class="col-md-9 pt-3">
                    <table>
                        <tr>
                            <td><strong>{{ $data->nama}}</strong></td>
                        </tr>
                        <tr>
                            <td>{{ $data->no_registrasi_pasien }}</td>
                        </tr>
                    </table>
                    </div>
                </div>
                <br>
                <table width="100%">
                    <tr>
                        <td width="30%">Tempat Lahir</td>
                        <td width="70%">: {{ $data->tempat_lahir }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>: {{ $data->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>: {{ $data->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: {{ $data->alamat }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
