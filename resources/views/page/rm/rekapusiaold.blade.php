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
                <a href="{{ route('rm.rekapusiaold.cetak') }}" class="btn btn-warning text-white">
                    <i class="lnr lnr-printer">  </i>CETAK
                </a>
                <p></p>
                <div class="panel panel-headline">
                    <div class="panel-heading">
                        <h3 class="panel-title">Jumlah Pasien Berdasarkan Usia</h3>
                        <hr>
                        <h3 class="panel-title text-center">TRIWULAN Tahun {{ $list['thn'] }}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
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
                                <tfoot>
                                    <tr>
                                        <th>Total Jml</th>
                                        <th colspan="4">{{ $list['total'][0]->jumlah }}</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>0-7 Hari</td>
                                        <td>@if(isset($list['triwulan1'][1]->jumlah)) {{ $list['triwulan1'][1]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan2'][1]->jumlah)) {{ $list['triwulan2'][1]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan3'][1]->jumlah)) {{ $list['triwulan3'][1]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan4'][1]->jumlah)) {{ $list['triwulan4'][1]->jumlah }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>8-27 Hari</td>
                                        <td>@if(isset($list['triwulan1'][8]->jumlah)) {{ $list['triwulan1'][8]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan2'][8]->jumlah)) {{ $list['triwulan2'][8]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan3'][8]->jumlah)) {{ $list['triwulan3'][8]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan4'][8]->jumlah)) {{ $list['triwulan4'][8]->jumlah }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>28-364 Hari</td>
                                        <td>@if(isset($list['triwulan1'][5]->jumlah)) {{ $list['triwulan1'][5]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan2'][5]->jumlah)) {{ $list['triwulan2'][5]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan3'][5]->jumlah)) {{ $list['triwulan3'][5]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan4'][5]->jumlah)) {{ $list['triwulan4'][5]->jumlah }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>1-4 Tahun</td>
                                        <td>@if(isset($list['triwulan1'][2]->jumlah)) {{ $list['triwulan1'][2]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan2'][2]->jumlah)) {{ $list['triwulan2'][2]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan3'][2]->jumlah)) {{ $list['triwulan3'][2]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan4'][2]->jumlah)) {{ $list['triwulan4'][2]->jumlah }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>5-15 Tahun</td>
                                        <td>@if(isset($list['triwulan1'][7]->jumlah)) {{ $list['triwulan1'][7]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan2'][7]->jumlah)) {{ $list['triwulan2'][7]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan3'][7]->jumlah)) {{ $list['triwulan3'][7]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan4'][7]->jumlah)) {{ $list['triwulan4'][7]->jumlah }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>16-24 Tahun</td>
                                        <td>@if(isset($list['triwulan1'][3]->jumlah)) {{ $list['triwulan1'][3]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan2'][3]->jumlah)) {{ $list['triwulan2'][3]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan3'][3]->jumlah)) {{ $list['triwulan3'][3]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan4'][3]->jumlah)) {{ $list['triwulan4'][3]->jumlah }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>25-44 Tahun</td>
                                        <td>@if(isset($list['triwulan1'][4]->jumlah)) {{ $list['triwulan1'][4]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan2'][4]->jumlah)) {{ $list['triwulan2'][4]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan3'][4]->jumlah)) {{ $list['triwulan3'][4]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan4'][4]->jumlah)) {{ $list['triwulan4'][4]->jumlah }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>45-64 Tahun</td>
                                        <td>@if(isset($list['triwulan1'][6]->jumlah)) {{ $list['triwulan1'][6]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan2'][6]->jumlah)) {{ $list['triwulan2'][6]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan3'][6]->jumlah)) {{ $list['triwulan3'][6]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan4'][6]->jumlah)) {{ $list['triwulan4'][6]->jumlah }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>>65 Tahun</td>
                                        <td>@if(isset($list['triwulan1'][0]->jumlah)) {{ $list['triwulan1'][0]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan2'][0]->jumlah)) {{ $list['triwulan2'][0]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan3'][0]->jumlah)) {{ $list['triwulan3'][0]->jumlah }} @endif</td>
                                        <td>@if(isset($list['triwulan4'][0]->jumlah)) {{ $list['triwulan4'][0]->jumlah }} @endif</td>
                                    </tr>
                                </tbody>
                            </table>
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
