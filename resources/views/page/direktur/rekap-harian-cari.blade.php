@extends('layouts.layout-direktur')

@section('content')
<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
	<div class="main-content">
        <div class="container-fluid">
            {{--  <a href="{{ route('direktur.cetakold') }}" class="btn btn-warning text-white">
                <i class="lnr lnr-printer">  </i>CETAK
            </a>  --}}
            <div class="row">
                <div class="col-md-6">
                    <form class="form-inline" action="{{ route('direktur.cetakold') }}" method="GET">
                        <span>Cetak</span>
                        <select onchange="submitBtn()" class="form-control" style="width: auto;margin-left:10px;margin-right:10px" name="tanggal" id="tanggal" required>
                            <option hidden selected>Tgl</option>
                            <option value="01">1</option>
                            <option value="02">2</option>
                            <option value="03">3</option>
                            <option value="04">4</option>
                            <option value="05">5</option>
                            <option value="06">6</option>
                            <option value="07">7</option>
                            <option value="08">8</option>
                            <option value="09">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                        <select onchange="submitBtn()" class="form-control" style="width: auto;margin-right:10px" name="bulan" id="bulan" required>
                            <option hidden selected>Bln</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        <select onchange="submitBtn()" class="form-control" style="width: auto;margin-right:10px" name="tahun" id="tahun" required>
                            <option hidden selected>Thn</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                            <option value="2018">2018</option>
                        </select>
                        <button class="btn btn-warning text-white" id="submit" disabled>CETAK</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-inline" action="{{ route('direktur.rekapharian.cari') }}" method="GET">
                        <span>Filter</span>
                        <select onchange="submitBtn2()" class="form-control" style="width: auto;margin-left:10px;margin-right:10px" name="tanggal" id="tanggal2" required>
                            <option hidden selected>Tgl</option>
                            <option value="01">1</option>
                            <option value="02">2</option>
                            <option value="03">3</option>
                            <option value="04">4</option>
                            <option value="05">5</option>
                            <option value="06">6</option>
                            <option value="07">7</option>
                            <option value="08">8</option>
                            <option value="09">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                        <select onchange="submitBtn2()" class="form-control" style="width: auto;margin-right:10px" name="bulan" id="bulan2" required>
                            <option hidden selected>Bln</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        <select onchange="submitBtn2()" class="form-control" style="width: auto;margin-right:10px" name="tahun" id="tahun2" required>
                            <option hidden selected>Thn</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                            <option value="2018">2018</option>
                        </select>
                        <button class="btn btn-success text-white" id="submit2" disabled>Cari</button>
                    </form>
                </div>
            </div>
			<p></p>
			<!-- Rekap Kemarin -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Rekap Kunjungan Pasien</h3>
					<p class="panel-subtitle">Filter: {{ $list['now'] }}</p><hr>

				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-5">
							<div class="table-responsive">
								<table class="table table-bordered table-hover table-sm" id="tabelrekap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Perincian</th>
                                            <th>Jml</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Total Jml</th>
                                            <th colspan="11">{{ $list['total'][0]->jumlah }}</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <th>Rawat Darurat / Poli Umum (IGD)</th>
                                            <td>{{ $list['igd'][0]->jumlah }}</td>
                                        </tr>
                                        <tr>
                                            <th>Poli Anak</th>
                                            <td>{{ $list['anak'][0]->jumlah }}</td>
                                        </tr>
                                        <tr>
                                            <th>Poli Bedah</th>
                                            <td>{{ $list['bedah'][0]->jumlah }}</td>
                                        </tr>
                                        <tr>
                                            <th>Poli Gigi</th>
                                            <td>{{ $list['gigi'][0]->jumlah }}</td>
                                        </tr>
                                        <tr>
                                            <th>Poli Dalam</th>
                                            <td>{{ $list['dalam'][0]->jumlah }}</td>
                                        </tr>
                                        <tr>
                                            <th>Poli Ortopedi</th>
                                            <td>{{ $list['orto'][0]->jumlah }}</td>
                                        </tr>
                                        <tr>
                                            <th>Poli Jiwa</th>
                                            <td>{{ $list['jiwa'][0]->jumlah }}</td>
                                        </tr>
                                        <tr>
                                            <th>Poli Kulit / Kelamin</th>
                                            <td>{{ $list['kulit'][0]->jumlah }}</td>
                                        </tr>
                                        <tr>
                                            <th>Poli THT</th>
                                            <td>{{ $list['tht'][0]->jumlah }}</td>
                                        </tr>
                                        <tr>
                                            <th>Poli Paru</th>
                                            <td>{{ $list['paru'][0]->jumlah }}</td>
                                        </tr>
                                        <tr>
                                            <th>Poli Syaraf</th>
                                            <td>{{ $list['syaraf'][0]->jumlah }}</td>
                                        </tr>
                                        <tr>
                                            <th>Rehabilitasi Medik</th>
                                            <td>{{ $list['rehab'][0]->jumlah }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kebidanan</th>
                                            <td>{{ $list['keb'][0]->jumlah }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
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
                                            <td>{{ $list['umum'][0]->jumlah }}</td>
                                            <td>{{ $list['bpjs'][0]->jumlah }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>Rawat Inap</th>
                                        <th>Laboratorium</th>
                                        <th>Radiologi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $list['inap'][0]->jumlah }}</td>
                                            <td>{{ count($list['lab']) }}</td>
                                            <td>{{ count($list['rad']) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
						</div>
					</div>
				</div>
			</div>
			<!-- END Rekap Kemarin -->
		</div>
	</div>
	<!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->
<script>
    function submitBtn() {
        var tanggal = document.getElementById("tanggal").value;
        var bulan = document.getElementById("bulan").value;
        var tahun = document.getElementById("tahun").value;
        if (tanggal != "Tgl" && bulan != "Bln" && tahun != "Thn" ) {
            document.getElementById("submit").disabled = false;
        }
    }
</script>
<script>
    function submitBtn2() {
        var tanggal = document.getElementById("tanggal2").value;
        var bulan = document.getElementById("bulan2").value;
        var tahun = document.getElementById("tahun2").value;
        if (tanggal != "Tgl" && bulan != "Bln" && tahun != "Thn" ) {
            document.getElementById("submit2").disabled = false;
        }
    }
</script>
@endsection
