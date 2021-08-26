@extends('auth.login.layout.layout-login')

@section('content')	
<div class="vertical-align-wrap">
    <div class="vertical-align-middle">
        <div class="auth-box ">
            <div class="left">
                <div class="content">
                    <div class="header">
                        <div class="logo text-center"><img src="{{ asset('sb-admin2/img/pku_brand.png') }}" alt="Klorofil Logo"></div>
                        <p class="lead">Masuk Sebagai Farmasi</p>
                    </div>
                    <form class="form-auth-small" method="POST" action="{{ route('post.login.farmasi') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="control-label sr-only">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label sr-only">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required autocomplete="current-password">
                            
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group clearfix">
                            <label class="fancy-checkbox element-left">
                                <input type="checkbox" name="remember" id="ckb1" {{ old('remember') ? 'checked' : '' }}>
                                <span>Ingat Saya</span>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-info btn-lg btn-block">MASUK</button>
                        {{--  <div class="bottom">
                            <span class="helper-text"><i class="fa fa-lock"></i> <a href="#">Forgot password?</a></span>
                        </div>  --}}
                    </form>
                </div>
            </div>
            <div class="right">
                <div class="overlay"></div>
                <div class="content text">
                    <h1 class="heading">Rumah Sakit PKU Muhammadiyah Sukoharjo</h1>
                    <p>System by <b>IT Support</b></p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
@endsection