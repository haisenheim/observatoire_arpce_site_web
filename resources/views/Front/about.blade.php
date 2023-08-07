@extends('Layouts/front')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="/">Accueil</a></li>
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
            <img src="assets/img/about.jpg" class="img-fluid" alt="">
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
            <div class="count-box">
              <i class="bi bi-house-door"></i>
              <span data-purecounter-start="0" data-purecounter-end="{{ $param->nb_entreprises }}" data-purecounter-duration="1" class="purecounter"></span>
              <p><strong>Entreprises auditees</strong> consequuntur quae qui deca rode</p>
             
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="bi bi-heart-fill"></i>
              <span data-purecounter-start="0" data-purecounter-end="{{ $param->nb_partenaires }}" data-purecounter-duration="1" class="purecounter"></span>
              <p><strong>Partenaires</strong> adipisci atque cum quia aut numquam delectus</p>
              
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="bi bi-file-excel"></i>
              <span data-purecounter-start="0" data-purecounter-end="{{ $param->nb_rapports }}" data-purecounter-duration="1" class="purecounter"></span>
              <p><strong>Rapports produits</strong> aut commodi quaerat. Aliquam ratione</p>
              
            </div>
          </div>

          

        </div>

      </div>
    </section><!-- End Counts Section -->



  </main><!-- End #main -->

@endsection
