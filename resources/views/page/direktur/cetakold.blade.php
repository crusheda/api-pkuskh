<html>
<head>
    <title>{{ $yest }}</title>
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
        <h4>Data Kunjungan Pasien</h4>
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
                <td>{{ $igd[0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Poli Anak</th>
                <td>{{ $anak[0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Poli Bedah</th>
                <td>{{ $bedah[0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Poli Gigi</th>
                <td>{{ $gigi[0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Poli Dalam</th>
                <td>{{ $dalam[0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Poli Ortopedi</th>
                <td>{{ $orto[0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Poli Jiwa</th>
                <td>{{ $jiwa[0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Poli Kulit / Kelamin</th>
                <td>{{ $kulit[0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Poli THT</th>
                <td>{{ $tht[0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Poli Paru</th>
                <td>{{ $paru[0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Poli Syaraf</th>
                <td>{{ $syaraf[0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Rehabilitasi Medik</th>
                <td>{{ $rehab[0]->jumlah }}</td>
            </tr>
            <tr>
                <th>Kebidanan</th>
                <td>{{ $keb[0]->jumlah }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Total Jml</th>
                <th colspan="11">{{ $total[0]->jumlah }}</th>
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
                <th>MENINGGAL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $umum[0]->jumlah }}</td>
                <td>{{ $bpjs[0]->jumlah }}</td>
                <td></td>
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
                <td>{{ $inap[0]->jumlah }}</td>
                <td>{{ count($lab) }}</td>
                <td>{{ count($rad) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
