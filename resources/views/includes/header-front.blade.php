<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Observatoire du Numerique SOUTENABLE | ARPCE</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="img/favicon.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Vendor CSS Files -->
  <link href="{{ asset('Eterna/assets/vendor/animate.css/animate.min.cs') }}s" rel="stylesheet">
  <link href="{{ asset('Eterna/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('Eterna/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('Eterna/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('Eterna/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('Eterna/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('Eterna/assets/css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>


      <!-- ======= Top Bar ======= -->
 <!-- <section id="topbar" class="d-flex align-items-center">

    <div class="container d-flex justify-content-center justify-content-md-between">

      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@arpce.cg">contact@arpce.cg</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+242 05 510 72 72</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="https://twitter.com/ARPCECongo" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="https://facebook.com/arpce" class="facebook"><i class="bi bi-facebook"></i></a>

        <a href="https://linkedin.com/company/arpce-congo" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </section> -->

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container-fluid">
        <div style="display: flex; justify-content: space-between">
            <div class="">
                <div class="logo">
                    <!-- <h1><a href="/">Eterna</a></h1> -->
                     <!-- Uncomment below if you prefer to use an image logo -->
                     <a href='{{ route('front.accueil') }}'><img src="{{ asset('img/logo.png') }}" alt="" class="img-fluid"></a>
                </div>
            </div>
            <div style="align-self: center; padding:5px 10px;" >
                <h5 class="mb-0 text-center" style="font-weight: 800; font-size: 15px; color:#b73f32">OBSERVATOIRE DU NUMERIQUE RESPONSABLE</h5>
            </div>

            <div style="align-self:center;">
                <div class="container d-flex justify-content-between align-items-center">


                    <?php
                          $active = \Illuminate\Support\Facades\Session::get('active');
                          $auth =  auth()->user();
                          ?>

                    <nav id="navbar" class="navbar">
                      <ul>
                        <li><a class="{{ $active==1?'active':'' }}" href="{{ route('front.accueil') }}">ACCUEIL</a></li>
                        <li><a class="{{ $active==2?'active':'' }}" href="{{ route('front.about') }}">A PROPOS</a></li>
                        <li class="">
                            <a class="{{ $active==3?'active':'' }}" href="{{ route('front.dashboard') }}">TABLEAU DE BORD</a>
                        </li>
                        <li class="dropdown {{ $active==4?'active':'' }}"><a href="#"><span>PUBLICATIONS</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                              <li><a href="{{ route('front.blog') }}">ACTUALITE</a></li>

                              <li><a href="{{ route('front.rapports') }}">RAPPORTS</a></li>
                              <li><a href="{{ route('front.textes') }}">TEXTES REGLEMENTAIRES</a></li>
                              <li><a href="{{ route('front.pratiques') }}">BONNES PRATIQUES</a></li>
                            </ul>
                        </li>
                        <li><a class="{{ $active==5?'active':'' }}" href="{{ route('front.faq') }}">FAQ</a></li>
                        <li><a class="{{ $active==6?'active':'' }}" href="{{ route('front.contact') }}">CONTACT</a></li>
                        @if($auth)
                        <?php $entx = \App\Models\Entreprise::find(auth()->user()->entreprise_id); ?>
                      <li class="dropdown">
                          <a class="">
                              <div class="text-center">
                                  <i style="font-size:25px;" class="bi bi-person"></i><i class="bi bi-chevron-down"></i>
                              </div>
                          </a>
                          <ul>
                              <li><a href="{{ route('account.profil') }}">Profil</a></li>
                              <li><a href="{{ route('account.rapports.index') }}">Rapports</a></li>
                              <li><a href="{{ route('account.fiches.index') }}">Fiches</a></li>

                              <li><a href="{{ route('logout') }}">Se deconnecter</a></li>
                          </ul>
                      </li>

                        @else
                          <li><a class="" style="" href="{{ route('login') }}">Connexion</a></li>
                        @endif
                      </ul>
                      <i class="bi bi-list mobile-nav-toggle"></i>
                    </nav><!-- .navbar -->

                  </div>
            </div>
        </div>
    </div>
  </header><!-- End Header -->

<style>
.navbar-mobile ul{
   background: #759b37
}

#main{
    padding-top: 70px;
}
#hero{
    padding-top: 70px;
}
</style>
