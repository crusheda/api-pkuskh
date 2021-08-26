<html>
<head>
    <title>Poli {{ $poli }} Triwulan {{ $tahun  }}</title>
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
        <h3 class="panel-title">Jumlah Pasien Poli {{ $poli }} Berdasarkan Usia</h3>
        <h4 class="panel-title text-center">(Triwulan Tahun {{ $tahun }})</h4>
    </center>
    <table class="table table-bordered table-hover table-sm" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Kategori Usia</th>
                <th>Rekam Medik</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Pulang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($triwulan1 as $item)
                <tr>
                    <td>{{ $item->KELUMUR }}</td>
                    <td>{{ $item->DAT_PASIEN }}</td>
                    <td>{{ $item->NAMAPASIEN }}</td>
                    <td>{{ $item->UMUR }}</td>
                    <td>{{ $item->TGL_DISCHARGE }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    <center><sub>Rumah Sakit PKU Muhammadiyah Sukoharjo</sub></center>
</body>
</html>
