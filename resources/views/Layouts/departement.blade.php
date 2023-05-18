<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.head')

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div style="background: linear-gradient(to right, #5bbdd6,#FFFFFF,#5bbdd6);" class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('img/logo.png') }}" alt="NyotaShop Manager" height="160" width="160">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">



      <li class="nav-item">
        <p>
            <?php
                $active = \Illuminate\Support\Facades\Session::get('active');
                use Carbon\Carbon;
                $locale = app()->getLocale();

                Carbon::setlocale($locale);
                $date = Carbon::now();
                $translatedDate = $date->translatedFormat('D, j M Y, H:i:s');
                echo($translatedDate);

                 ?>

        </p>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

      <h3 style="text-align:center; font-weight:600" class="brand-text brand-link">CASINO</h3>
      <p style="text-align:center;">
        <a style="color:#fff; font-size:1.4rem;" href="/logout">Se déconnecter</a>
      </p>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="/marchand/dashboard" class="nav-link {{ $active==1?'active':'' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tableau de bord
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/marchand/ventes" class="nav-link {{ $active==2?'active':'' }}">
              <i class="nav-icon fas fa-coins"></i>
              <p>
                Ventes
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/marchand/clients" class="nav-link {{ $active==3?'active':'' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Clients
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/marchand/articles" class="nav-link {{ $active==4?'active':'' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Articles
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/marchand/fidelite" class="nav-link {{ $active==5?'active':'' }}">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Programme de fidélité
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/marchand/litiges" class="nav-link {{ $active==6?'active':'' }}">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Gestionnaire de litiges
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/marchand/rapports" class="nav-link {{ $active==7?'active':'' }}">
              <i class="nav-icon fas fa-file-excel"></i>
              <p>
                Rapports
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/marchand/compte" class="nav-link {{ $active==8?'active':'' }}">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Compte et Paramètres
              </p>
            </a>
          </li>
          <li class="nav-header"></li>
          <li class="nav-item">
            <a style="font-style:italic" href="/machand/applications" class="nav-link nav-light {{ $active==9?'active':'' }}">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>Applications</p>
            </a>
          </li>
          <li class="nav-item">
            <a style="font-style:italic" href="/factures" class="nav-link nav-light {{ $active==10?'active':'' }}">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>Factures</p>
            </a>
          </li>
          <li class="nav-item">
            <a style="font-style:italic" href="#" class="nav-link nav-light">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>Terminaux de paiement</p>
            </a>
          </li>
          <li class="nav-item">
            <a style="font-style:italic" href="#" class="nav-link nav-light">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>Employés</p>
            </a>
          </li>
          <li class="nav-item">
            <a style="font-style:italic" href="#" class="nav-link nav-light">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>Comptabilité</p>
            </a>
          </li>
          <li class="nav-item">
            <a style="font-style:italic" href="#" class="nav-link nav-light">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>Boutique en ligne</p>
            </a>
          </li>
          <li class="nav-item">
            <a style="font-style:italic" href="#" class="nav-link nav-light">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>Rendez-vous</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div style="background: #fff" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        @yield('content-header')
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@include('includes.foot')
</body>
</html>
