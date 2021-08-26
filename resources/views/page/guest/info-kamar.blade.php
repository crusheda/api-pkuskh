<!DOCTYPE html>
<html lang="en">

<head>

  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('sb-admin2/img/pku_brand.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('sb-admin2/img/pku_brand.png') }}">

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <meta name="description" content="Rumah Sakit PKU Muhammadiyah Sukoharjo">
  <meta name="author" content="Yussuf | IT">

  <title>Info Tempat Tidur | Rumah Sakit PKU Muhammadiyah Sukoharjo</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('sb-admin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  {{-- <link href="{{ asset('sb-admin2/css/bootstrap.css') }}" rel="stylesheet"> --}}
  <link href="{{ asset('sb-admin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('sb-admin2/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
  <script src="{{ asset('sb-admin2/vendor/jquery/jquery.js') }}"></script>
  <script src="{{ asset('sb-admin2/js/moment.min.js') }}"></script>
  <script src="{{ asset('sb-admin2/js/bootstrap-datetimepicker.min.js') }}"></script>
</head>
<style>
@media screen and (max-width: 400px) {
@-ms-viewport { width: 320px; }
/* CSS for 320px layout goes here */
}

@media screen and (min-width: 400px) and (max-width: 640px) {
@-ms-viewport { width: 400px; }
/* CSS for 400px layout goes here */
}

@media screen and (min-width: 640px) and (max-width: 1024px) {
@-ms-viewport { width: 640px; }
/* CSS for 640px layout goes here */
}

@media screen and (min-width: 1024px) and (max-width: 1366px) {
@-ms-viewport { width: 1024px; }
/* CSS for 1024px layout goes here */
}

@media screen and (min-width: 1366px) {
/* CSS for 1366px layout goes here */
}
</style>

<body id="page-top">
    <!-- Page Wrapper -->

    <div id="wrapper">

        <div id="content-wrapper" class="d-flex flex-column">

            <div class="card shadow mb-4">
                <div class="card-header py-3 text-center">
                    <h3 class="m-0 font-weight-bold text-primary"><b>Informasi Tempat Tidur Pasien</b></h3>
                    <strong class="text-success">Rumah Sakit PKU Muhammadiyah Sukoharjo</strong>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <h5 class="m-0 font-weight-bold text-primary">Update : <strong class="text-success">{{ $list['now']->toFormattedDateString() }}</strong>   ( <strong class="text-warning">{{ $list['now']->toTimeString() }}</strong> WIB )</h5>
                        <table class="table table-bordered" id="dataTable" style="overflow: auto;width: 100%;font-size: 1em" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" rowspan="2"><b>Kamar</b></th>
                                <th colspan="4">BANGSAL LT.3</th>
                                <th colspan="4">BANGSAL LT.4</th>
                                <th colspan="4">KEBIDANAN</th>
                                <th rowspan="2">ICU</th>
                                <th rowspan="2">ISOLASI</th>
                                <th rowspan="2">PERINATOLOGI</th>
                            </tr>
                            <tr>
                                <th>VIP</th>
                                <th>KL1</th>
                                <th>KL2</th>
                                <th>KL3</th>
                                <th>VIP</th>
                                <th>KL1</th>
                                <th>KL2</th>
                                <th>KL3</th>
                                <th>VIP</th>
                                <th>KL1</th>
                                <th>KL2</th>
                                <th>KL3</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th><b>Kapasitas</b></th>
                                @foreach($list['totlt3'] as $item)
                                    <th>{{ $item->jumlah }}</th>
                                @endforeach
                                @foreach($list['totlt4'] as $item)
                                    <th>{{ $item->jumlah }}</th>
                                @endforeach
                                @foreach($list['totkeb'] as $item)
                                    <th>{{ $item->jumlah }}</th>
                                @endforeach
                                @foreach($list['toticu'] as $item)
                                    <th>{{ $item->jumlah }}</th>
                                @endforeach
                                @foreach($list['totiso'] as $item)
                                    <th>{{ $item->jumlah }}</th>
                                @endforeach
                                @foreach($list['totperin'] as $item)
                                    <th>{{ $item->jumlah }}</th>
                                @endforeach
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <th><b>Terisi</b></th>
                                <td>{{ $list['lt3vipt'][0]->jumlah }}</td>
                                <td>{{ $list['lt3kl1t'][0]->jumlah }}</td>
                                <td>{{ $list['lt3kl2t'][0]->jumlah }}</td>
                                <td>{{ $list['lt3kl3t'][0]->jumlah }}</td>

                                <td>{{ $list['lt4vipt'][0]->jumlah }}</td>
                                <td>{{ $list['lt4kl1t'][0]->jumlah }}</td>
                                <td>{{ $list['lt4kl2t'][0]->jumlah }}</td>
                                <td>{{ $list['lt4kl3t'][0]->jumlah }}</td>

                                <td>{{ $list['kebvipt'][0]->jumlah }}</td>
                                <td>{{ $list['kebkl1t'][0]->jumlah }}</td>
                                <td>{{ $list['kebkl2t'][0]->jumlah }}</td>
                                <td>{{ $list['kebkl3t'][0]->jumlah }}</td>

                                <td>{{ $list['icut'][0]->jumlah }}</td>
                                <td>{{ $list['isot'][0]->jumlah }}</td>
                                <td>{{ $list['perint'][0]->jumlah }}</td>
                            </tr>
                            <tr>
                                <th><b>Kosong</b></th>
                                @if ($list['lt3vipk'][0]->jumlah == 0 )
                                    <td><span class="badge badge-pill badge-danger">PENUH</span></td>
                                @else
                                    <td>{{ $list['lt3vipk'][0]->jumlah }}</td>
                                @endif
                                @if ($list['lt3kl1k'][0]->jumlah == 0 )
                                    <td><span class="badge badge-pill badge-danger">PENUH</span></td>
                                @else
                                    <td>{{ $list['lt3kl1k'][0]->jumlah }}</td>
                                @endif
                                @if ($list['lt3kl2k'][0]->jumlah == 0 )
                                    <td><span class="badge badge-pill badge-danger">PENUH</span></td>
                                @else
                                    <td>{{ $list['lt3kl2k'][0]->jumlah }}</td>
                                @endif
                                @if ($list['lt3kl3k'][0]->jumlah == 0 )
                                    <td><span class="badge badge-pill badge-danger">PENUH</span></td>
                                @else
                                    <td>{{ $list['lt3kl3k'][0]->jumlah }}</td>
                                @endif

                                @if ($list['lt4vipk'][0]->jumlah == 0 )
                                    <td><span class="badge badge-pill badge-danger">PENUH</span></td>
                                @else
                                    <td>{{ $list['lt4vipk'][0]->jumlah }}</td>
                                @endif
                                @if ($list['lt4kl1k'][0]->jumlah == 0 )
                                    <td><span class="badge badge-pill badge-danger">PENUH</span></td>
                                @else
                                    <td>{{ $list['lt4kl1k'][0]->jumlah }}</td>
                                @endif
                                @if ($list['lt4kl2k'][0]->jumlah == 0 )
                                    <td><span class="badge badge-pill badge-danger">PENUH</span></td>
                                @else
                                    <td>{{ $list['lt4kl2k'][0]->jumlah }}</td>
                                @endif
                                @if ($list['lt4kl3k'][0]->jumlah == 0 )
                                    <td><span class="badge badge-pill badge-danger">PENUH</span></td>
                                @else
                                    <td>{{ $list['lt4kl3k'][0]->jumlah }}</td>
                                @endif

                                @if ($list['kebvipk'][0]->jumlah == 0 )
                                    <td><span class="badge badge-pill badge-danger">PENUH</span></td>
                                @else
                                    <td>{{ $list['kebvipk'][0]->jumlah }}</td>
                                @endif
                                @if ($list['kebkl1k'][0]->jumlah == 0 )
                                    <td><span class="badge badge-pill badge-danger">PENUH</span></td>
                                @else
                                    <td>{{ $list['kebkl1k'][0]->jumlah }}</td>
                                @endif
                                @if ($list['kebkl2k'][0]->jumlah == 0 )
                                    <td><span class="badge badge-pill badge-danger">PENUH</span></td>
                                @else
                                    <td>{{ $list['kebkl2k'][0]->jumlah }}</td>
                                @endif
                                @if ($list['kebkl3k'][0]->jumlah == 0 )
                                    <td><span class="badge badge-pill badge-danger">PENUH</span></td>
                                @else
                                    <td>{{ $list['kebkl3k'][0]->jumlah }}</td>
                                @endif

                                @if ($list['icuk'][0]->jumlah == 0 )
                                    <td><span class="badge badge-pill badge-danger">PENUH</span></td>
                                @else
                                    <td>{{ $list['icuk'][0]->jumlah }}</td>
                                @endif
                                @if ($list['isok'][0]->jumlah == 0 )
                                    <td><span class="badge badge-pill badge-danger">PENUH</span></td>
                                @else
                                    <td>{{ $list['isok'][0]->jumlah }}</td>
                                @endif
                                @if ($list['perink'][0]->jumlah == 0 )
                                    <td><span class="badge badge-pill badge-danger">PENUH</span></td>
                                @else
                                    <td>{{ $list['perink'][0]->jumlah }}</td>
                                @endif
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                <div class="copyright text-center my-auto"><p class="text-muted mb-0">Copyright &copy; IT Support 2020</p>
                </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <script src="{{ asset('sb-admin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sb-admin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sb-admin2/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
