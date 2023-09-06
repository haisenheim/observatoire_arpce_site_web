@extends('Layouts/front')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{ route('front.accueil') }}">Accueil</a></li>
          <li>A PROPOS</li>
        </ol>
        <h2>A PROPOS DE L'OBSERVATOIRE</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row">
          <div class="col-lg-6">
            <img src="{{ asset('img/param/arpce.jpg') }}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content">
            <h3>PRESENTATION</h3>
            <div>
                <?=  $param->about_text ?>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">

        <div class="row no-gutters">
            <div class="col-lg-4 col-md-6 d-md-flex align-items-md-stretch">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">1- TERMINAUX</h3>
                    </div>
                    <div class="card-body">
                        Les terminaux, qu'il s'agisse de smartphones, d'ordinateurs, de tablettes ou de tout autre dispositif connecté, sont devenus indispensables à notre quotidien numérique. Ces appareils ont un impact environnemental à chaque étape de leur cycle de vie, de la fabrication à la fin de vie, en passant par l'utilisation
                    </div>
                </div>
            </div>

          <div class="col-lg-4 col-md-6 d-md-flex align-items-md-stretch">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">2- RESEAUX</h3>
                </div>
                <div class="card-body">
                    Le monde est interconnecté grâce à d'immenses réseaux de communication, qu'il s'agisse de réseaux cellulaires, de lignes fixes ou de liaisons satellitaires. Ces réseaux ont leur propre empreinte environnementale.
                </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-md-flex align-items-md-stretch">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">3- DATA CENTERS</h3>
                </div>
                <div class="card-body">
                    Les data centers sont le cœur battant de l'ère numérique. Ils hébergent les sites web, stockent d'énormes quantités de données et exécutent des applications pour le monde entier. Leur empreinte environnementale est significative, en particulier en raison de leur importante consommation énergétique.
                </div>
            </div>
          </div>



        </div>

      </div>
    </section><!-- End Counts Section -->



  </main><!-- End #main -->

@endsection
