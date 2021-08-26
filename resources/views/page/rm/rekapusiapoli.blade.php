@extends('layouts.layout-rm')

@section('content')

    <!-- normalize CSS
        ============================================ -->
    <link rel="stylesheet" href="{{ asset('css-farmasi/css/normalize.css') }}">
    <!-- Data Table CSS
        ============================================ -->
    <link rel="stylesheet" href="{{ asset('css-farmasi/css/jquery.dataTables.min.css') }}">
    <!-- modernizr JS
        ============================================ -->
    <script src="{{ asset('css-farmasi/js/vendor/modernizr-2.8.3.min.js') }}"></script>

</head>
<body>
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                {{--  <a href="{{ route('rm.rekapusia.cetak') }}" class="btn btn-warning text-white">
                    <i class="lnr lnr-printer">  </i>CETAK
                </a>  --}}
                <a class="btn btn-success text-white" disabled>
                    <i class="lnr lnr-undo">  </i>Lihat Tahun {{ $list['tahunold'] }}
                </a>
                <p></p>
                <div class="panel panel-headline">
                    <div class="panel-heading">
                        <h3 class="panel-title">Rekap Pasien Poli {{ $list['poli'] }} Berdasarkan Usia</h3>
                        <p>TRIWULAN Tahun {{ $list['tahun'] }}</p>
                    </div>
                    <div class="panel-body">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingtriwulan1">
                                    <h2 class="mb-0">
                                        <button class="btn btn-dark collapsed" type="button" data-toggle="collapse" data-target="#triwulan1" aria-expanded="false" aria-controls="triwulan1">
                                        Lihat Triwulan 1 <span class="badge badge-light">{{ count($list['triwulan1']) }}</span>
                                        </button>
                                    </h2>
                                </div>
                                <div id="triwulan1" class="collapse" aria-labelledby="headingtriwulan1" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="table-responsive">
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
                                                <tfoot>
                                                    <tr>
                                                        <th>Kategori Usia</th>
                                                        <th>Rekam Medik</th>
                                                        <th>Nama</th>
                                                        <th>Umur</th>
                                                        <th>Pulang</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                @foreach ($list['triwulan1'] as $item)
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingtriwulan2">
                                    <h2 class="mb-0">
                                        <button class="btn btn-dark collapsed" type="button" data-toggle="collapse" data-target="#triwulan2" aria-expanded="false" aria-controls="triwulan2">
                                            Lihat Triwulan 2 <span class="badge badge-light">{{ count($list['triwulan2']) }}</span>
                                        </button>
                                    </h2>
                                </div>
                                <div id="triwulan2" class="collapse" aria-labelledby="headingtriwulan2" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="table-responsive">
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
                                                <tfoot>
                                                    <tr>
                                                        <th>Kategori Usia</th>
                                                        <th>Rekam Medik</th>
                                                        <th>Nama</th>
                                                        <th>Umur</th>
                                                        <th>Pulang</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                @foreach ($list['triwulan2'] as $item)
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingtriwulan3">
                                    <h2 class="mb-0">
                                        <button class="btn btn-dark collapsed" type="button" data-toggle="collapse" data-target="#triwulan3" aria-expanded="false" aria-controls="triwulan3">
                                            Lihat Triwulan 3 <span class="badge badge-light">{{ count($list['triwulan3']) }}</span>
                                        </button>
                                    </h2>
                                </div>
                                <div id="triwulan3" class="collapse" aria-labelledby="headingtriwulan3" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="table-responsive">
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
                                                <tfoot>
                                                    <tr>
                                                        <th>Kategori Usia</th>
                                                        <th>Rekam Medik</th>
                                                        <th>Nama</th>
                                                        <th>Umur</th>
                                                        <th>Pulang</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                @foreach ($list['triwulan3'] as $item)
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingtriwulan4">
                                    <h2 class="mb-0">
                                        <button class="btn btn-dark collapsed" type="button" data-toggle="collapse" data-target="#triwulan4" aria-expanded="false" aria-controls="triwulan4">
                                            Lihat Triwulan 4 <span class="badge badge-light">{{ count($list['triwulan4']) }}</span>
                                        </button>
                                    </h2>
                                </div>
                                <div id="triwulan4" class="collapse" aria-labelledby="headingtriwulan4" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="table-responsive">
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
                                                <tfoot>
                                                    <tr>
                                                        <th>Kategori Usia</th>
                                                        <th>Rekam Medik</th>
                                                        <th>Nama</th>
                                                        <th>Umur</th>
                                                        <th>Pulang</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                @foreach ($list['triwulan4'] as $item)
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submitBtn() {
            var poli = document.getElementById("poli").value;
            if (poli != "Pilih" ) {
                document.getElementById("submit").disabled = false;
            }
        }
    </script>
    <!-- jquery
        ============================================ -->
    <script src="{{ asset('css-farmasi/js/vendor/jquery-1.12.4.min.js') }}"></script>

    <!-- Data Table JS
        ============================================ -->
    <script src="{{ asset('css-farmasi/js/data-table/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('css-farmasi/js/data-table/data-table-act.js') }}"></script>
@endsection
