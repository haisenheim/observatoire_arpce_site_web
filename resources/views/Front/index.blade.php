@extends('Layouts/front')

@section('content')
  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

          <!-- Slide 1 -->
          <div class="carousel-item active" style="background-image: url({{ asset('Eterna/assets/img/slide/slide-1.jpg')}})">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Bienvenue à l'<span>Observatoire</span> du Numérique <span>Soutenable</span></h2>
                <p class="animate__animated animate__fadeInUp">Découvrez l'observatoire dédié à la mesure et à la réduction de l'empreinte carbone
                    du secteur numérique au Congo. Explorez les données, les indicateurs et les initiatives pour
                    un avenir numérique durable.</p>

              </div>
            </div>
          </div>

          <!-- Slide 2 -->
          <div class="carousel-item" style="background-image: url({{ asset('Eterna/assets/img/slide/slide-2.jpg')}})">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated fanimate__adeInDown">Agissez pour un <span>numérique responsable</span></h2>
                <p class="animate__animated animate__fadeInUp">Découvrez comment vous pouvez contribuer à réduire l'empreinte carbone du
                    numérique. Apprenez les bonnes pratiques, adoptez des technologies éco-responsables et
                    participez à des initiatives pour un impact positif sur l'environnement.</p>

              </div>
            </div>
          </div>

          <!-- Slide 3 -->
          <div class="carousel-item" style="background-image: url({{ asset('Eterna/assets/img/slide/slide-3.jpg')}})">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Suivez les <span>progrès</span> et les <span>initiatives</span></h2>
                <p class="animate__animated animate__fadeInUp">Explorez notre tableau de bord interactif pour suivre les performances
                    environnementales du secteur numérique au Congo.</p>
              </div>
            </div>
          </div>

        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

            <!-- ======= Featured Section ======= -->
    <section id="featured" class="featured">
        <div class="container">
            <div class="section-title">
                <!-- <i style="font-size: 110px;" class="bi bi-list-check"></i> -->
                 <h2> Objectifs de l'Observatoire</h2>
            </div>
          <div class="row">
            <div class="col-lg-3">
              <div class="icon-box">
                <i class="bi bi-search"></i>
                <h3><a href="">COLLECTE</a></h3>
                <p>Collecter et analyser les données sur l'impact environnemental du numérique.</p>
              </div>
            </div>
            <div class="col-lg-3 mt-4 mt-lg-0">
              <div class="icon-box">
                <i class="bi bi-binoculars"></i>
                <h3><a href="">MONITORING</a></h3>
                <p>Surveiller les progrès réalisés dans la réduction de l'empreinte carbone du secteur numérique.</p>
              </div>
            </div>
            <div class="col-lg-3 mt-4 mt-lg-0">
              <div class="icon-box">
                <i class="bi bi-soundwave"></i>
                <h3><a href="">SENSIBILISATION</a></h3>
                <p>Sensibiliser les acteurs de l'écosystème numérique aux enjeux environnementaux.</p>
              </div>
            </div>
            <div class="col-lg-3 mt-4 mt-lg-0">
                <div class="icon-box">
                  <i class="bi bi-graph-up"></i>
                  <h3><a href="">DEVELOPPEMENT</a></h3>
                  <p>Développer des recommandations pour une transformation numérique plus durable.</p>
                </div>
              </div>
          </div>

        </div>
      </section><!-- End Featured Section -->


          <!-- ======= Missions Section ======= -->
        <section id="about" class="about">
            <div class="container">

              <div class="section-title">
                <h2>Nos missions </h2>
                <div class="pt-4 pt-lg-0 content">
                    <ul>
                        <li><i class="bi bi-check-circle"></i>Évaluer la consommation d'énergie des infrastructures numériques.</li>
                        <li><i class="bi bi-check-circle"></i>Mesurer les émissions de gaz à effet de serre liées à la production et à l'utilisation du numérique.</li>
                        <li><i class="bi bi-check-circle"></i>Analyser la consommation d'eau des data centers et des infrastructures de télécommunication.</li>
                        <li><i class="bi bi-check-circle"></i>Étudier la gestion des déchets électroniques.</li>
                        <li><i class="bi bi-check-circle"></i>Promouvoir l'utilisation des énergies renouvelables dans le secteur numérique.</li>
                      </ul>
                </div>
              </div>

            </div>
          </section><!-- End Missions Section -->

          <!-- ======= Engagements Section ======= -->
        <section id="about" class="about">
            <div class="container">

              <div class="section-title">
                <h2>Notre engagement </h2>
                <div class="pt-4 pt-lg-0 content">
                    <ul>
                        <li><i class="bi bi-check-circle"></i>Contribuer à la transition vers une économie numérique plus respectueuse de l'environnement.</li>
                        <li><i class="bi bi-check-circle"></i> Fournir des informations clés pour orienter les politiques publiques et les initiatives privées.</li>
                        <li><i class="bi bi-check-circle"></i>Encourager la collaboration et le partage des bonnes pratiques entre les acteurs de l'écosystème numérique.</li>
                        <li><i class="bi bi-check-circle"></i> Sensibiliser le public à l'impact environnemental du numérique et à la nécessité de solutions durables.</li>
                      </ul>
                </div>
              </div>
            </div>
          </section><!-- End Engagement Section -->





    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
      <div class="container">

        <div class="section-title">
          <h2>ENTREPRISES PARTENAIRES</h2>
          <p>Découvrez nos précieux partenaires du secteur numérique qui collaborent activement avec
            l'Observatoire du Numérique Soutenable pour promouvoir des pratiques durables et
            contribuer à la préservation de l'environnement. </p>
        </div>

        <div class="clients-slider swiper">
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="{{ asset('Eterna/assets/img/clients/client-1.png') }}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{ asset('Eterna/assets/img/clients/client-2.png') }}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{ asset('Eterna/assets/img/clients/client-3.png') }}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{ asset('Eterna/assets/img/clients/client-4.png') }}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{ asset('Eterna/assets/img/clients/client-5.png') }}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{ asset('Eterna/assets/img/clients/client-6.png') }}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{ asset('Eterna/assets/img/clients/client-7.png') }}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{ asset('Eterna/assets/img/clients/client-8.png') }}" class="img-fluid" alt=""></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Clients Section -->

  </main><!-- End #main -->
@endsection

