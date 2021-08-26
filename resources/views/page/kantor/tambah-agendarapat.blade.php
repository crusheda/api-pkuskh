@extends('layouts.layout-kantor')

@section('content')
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-headline">
                <div class="panel-heading">
                
                </div>
                <div class="panel-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form class="form-auth-small" action="{{ route('rapat.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="nama">
                        <br>
                        {{-- <input type="text" name="title" id="title" class="form-control" placeholder="title"> --}}
                        <label>File</label>
                            <input type="file" name="file">
                            <span class="help-block text-danger">{{ $errors->first('file') }}</span>
                        </div>
                        <p></p>
                        <button class="btn btn-primary text-white pull-right" id="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection