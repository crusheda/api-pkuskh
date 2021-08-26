@extends('layouts.layout-direktur')

@section('content')
<!-- MAIN -->
<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Data Kamar Pasien</h3>
					<p class="panel-subtitle"><strong class="text-danger">Update:</strong> {{ $list['now'] }}</p>
				</div>
				<div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-center"><b>Jumlah Kapasitas Kamar Pasien</b></h5>
                            <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th><b>Kamar</b></th>
                                        <th><b>Kapasitas</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Bangsal LT.3</td>
                                        <td>{{ $list['totlt3'][0]->jumlah }}</td>
                                    </tr>
                                    <tr>
                                        <td>Bangsal LT.4</td>
                                        <td>{{ $list['totlt4'][0]->jumlah }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kebidanan</td>
                                        <td>{{ $list['totkeb'][0]->jumlah }}</td>
                                    </tr>
                                    <tr>
                                        <td>Perinatologi</td>
                                        <td>{{ $list['totperin'][0]->jumlah }}</td>
                                    </tr>
                                    <tr>
                                        <td>Isolasi</td>
                                        <td>{{ $list['totiso'][0]->jumlah }}</td>
                                    </tr>
                                    <tr>
                                        <td>ICU</td>
                                        <td>{{ $list['toticu'][0]->jumlah }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><br><br>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="metric">
                                        <span class="icon" style="background-color:grey"><i class="fa fa-bed" style="color:black"></i></span>
                                        <p>
                                            <span class="title">Total Kamar Terisi</span>
                                            <span class="number"><b>{{ $list['jumlaht'][0]->jumlah }}</b></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="metric">
                                        <span class="icon" style="background-color:grey"><i class="fa fa-bed"></i></span>
                                        <p>
                                            <span class="title">Total Kamar Tersedia</span>
                                            <span class="number"><b>{{ $list['jumlahk'][0]->jumlah }}</b></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
            </div>
            <div class="panel panel-headline">
                <div class="panel-body">
                <!-- END Rekap Hari Ini -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <h5 class="text-center"><b>RUANG KAMAR PASIEN TERISI</b></h5>
                                </tr>
                                <tr>
                                    {{-- Bangsal LT.3 --}}
                                    <th class="text-center" rowspan="2"><b>Kamar</b></th>
                                    @if (count($list['lt3t']) == '1')
                                        <th colspan="1">BANGSAL LT.3</th>
                                    @endif
                                    @if (count($list['lt3t']) == '2')
                                        <th colspan="2">BANGSAL LT.3</th>
                                    @endif
                                    @if (count($list['lt3t']) == '3')
                                        <th colspan="3">BANGSAL LT.3</th>
                                    @endif
                                    @if (count($list['lt3t']) == '4')
                                        <th colspan="4">BANGSAL LT.3</th>
                                    @endif
                                    @if (count($list['lt3t']) == '5')
                                        <th colspan="5">BANGSAL LT.3</th>
                                    @endif
                                    {{-- Bangsal LT.4 --}}
                                    @if (count($list['lt4t']) == '1')
                                        <th colspan="1">BANGSAL LT.4</th>
                                    @endif
                                    @if (count($list['lt4t']) == '2')
                                        <th colspan="2">BANGSAL LT.4</th>
                                    @endif
                                    @if (count($list['lt4t']) == '3')
                                        <th colspan="3">BANGSAL LT.4</th>
                                    @endif
                                    @if (count($list['lt4t']) == '4')
                                        <th colspan="4">BANGSAL LT.4</th>
                                    @endif
                                    @if (count($list['lt4t']) == '5')
                                        <th colspan="5">BANGSAL LT.4</th>
                                    @endif
                                    {{-- Kebidanan --}}
                                    @if (count($list['kebt']) == '1')
                                        <th colspan="1">KEBIDANAN</th>
                                    @endif
                                    @if (count($list['kebt']) == '2')
                                        <th colspan="2">KEBIDANAN</th>
                                    @endif
                                    @if (count($list['kebt']) == '3')
                                        <th colspan="3">KEBIDANAN</th>
                                    @endif
                                    @if (count($list['kebt']) == '4')
                                        <th colspan="4">KEBIDANAN</th>
                                    @endif
                                    @if (count($list['kebt']) == '5')
                                        <th colspan="5">KEBIDANAN</th>
                                    @endif

                                        @if (count($list['icut']) > 0 )
                                        <th>ICU</th>
                                        @endif
                                        @if (count($list['isot']) > 0 )
                                        <th>ISOLASI</th>
                                        @endif
                                        @if (count($list['perint']) > 0 )
                                        <th>PERINATOLOGI</th>
                                        @endif
                                </tr>
                                <tr>
                                    @foreach($list['lt3t'] as $item)
                                        @if ($item->SET_KELAS == '01')
                                        <th>KLS 3</th>
                                        @endif
                                        @if ($item->SET_KELAS == '02')
                                        <th>KLS 2</th>
                                        @endif
                                        @if ($item->SET_KELAS == '03')
                                        <th>KLS 1</th>
                                        @endif
                                        @if ($item->SET_KELAS == '04')
                                        <th>KLS 1'</th>
                                        @endif
                                        @if ($item->SET_KELAS == '05')
                                        <th>VIP</th>
                                        @endif
                                        @if ($item->SET_KELAS == '07')
                                        <th>VIP'</th>
                                        @endif
                                    @endforeach
                                    @foreach($list['lt4t'] as $item)
                                        @if ($item->SET_KELAS == '01')
                                        <th>KLS 3</th>
                                        @endif
                                        @if ($item->SET_KELAS == '02')
                                        <th>KLS 2</th>
                                        @endif
                                        @if ($item->SET_KELAS == '03')
                                        <th>KLS 1</th>
                                        @endif
                                        @if ($item->SET_KELAS == '04')
                                        <th>KLS 1'</th>
                                        @endif
                                        @if ($item->SET_KELAS == '05')
                                        <th>VIP</th>
                                        @endif
                                        @if ($item->SET_KELAS == '07')
                                        <th>VIP'</th>
                                        @endif
                                    @endforeach
                                    @foreach($list['kebt'] as $item)
                                        @if ($item->SET_KELAS == '01')
                                        <th>KLS 3</th>
                                        @endif
                                        @if ($item->SET_KELAS == '02')
                                        <th>KLS 2</th>
                                        @endif
                                        @if ($item->SET_KELAS == '03')
                                        <th>KLS 1</th>
                                        @endif
                                        @if ($item->SET_KELAS == '04')
                                        <th>KLS 1'</th>
                                        @endif
                                        @if ($item->SET_KELAS == '05')
                                        <th>VIP</th>
                                        @endif
                                        @if ($item->SET_KELAS == '07')
                                        <th>VIP'</th>
                                        @endif
                                    @endforeach
                                    @foreach($list['icut'] as $item)
                                        @if ($item->SET_KELAS == '00')
                                        <th>ICU</th>
                                        @endif
                                    @endforeach
                                    @foreach($list['isot'] as $item)
                                        @if ($item->SET_KELAS == '08')
                                        <th>ISO</th>
                                        @endif
                                    @endforeach
                                    @foreach($list['perint'] as $item)
                                        @if ($item->SET_KELAS == '06')
                                        <th>PERIN</th>
                                        @endif
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-center"><b>Total</b></th>
                                    @if(count($list) > 0)
                                    @foreach($list['lt3t'] as $item)
                                        <td>{{ $item->jumlah }}</td>
                                    @endforeach
                                    @endif
                                    @if(count($list) > 0)
                                    @foreach($list['lt4t'] as $item)
                                        <td>{{ $item->jumlah }}</td>
                                    @endforeach
                                    @endif
                                    @if(count($list) > 0)
                                    @foreach($list['kebt'] as $item)
                                        <td>{{ $item->jumlah }}</td>
                                    @endforeach
                                    @endif
                                    @if(count($list) > 0)
                                    @foreach($list['icut'] as $item)
                                        <td>{{ $item->jumlah }}</td>
                                    @endforeach
                                    @endif
                                    @if(count($list) > 0)
                                    @foreach($list['isot'] as $item)
                                        <td>{{ $item->jumlah }}</td>
                                    @endforeach
                                    @endif
                                    @if(count($list) > 0)
                                    @foreach($list['perint'] as $item)
                                        <td>{{ $item->jumlah }}</td>
                                    @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-headline">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <h5 class="text-center"><b>RUANG KAMAR PASIEN TERSEDIA</b></h5>
                                </tr>
                                <tr>
                                    {{-- Bangsal LT.3 --}}
                                    <th class="text-center" rowspan="2"><b>Kamar</b></th>
                                    @if (count($list['lt3k']) == '1')
                                        <th colspan="1">BANGSAL LT.3</th>
                                    @endif
                                    @if (count($list['lt3k']) == '2')
                                        <th colspan="2">BANGSAL LT.3</th>
                                    @endif
                                    @if (count($list['lt3k']) == '3')
                                        <th colspan="3">BANGSAL LT.3</th>
                                    @endif
                                    @if (count($list['lt3k']) == '4')
                                        <th colspan="4">BANGSAL LT.3</th>
                                    @endif
                                    @if (count($list['lt3k']) == '5')
                                        <th colspan="5">BANGSAL LT.3</th>
                                    @endif
                                    {{-- Bangsal LT.4 --}}
                                    @if (count($list['lt4k']) == '1')
                                        <th colspan="1">BANGSAL LT.4</th>
                                    @endif
                                    @if (count($list['lt4k']) == '2')
                                        <th colspan="2">BANGSAL LT.4</th>
                                    @endif
                                    @if (count($list['lt4k']) == '3')
                                        <th colspan="3">BANGSAL LT.4</th>
                                    @endif
                                    @if (count($list['lt4k']) == '4')
                                        <th colspan="4">BANGSAL LT.4</th>
                                    @endif
                                    @if (count($list['lt4k']) == '5')
                                        <th colspan="5">BANGSAL LT.4</th>
                                    @endif
                                    {{-- Kebidanan --}}
                                    @if (count($list['kebk']) == '1')
                                        <th colspan="1">KEBIDANAN</th>
                                    @endif
                                    @if (count($list['kebk']) == '2')
                                        <th colspan="2">KEBIDANAN</th>
                                    @endif
                                    @if (count($list['kebk']) == '3')
                                        <th colspan="3">KEBIDANAN</th>
                                    @endif
                                    @if (count($list['kebk']) == '4')
                                        <th colspan="4">KEBIDANAN</th>
                                    @endif
                                    @if (count($list['kebk']) == '5')
                                        <th colspan="5">KEBIDANAN</th>
                                    @endif

                                        @if (count($list['icuk']) > 0 )
                                        <th>ICU</th>
                                        @endif
                                        @if (count($list['isok']) > 0 )
                                        <th>ISOLASI</th>
                                        @endif
                                        @if (count($list['perink']) > 0 )
                                        <th>PERINATOLOGI</th>
                                        @endif
                                </tr>
                                <tr>
                                    @foreach($list['lt3k'] as $item)
                                        @if ($item->SET_KELAS == '01')
                                        <th>KLS 3</th>
                                        @endif
                                        @if ($item->SET_KELAS == '02')
                                        <th>KLS 2</th>
                                        @endif
                                        @if ($item->SET_KELAS == '03')
                                        <th>KLS 1</th>
                                        @endif
                                        @if ($item->SET_KELAS == '04')
                                        <th>KLS 1'</th>
                                        @endif
                                        @if ($item->SET_KELAS == '05')
                                        <th>VIP</th>
                                        @endif
                                        @if ($item->SET_KELAS == '07')
                                        <th>VIP'</th>
                                        @endif
                                    @endforeach
                                    @foreach($list['lt4k'] as $item)
                                        @if ($item->SET_KELAS == '01')
                                        <th>KLS 3</th>
                                        @endif
                                        @if ($item->SET_KELAS == '02')
                                        <th>KLS 2</th>
                                        @endif
                                        @if ($item->SET_KELAS == '03')
                                        <th>KLS 1</th>
                                        @endif
                                        @if ($item->SET_KELAS == '04')
                                        <th>KLS 1'</th>
                                        @endif
                                        @if ($item->SET_KELAS == '05')
                                        <th>VIP</th>
                                        @endif
                                        @if ($item->SET_KELAS == '07')
                                        <th>VIP'</th>
                                        @endif
                                    @endforeach
                                    @foreach($list['kebk'] as $item)
                                        @if ($item->SET_KELAS == '01')
                                        <th>KLS 3</th>
                                        @endif
                                        @if ($item->SET_KELAS == '02')
                                        <th>KLS 2</th>
                                        @endif
                                        @if ($item->SET_KELAS == '03')
                                        <th>KLS 1</th>
                                        @endif
                                        @if ($item->SET_KELAS == '04')
                                        <th>KLS 1'</th>
                                        @endif
                                        @if ($item->SET_KELAS == '05')
                                        <th>VIP</th>
                                        @endif
                                        @if ($item->SET_KELAS == '07')
                                        <th>VIP'</th>
                                        @endif
                                    @endforeach
                                    @foreach($list['icuk'] as $item)
                                        @if ($item->SET_KELAS == '00')
                                        <th>ICU</th>
                                        @endif
                                    @endforeach
                                    @foreach($list['isok'] as $item)
                                        @if ($item->SET_KELAS == '08')
                                        <th>ISO</th>
                                        @endif
                                    @endforeach
                                    @foreach($list['perink'] as $item)
                                        @if ($item->SET_KELAS == '06')
                                        <th>PERIN</th>
                                        @endif
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-center"><b>Total</b></th>
                                    @if(count($list) > 0)
                                    @foreach($list['lt3k'] as $item)
                                        <td>{{ $item->jumlah }}</td>
                                    @endforeach
                                    @endif
                                    @if(count($list) > 0)
                                    @foreach($list['lt4k'] as $item)
                                        <td>{{ $item->jumlah }}</td>
                                    @endforeach
                                    @endif
                                    @if(count($list) > 0)
                                    @foreach($list['kebk'] as $item)
                                        <td>{{ $item->jumlah }}</td>
                                    @endforeach
                                    @endif
                                    @if(count($list) > 0)
                                    @foreach($list['icuk'] as $item)
                                        <td>{{ $item->jumlah }}</td>
                                    @endforeach
                                    @endif
                                    @if(count($list) > 0)
                                    @foreach($list['isok'] as $item)
                                        <td>{{ $item->jumlah }}</td>
                                    @endforeach
                                    @endif
                                    @if(count($list) > 0)
                                    @foreach($list['perink'] as $item)
                                        <td>{{ $item->jumlah }}</td>
                                    @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-headline">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="h3 mb-0 text-gray-800">Daftar Kamar Pasien Terisi</h1>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-sm" style="max-height: 500px; display: inline-block" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Ruang</th>
                                            <th>Kelas</th>
                                            <th>Nama</th>
                                            <th>Alokasi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Total Jml</th>
                                            <th class="text-center" colspan="3">{{ count($list['terisi']) }}</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @if(count($list) > 0)
                                            @foreach($list['terisi'] as $item)
                                            <tr>
                                                {{-- RUANG --}}
                                                @if ($item->REF_SUBINSTALASI == '0400')
                                                    <th>ICU</th>
                                                @endif
                                                @if ($item->REF_SUBINSTALASI == '0401')
                                                    <th>BANGSAL LT.3</th>
                                                @endif
                                                @if ($item->REF_SUBINSTALASI == '0402')
                                                    <th>BANGSAL LT.4</th>
                                                @endif
                                                @if ($item->REF_SUBINSTALASI == '0403')
                                                    <th>KEBIDANAN</th>
                                                @endif
                                                @if ($item->REF_SUBINSTALASI == '0405')
                                                    <th>ISOLASI</th>
                                                @endif
                                                @if ($item->REF_SUBINSTALASI == '0406')
                                                    <th>PERINATOLOGI</th>
                                                @endif
                                                {{-- KELAS --}}
                                                @if ($item->SET_KELAS == '00')
                                                    <th>ICU</th>
                                                @endif
                                                @if ($item->SET_KELAS == '01')
                                                    <th>KLS 3</th>
                                                @endif
                                                @if ($item->SET_KELAS == '02')
                                                    <th>KLS 2</th>
                                                @endif
                                                @if ($item->SET_KELAS == '03')
                                                    <th>KLS 1</th>
                                                @endif
                                                @if ($item->SET_KELAS == '04')
                                                    <th>KLS 1</th>
                                                @endif
                                                @if ($item->SET_KELAS == '05')
                                                    <th>VIP</th>
                                                @endif
                                                @if ($item->SET_KELAS == '06')
                                                    <th>PERIN</th>
                                                @endif
                                                @if ($item->SET_KELAS == '07')
                                                    <th>VIP</th>
                                                @endif
                                                @if ($item->SET_KELAS == '08')
                                                    <th>ISO</th>
                                                @endif
                                                <td>{{$item->TMPTIDUR}}</td>
                                                <td>{{$item->ALOKASI}}</td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h1 class="h3 mb-0 text-gray-800">Daftar Kamar Pasien Tersedia</h1>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-sm" style="max-height: 500px; display: inline-block" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Ruang</th>
                                            <th>Kelas</th>
                                            <th>Nama</th>
                                            <th>Alokasi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Total Jml</th>
                                            <th class="text-center" colspan="3">{{ count($list['kosong']) }}</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @if(count($list) > 0)
                                        @foreach($list['kosong'] as $item)
                                            <tr>
                                                {{-- RUANG --}}
                                                @if ($item->REF_SUBINSTALASI == '0400')
                                                    <th>ICU</th>
                                                @endif
                                                @if ($item->REF_SUBINSTALASI == '0401')
                                                    <th>BANGSAL LT.3</th>
                                                @endif
                                                @if ($item->REF_SUBINSTALASI == '0402')
                                                    <th>BANGSAL LT.4</th>
                                                @endif
                                                @if ($item->REF_SUBINSTALASI == '0403')
                                                    <th>KEBIDANAN</th>
                                                @endif
                                                @if ($item->REF_SUBINSTALASI == '0405')
                                                    <th>ISOLASI</th>
                                                @endif
                                                @if ($item->REF_SUBINSTALASI == '0406')
                                                    <th>PERINATOLOGI</th>
                                                @endif
                                                {{-- KELAS --}}
                                                @if ($item->SET_KELAS == '00')
                                                    <th>ICU</th>
                                                @endif
                                                @if ($item->SET_KELAS == '01')
                                                    <th>KLS 3</th>
                                                @endif
                                                @if ($item->SET_KELAS == '02')
                                                    <th>KLS 2</th>
                                                @endif
                                                @if ($item->SET_KELAS == '03')
                                                    <th>KLS 1</th>
                                                @endif
                                                @if ($item->SET_KELAS == '04')
                                                    <th>KLS 1</th>
                                                @endif
                                                @if ($item->SET_KELAS == '05')
                                                    <th>VIP</th>
                                                @endif
                                                @if ($item->SET_KELAS == '06')
                                                    <th>PERIN</th>
                                                @endif
                                                @if ($item->SET_KELAS == '07')
                                                    <th>VIP</th>
                                                @endif
                                                @if ($item->SET_KELAS == '08')
                                                    <th>ISO</th>
                                                @endif
                                                <td>{{$item->TMPTIDUR}}</td>
                                                <td>{{$item->ALOKASI}}</td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
	<!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->
@endsection
