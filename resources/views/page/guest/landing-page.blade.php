<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Guest | Rumah Sakit PKU Muhammadiyah Sukoharjo</title>

  <!-- Bootstrap Core CSS -->
  <link href="{{ asset('css-landing/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="{{ asset('css-landing/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <link href="{{ asset('css-landing/vendor/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="{{ asset('css-landing/css/stylish-portfolio.min.css') }}" rel="stylesheet">

  <!-- ICONS -->
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('sb-admin2/img/pku_ico.png') }}">

</head>

<body id="page-top">

  <!-- Navigation -->
  <a class="menu-toggle rounded" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar-wrapper">
    <ul class="sidebar-nav">
      <li class="sidebar-brand">
        <a class="js-scroll-trigger">Menu Login</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="{{ route('view.login.direktur') }}">Direktur</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="{{ route('view.login.kantor') }}">Kantor</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="{{ route('view.login.keuangan') }}">Keuangan</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="{{ route('view.login.farmasi') }}">Farmasi</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="{{ route('view.login.kebidanan') }}">Kebidanan</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="{{ route('view.login.rm') }}">Rekam Medik</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="web.pkusukoharjo.com:82">Sismadak Online</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="http://192.168.1.2/sismadak">Sismadak Offline</a>
      </li><hr style="border-color:white;background-color:white">
      <li class="sidebar-nav-item" style="pointer-events:none;opacity:0.6;">
        <a class="js-scroll-trigger" style="" href="">Laporkan Bug?<br>Telp. IT: <b>102</b> (Lokal)</a>
      </li>
    </ul>
  </nav>

  <!-- Header -->
  <header class="content-section bg-primary text-white text-center" style="">
    <div class="container text-center my-auto">
      <img class="img-fluid" style="width:100px" src="{{ asset('sb-admin2/img/LogoClear.png') }}" alt=""><p></p>
      <h2 class="mb-1">Amanah, Santun, Ramah, Ikhlas</h2><hr style="border-color:white;background-color:white">
      <h3>Rumah Sakit PKU Muhammadiyah Sukoharjo</h3>
      <h5 class="mb-1">
        Jl. Mayor Sunaryo No. 37 Sukoharjo (57512)
      </h5>
      <br>
      <a class="btn btn-dark btn-xl js-scroll-trigger" href="#infokamar">Info Kamar</a>
    </div>
    <div class="overlay"></div>
  </header>

  <!-- About -->
  <section class="content-section bg-light" id="infokamar">
    <div class="container text-center">
      <div class="row">
        <div class="col-lg-10 mx-auto">
          <h2>Informasi Kamar Pasien <strong class="text-primary">( Terupdate )</strong></h2>
          <p class="lead mb-5">Daftar jumlah tempat tidur pasien yang tersedia maupun kosong. Bisa juga dilihat <a href="http://pkusukoharjo.com/info-tempat-tidur/">disini</a>!</p>
          <a class="btn btn-primary btn-xl js-scroll-trigger" href="{{ route('info.kamar') }}">Lihat Sekarang</a>
        </div>
      </div>
    </div>
  </section>

  <hr>

  <!-- Footer -->
  <footer class="footer text-center">
    <div class="container">
      <ul class="list-inline mb-5">
        <li class="list-inline-item">
          <a class="social-link rounded-circle text-white mr-3" href="https://www.facebook.com/rspkuskh/">
            <i class="icon-social-facebook"></i>
          </a>
        </li>
        <li class="list-inline-item">
          <a class="social-link rounded-circle text-white mr-3" href="https://www.twitter.com/pku_sukoharjo/">
            <i class="icon-social-twitter"></i>
          </a>
        </li>
        <li class="list-inline-item">
          <a class="social-link rounded-circle text-white" href="http://www.instagram.com/pku.sukoharjo/">
            <i class="icon-social-instagram"></i>
          </a>
        </li>
      </ul>
      <p class="text-muted small mb-0">Copyright &copy; IT Support 2020</p>
    </div>
  </footer>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded js-scroll-trigger" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('css-landing/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('css-landing/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Plugin JavaScript -->
  <script src="{{ asset('css-landing/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for this template -->
  <script src="{{ asset('css-landing/js/stylish-portfolio.min.js') }}"></script>

</body>

</html>
