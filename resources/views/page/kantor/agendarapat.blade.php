@extends('layouts.layout-kantor')

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
                <div class="panel panel-headline">
                    <div class="panel-heading">
                        <a href="{{ route('rapat.create') }}" class="btn btn-success text-white">
                            <i class="lnr lnr-printer">  </i>Tambah
                        </a>
                        @if(session()->has('message'))
                            <hr>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <i class="fa fa-info-circle"></i> {{ session()->get('message') }}
                            </div>
                        @endif
                        <hr>
                        <h3 class="panel-title text-center">Laporan Rapat</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="data-table-list">
                                    <div class="table-responsive">
                                        <table id="data-table-basic" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>FILE</th>
                                                    <th>NAME</th>
                                                    <th>TGL</th>
                                                    <th>LEADER</th>
                                                    <th>LOCATION</th>
                                                    <th>NOTE</th>
                                                    <th>SUBJECT</th>
                                                    <th>TIME</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($list) > 0)
                                                @foreach($list['show'] as $item)
                                                <tr>
                                                    <td>
                                                        <a onclick="window.location.href='{{ route('rapat.show', $item->id) }}'" class="btn btn-info btn-sm">
                                                            <i class="lnr lnr-download"></i>
                                                        </a>
                                                    </td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{ $item->title }}</td>
                                                    <td>{{ $item->created_at->diffForHumans() }}</td>
                                                    <td>
                                                        <form action="{{ route('rapat.destroy', $item->id) }}" method="POST">
                                                            <a class="btn btn-warning btn-sm" onclick="window.location.href='{{ route('rapat.update', $item->id) }}'">
                                                                <i class="lnr lnr-pencil"></i>
                                                            </a>
                                                            @method('DELETE')
                                                            @csrf
                                                            <button class="btn btn-danger btn-sm"><i class="lnr lnr-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan=8>Tidak Ada Data</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>FILE</th>
                                                    <th>NAME</th>
                                                    <th>TGL</th>
                                                    <th>LEADER</th>
                                                    <th>LOCATION</th>
                                                    <th>NOTE</th>
                                                    <th>SUBJECT</th>
                                                    <th>TIME</th>
                                                    <th>ACTION</th>
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
