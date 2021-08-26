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
                <a href="{{ route('rm.rekapusia.cetak') }}" class="btn btn-warning text-white">
                    <i class="lnr lnr-printer">  </i>CETAK
                </a>
                <a href="{{ route('rm.rekapusiaold') }}" class="btn btn-success text-white">
                    <i class="lnr lnr-undo">  </i>Lihat Tahun {{ $list['kp']['thnold'] }}
                </a>
                <p></p>
                <div class="panel panel-headline">
                    <div class="panel-heading">
                        <h3 class="panel-title">Jumlah Pasien Berdasarkan Usia</h3>
                        <hr>
                        <h3 class="panel-title text-center">TRIWULAN Tahun {{ $list['kp']['thn'] }}</h3>
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
                                        <th colspan="4">{{ $list['kp']['total'][0]->jumlah }}</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>0-7 Hari</td>
                                        <td>@if(isset($list['kp']['triwulan1'][1]->jumlah)) {{ $list['kp']['triwulan1'][1]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan2'][1]->jumlah)) {{ $list['kp']['triwulan2'][1]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan3'][1]->jumlah)) {{ $list['kp']['triwulan3'][1]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan4'][1]->jumlah)) {{ $list['kp']['triwulan4'][1]->jumlah }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>8-27 Hari</td>
                                        <td>@if(isset($list['kp']['triwulan1'][8]->jumlah)) {{ $list['kp']['triwulan1'][8]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan2'][8]->jumlah)) {{ $list['kp']['triwulan2'][8]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan3'][8]->jumlah)) {{ $list['kp']['triwulan3'][8]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan4'][8]->jumlah)) {{ $list['kp']['triwulan4'][8]->jumlah }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>28-364 Hari</td>
                                        <td>@if(isset($list['kp']['triwulan1'][5]->jumlah)) {{ $list['kp']['triwulan1'][5]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan2'][5]->jumlah)) {{ $list['kp']['triwulan2'][5]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan3'][5]->jumlah)) {{ $list['kp']['triwulan3'][5]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan4'][5]->jumlah)) {{ $list['kp']['triwulan4'][5]->jumlah }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>1-4 Tahun</td>
                                        <td>@if(isset($list['kp']['triwulan1'][2]->jumlah)) {{ $list['kp']['triwulan1'][2]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan2'][2]->jumlah)) {{ $list['kp']['triwulan2'][2]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan3'][2]->jumlah)) {{ $list['kp']['triwulan3'][2]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan4'][2]->jumlah)) {{ $list['kp']['triwulan4'][2]->jumlah }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>5-15 Tahun</td>
                                        <td>@if(isset($list['kp']['triwulan1'][7]->jumlah)) {{ $list['kp']['triwulan1'][7]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan2'][7]->jumlah)) {{ $list['kp']['triwulan2'][7]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan3'][7]->jumlah)) {{ $list['kp']['triwulan3'][7]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan4'][7]->jumlah)) {{ $list['kp']['triwulan4'][7]->jumlah }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>16-24 Tahun</td>
                                        <td>@if(isset($list['kp']['triwulan1'][3]->jumlah)) {{ $list['kp']['triwulan1'][3]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan2'][3]->jumlah)) {{ $list['kp']['triwulan2'][3]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan3'][3]->jumlah)) {{ $list['kp']['triwulan3'][3]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan4'][3]->jumlah)) {{ $list['kp']['triwulan4'][3]->jumlah }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>25-44 Tahun</td>
                                        <td>@if(isset($list['kp']['triwulan1'][4]->jumlah)) {{ $list['kp']['triwulan1'][4]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan2'][4]->jumlah)) {{ $list['kp']['triwulan2'][4]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan3'][4]->jumlah)) {{ $list['kp']['triwulan3'][4]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan4'][4]->jumlah)) {{ $list['kp']['triwulan4'][4]->jumlah }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>45-64 Tahun</td>
                                        <td>@if(isset($list['kp']['triwulan1'][6]->jumlah)) {{ $list['kp']['triwulan1'][6]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan2'][6]->jumlah)) {{ $list['kp']['triwulan2'][6]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan3'][6]->jumlah)) {{ $list['kp']['triwulan3'][6]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan4'][6]->jumlah)) {{ $list['kp']['triwulan4'][6]->jumlah }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>>65 Tahun</td>
                                        <td>@if(isset($list['kp']['triwulan1'][0]->jumlah)) {{ $list['kp']['triwulan1'][0]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan2'][0]->jumlah)) {{ $list['kp']['triwulan2'][0]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan3'][0]->jumlah)) {{ $list['kp']['triwulan3'][0]->jumlah }} @endif</td>
                                        <td>@if(isset($list['kp']['triwulan4'][0]->jumlah)) {{ $list['kp']['triwulan4'][0]->jumlah }} @endif</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-headline">
                    <div class="panel-heading">
                        <h3 class="panel-title">Filter Poli</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-auth-small" action="{{ route('rm.rekapusiapoli') }}" method="GET" >
                        {{--  <form class="form-inline" action="{{ route('direktur.rekapharian.cari') }}" method="GET">  --}}
                            @csrf
                            <select onchange="submitBtn()" name="poli" id="poli" class="form-control">
                                <option hidden selected>Pilih</option>
                                <option value="Umum">Poli Umum</option>
                                <option value="Anak">Poli Anak</option>
                                <option value="Bedah">Poli Bedah</option>
                                <option value="Gigi">Poli Gigi</option>
                                <option value="Dalam">Poli Dalam</option>
                                <option value="Ortopedi">Poli Ortopedi</option>
                                <option value="Jiwa">Poli Jiwa</option>
                                <option value="Kulit">Poli Kulit/Kelamin</option>
                                <option value="THT">Poli THT</option>
                                <option value="Paru">Poli Paru</option>
                                <option value="Syaraf">Poli Syaraf</option>
                            </select>
                            <p></p>
                            <button class="btn btn-primary text-white pull-right" id="submit" disabled>Submit</button>
                        </form>
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
