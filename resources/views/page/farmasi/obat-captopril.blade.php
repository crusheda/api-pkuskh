@extends('layouts.layout-farmasi')

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

<body>  --}}
<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">DAFTAR PENJUALAN OBAT Captopril 12,5mg & 25mg & 50mg</h3>
                    <p class="panel-subtitle"><i>(*) Jika tombol SEARCH tidak muncul harap Refresh halaman kembali.</i></p>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="data-table-list">
                                <div class="table-responsive">
                                    <table id="data-table-basic" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>RM</th>
                                                <th>NO REGISTRASI</th>
                                                <th>TGL PULANG</th>
                                                <th>NO PELAYANAN</th>
                                                <th>CPTPR 12,5 mg</th>
                                                <th>CPTPR 25 mg</th>
                                                <th>CPTPR 50 mg</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($list['all'] as $item)
                                            <tr>
                                                <th>{{ $item->DAT_PASIEN }}</th>
                                                <th>{{ $item->REG_KUNJUNGANPASIEN }}</th>
                                                <th>{{ $item->TGL_DISCHARGE }}</th>
                                                <th>{{ $item->TRANS_JNSPELAYANAN }}</th>
                                                @if ( $item->DAT_OBATALKES == '1025000034')
                                                    <th><i class="fa fa-check"></i></th>
                                                @else
                                                    <th></th>
                                                @endif
                                                @if ( $item->DAT_OBATALKES == '1025000036')
                                                    <th><i class="fa fa-check"></i></th>
                                                @else
                                                    <th></th>
                                                @endif
                                                @if ( $item->DAT_OBATALKES == '1025000035')
                                                    <th><i class="fa fa-check"></i></th>
                                                @else
                                                    <th></th>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>RM</th>
                                                <th>NO REGISTRASI</th>
                                                <th>TGL PULANG</th>
                                                <th>NO PELAYANAN</th>
                                                <th>CPTPR 12,5 mg</th>
                                                <th>CPTPR 25 mg</th>
                                                <th>CPTPR 50 mg</th>
                                            </tr>
                                        </tfoot>
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
    <!-- jquery
		============================================ -->
    <script src="{{ asset('css-farmasi/js/vendor/jquery-1.12.4.min.js') }}"></script>

    <!-- Data Table JS
		============================================ -->
    <script src="{{ asset('css-farmasi/js/data-table/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('css-farmasi/js/data-table/data-table-act.js') }}"></script>
@endsection
