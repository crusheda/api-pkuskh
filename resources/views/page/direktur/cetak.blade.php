<html>
<head>
    <title>{{ $now }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" media="all" crossorigin="anonymous">
    <link href="{{ public_path('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
    <style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
    </style>
    <center>
        <h4>Data Kunjungan Pasien <strong class="text-danger">Hari Ini</strong></h4>
        <p>Waktu: {{ $now }}</p>
    </center>
    <table class="table table-bordered table-hover table-sm">
        <thead>
            <tr>
                <th></th>
                <th>Bangsal Lt.3</th>
                <th>Bangsal Lt.4</th>
                <th>Kebidanan</th>
                <th>Perinatologi</th>
                <th>Isolasi</th>
                <th>ICU</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Jml</th>
                <td>{{ $akomodasi['lt3'][0]->jumlah }}</td>
                <td>{{ $akomodasi['lt4'][0]->jumlah }}</td>
                <td>{{ $akomodasi['keb'][0]->jumlah }}</td>
                <td>{{ $akomodasi['per'][0]->jumlah }}</td>
                <td>{{ $akomodasi['iso'][0]->jumlah }}</td>
                <td>{{ $akomodasi['icu'][0]->jumlah }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Total Jml</th>
                <th colspan="6">{{ $akomodasi['total'][0]->jumlah }}</th>
            </tr>
        </tfoot>
    </table>
    <hr>
    <center>
        <h4>Data Kunjungan Pasien <strong class="text-warning">Kemarin</strong></h4>
        <p>Waktu: {{ $yest }}</p>
    </center>
    <table class="table table-bordered table-hover table-sm">
        <thead>
            <tr>
                <th>Perincian</th>
                <th>Jml</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Rawat Darurat / Poli Umum (IGD)</th>
                <td>{{ $kunjungan['igd'][0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Poli Anak</th>
                <td>{{ $kunjungan['anak'][0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Poli Bedah</th>
                <td>{{ $kunjungan['bedah'][0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Poli Gigi</th>
                <td>{{ $kunjungan['gigi'][0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Poli Dalam</th>
                <td>{{ $kunjungan['dalam'][0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Poli Ortopedi</th>
                <td>{{ $kunjungan['orto'][0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Poli Jiwa</th>
                <td>{{ $kunjungan['jiwa'][0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Poli Kulit / Kelamin</th>
                <td>{{ $kunjungan['kulit'][0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Poli THT</th>
                <td>{{ $kunjungan['tht'][0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Poli Paru</th>
                <td>{{ $kunjungan['paru'][0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Poli Syaraf</th>
                <td>{{ $kunjungan['syaraf'][0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Rehabilitasi Medik</th>
                <td>{{ $kunjungan['rehab'][0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Kebidanan</th>
                <td>{{ $kunjungan['keb'][0]->jumlah }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Total Jml</th>
                <th colspan="11">{{ $kunjungan['total'][0]->jumlah }}</th>
            </tr>
        </tfoot>
    </table>
    <table class="table table-bordered table-hover table-sm">
        <thead>
            <tr>
                <th colspan="2">Pasien Pulang</th>
            </tr>
            <tr>
                <th>UMUM</th>
                <th>BPJS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $kunjungan['umum'][0]->jumlah }}</td>
                <td>{{ $kunjungan['bpjs'][0]->jumlah }}</td>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered table-hover table-sm">
        <thead>
            <tr>
            <th>Rawat Inap</th>
            <th>Laboratorium</th>
            <th>Radiologi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $kunjungan['inap'][0]->jumlah }}</td>
                <td>{{ count($kunjungan['lab']) }}</td>
                <td>{{ count($kunjungan['rad']) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
