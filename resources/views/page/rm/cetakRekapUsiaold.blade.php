<html>
<head>
    <title>Triwulan {{ $tahun }}</title>
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
        <h3 class="panel-title">Jumlah Pasien Berdasarkan Usia</h3>
        <h4 class="panel-title text-center">(Triwulan Tahun {{ $tahun }})</h4>
    </center>
    <table class="table table-bordered table-hover table-sm" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Kategori Umur</th>
                <th>Triwulan 1</th>
                <th>Triwulan 2</th>
                <th>Triwulan 3</th>
                <th>Triwulan 4</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>0-7 Hari</td>
                <td>@if(isset($triwulan1[1]->jumlah)) {{ $triwulan1[1]->jumlah }} @endif</td>
                <td>@if(isset($triwulan2[1]->jumlah)) {{ $triwulan2[1]->jumlah }} @endif</td>
                <td>@if(isset($triwulan3[1]->jumlah)) {{ $triwulan3[1]->jumlah }} @endif</td>
                <td>@if(isset($triwulan4[1]->jumlah)) {{ $triwulan4[1]->jumlah }} @endif</td>
            </tr>
            <tr>
                <td>8-27 Hari</td>
                <td>@if(isset($triwulan1[8]->jumlah)) {{ $triwulan1[8]->jumlah }} @endif</td>
                <td>@if(isset($triwulan2[8]->jumlah)) {{ $triwulan2[8]->jumlah }} @endif</td>
                <td>@if(isset($triwulan3[8]->jumlah)) {{ $triwulan3[8]->jumlah }} @endif</td>
                <td>@if(isset($triwulan4[8]->jumlah)) {{ $triwulan4[8]->jumlah }} @endif</td>
            </tr>
            <tr>
                <td>28-364 Hari</td>
                <td>@if(isset($triwulan1[5]->jumlah)) {{ $triwulan1[5]->jumlah }} @endif</td>
                <td>@if(isset($triwulan2[5]->jumlah)) {{ $triwulan2[5]->jumlah }} @endif</td>
                <td>@if(isset($triwulan3[5]->jumlah)) {{ $triwulan3[5]->jumlah }} @endif</td>
                <td>@if(isset($triwulan4[5]->jumlah)) {{ $triwulan4[5]->jumlah }} @endif</td>
            </tr>
            <tr>
                <td>1-4 Tahun</td>
                <td>@if(isset($triwulan1[2]->jumlah)) {{ $triwulan1[2]->jumlah }} @endif</td>
                <td>@if(isset($triwulan2[2]->jumlah)) {{ $triwulan2[2]->jumlah }} @endif</td>
                <td>@if(isset($triwulan3[2]->jumlah)) {{ $triwulan3[2]->jumlah }} @endif</td>
                <td>@if(isset($triwulan4[2]->jumlah)) {{ $triwulan4[2]->jumlah }} @endif</td>
            </tr>
            <tr>
                <td>5-15 Tahun</td>
                <td>@if(isset($triwulan1[7]->jumlah)) {{ $triwulan1[7]->jumlah }} @endif</td>
                <td>@if(isset($triwulan2[7]->jumlah)) {{ $triwulan2[7]->jumlah }} @endif</td>
                <td>@if(isset($triwulan3[7]->jumlah)) {{ $triwulan3[7]->jumlah }} @endif</td>
                <td>@if(isset($triwulan4[7]->jumlah)) {{ $triwulan4[7]->jumlah }} @endif</td>
            </tr>
            <tr>
                <td>16-24 Tahun</td>
                <td>@if(isset($triwulan1[3]->jumlah)) {{ $triwulan1[3]->jumlah }} @endif</td>
                <td>@if(isset($triwulan2[3]->jumlah)) {{ $triwulan2[3]->jumlah }} @endif</td>
                <td>@if(isset($triwulan3[3]->jumlah)) {{ $triwulan3[3]->jumlah }} @endif</td>
                <td>@if(isset($triwulan4[3]->jumlah)) {{ $triwulan4[3]->jumlah }} @endif</td>
            </tr>
            <tr>
                <td>25-44 Tahun</td>
                <td>@if(isset($triwulan1[4]->jumlah)) {{ $triwulan1[4]->jumlah }} @endif</td>
                <td>@if(isset($triwulan2[4]->jumlah)) {{ $triwulan2[4]->jumlah }} @endif</td>
                <td>@if(isset($triwulan3[4]->jumlah)) {{ $triwulan3[4]->jumlah }} @endif</td>
                <td>@if(isset($triwulan4[4]->jumlah)) {{ $triwulan4[4]->jumlah }} @endif</td>
            </tr>
            <tr>
                <td>45-64 Tahun</td>
                <td>@if(isset($triwulan1[6]->jumlah)) {{ $triwulan1[6]->jumlah }} @endif</td>
                <td>@if(isset($triwulan2[6]->jumlah)) {{ $triwulan2[6]->jumlah }} @endif</td>
                <td>@if(isset($triwulan3[6]->jumlah)) {{ $triwulan3[6]->jumlah }} @endif</td>
                <td>@if(isset($triwulan4[6]->jumlah)) {{ $triwulan4[6]->jumlah }} @endif</td>
            </tr>
            <tr>
                <td>>65 Tahun</td>
                <td>@if(isset($triwulan1[0]->jumlah)) {{ $triwulan1[0]->jumlah }} @endif</td>
                <td>@if(isset($triwulan2[0]->jumlah)) {{ $triwulan2[0]->jumlah }} @endif</td>
                <td>@if(isset($triwulan3[0]->jumlah)) {{ $triwulan3[0]->jumlah }} @endif</td>
                <td>@if(isset($triwulan4[0]->jumlah)) {{ $triwulan4[0]->jumlah }} @endif</td>
            </tr>
            <tr>
                <th>Total Jml</th>
                <th colspan="4">{{ $total[0]->jumlah }}</th>
            </tr>
        </tbody>
    </table>
    <hr>
    <center><sub>Rumah Sakit PKU Muhammadiyah Sukoharjo</sub></center>
</body>
</html>
