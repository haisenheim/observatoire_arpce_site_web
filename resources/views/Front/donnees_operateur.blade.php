@extends('Layouts/front')

@section('content')
<script src="{{ asset('js/chart.min.js') }}"></script>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="/">Accueil</a></li>
          <li>Tableau de bord</li>
        </ol>
        <h2>DONNEES ENVIRONNEMENTALES</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="section-title">
            <h2>TABLEAU DE BORD DES DONNEES ENVIRONNEMENTALES </h2>
            <p>Données collectées auprès des acteurs majeurs du numérique au Congo incluant MTN, Airtel, Congo Telecom…</p>
          </div>
      <div class="container">
        <hr/>
        <div class="section-title">
            <h5 class="text-center">consommation d'électricité en Kwh</h5>
        </div>

        <div class="row">
            <div style="display: flex" class="col-md-5 col-sm-12">
                <div style="align-self: center">
                    <p>Moyenne de la consommation électrique des entreprises participantes.</p>
                </div>
            </div>
            <div class="col-md-7 col-sm-12">
                <div style="width: 500px;"><canvas id="elec"></canvas></div>
            </div>
        </div>
        <hr/>
        <div class="section-title">
            <h5 class="text-center">Consommation eau en m3</h5>
        </div>
        <div class="row">
            <div style="display: flex" class="col-md-5 col-sm-12">
                <div style="align-self: center">
                    <p>Moyenne de la consommation électrique des entreprises participantes </p>
                </div>
            </div>
            <div class="col-md-7 col-sm-12">
                <div style="width: 500px;"><canvas id="eau"></canvas></div>
            </div>
        </div>
        <hr/>
        <div class="section-title">
            <h5 class="text-center">Emission de Gaz à effet de serre en KtCO2e</h5>
        </div>
        <div class="row">
            <div style="display: flex" class="col-md-5 col-sm-12">
                <div style="align-self: center">
                    <p>Calcul des émissions moyenne de Gaz à effet de serre en prenant en compte le mix énergétique du congo d’après les données de E2C </p>
                </div>
            </div>
            <div class="col-md-7 col-sm-12">
                <div style="width: 500px;"><canvas id="ges"></canvas></div>
            </div>
        </div>

        <hr/>
        <div class="section-title">
            <h5 class="text-center">Repartition des sources d'energie</h5>
        </div>
        <div class="row">
            <div style="display: flex" class="col-md-5 col-sm-12">
                <div style="align-self: center">
                    <p>Origines moyennes des approvisionnements énergétiques des entreprises participantes</p>
                </div>
            </div>
            <div class="col-md-7 col-sm-12">
                <div class="text-center" style="width: 170px; margin:5px auto"><canvas id="source"></canvas></div>
                <div style="font-size: smaller" class="text-center">
                    <ul class="list-inline">
                        <li class="list-inline-item"><span class="badge badge-e2c">E2C</span></li>
                        <li class="list-inline-item"><span class="badge badge-ge">GE</span></li>
                        <li class="list-inline-item"><span class="badge badge-er">RENOUVELABLE</span></li>
                    </ul>
                </div>
            </div>
        </div>

      </div>
    </section><!-- End Services Section -->



    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
      <div class="container">

        <div class="section-title">
          <h2>ENTREPRISES PARTENAIRES</h2>
          <p>L'Observatoire du Numérique Soutenable est fier de compter parmi ses partenaires les entreprises ci-dessous</p>
        </div>

        <div class="clients-slider swiper">
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="assets/img/clients/client-1.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-2.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-3.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-4.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-5.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-6.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-7.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-8.png" class="img-fluid" alt=""></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Clients Section -->
  </main><!-- End #main -->
  <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
  <script>
    $(document).ready(function(){
        $.ajax({
            url:'/data',
            type:'get',
            dataType:'json',
            success:function(secs){
                //console.log(Object.keys(secs.sec1));
                var qt_eau = secs.qt_eau;
                console.log(Object.values(qt_eau));
                console.log(Object.entries(qt_eau));
                var arr1 = Object.entries(secs.elec);
                lab1 = Object.keys(secs.elec);
                dat1 = Object.values(secs.elec);
                var arr2 = Object.entries(secs.eau);
                //lab2 = arr2.map((el)=>el[1].annee)
                lab2 = Object.keys(qt_eau);
                //dat2 = arr2.map((el)=>el[1].valeur)
                dat2 = Object.values(qt_eau)
                //var arr3 = Object.entries(secs.ges);
                lab3 = Object.keys(secs.ges);
                dat3 = Object.values(secs.ges);
                dat4 = [secs.source.e2c,secs.source.ge,secs.source.er]

                $(".badge-e2c").text("E2C - "+secs.source.e2c+"%");
                $(".badge-ge").text("GE - "+secs.source.ge+"%");
                $(".badge-er").text("Renouvelable - "+secs.source.er+"%");
               // var l1 = Object.keys(secs.sec1);
               // var d1 = Object.values(secs.sec1);

                new Chart(
                    document.getElementById('elec'),
                    {
                    type: 'line',
                    options: {
                        animation: false,
                        plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: false
                        }
                        }
                    },
                    data: {
                        labels: lab1,
                        datasets: [
                        {
                            label: 'Consommation electrique',
                            data: dat1,
                            borderColor: '#3d9970',
                        }
                        ]
                    }
                    }
                );
                new Chart(
                    document.getElementById('eau'),
                    {
                    type: 'bar',
                    options: {
                        animation: false,
                        plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: false
                        }
                        }
                    },
                    data: {
                        labels: lab2,
                        datasets: [
                        {
                            label: 'Consommation d\'eau',
                            data: dat2,
                            backgroundColor: '#3d9970',
                        }
                        ]
                    }
                    }
                );
                new Chart(
                    document.getElementById('ges'),
                    {
                    type: 'line',
                    options: {
                        animation: false,
                        plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: false
                        }
                        }
                    },
                    data: {
                        labels: lab3,
                        datasets: [
                        {
                            label: 'Gaz a effet de serre',
                            data: dat3,
                            borderColor: '#3d9970',
                        }
                        ]
                    }
                    }
                );
                new Chart(
                    document.getElementById('source'),
                    {
                    type: 'pie',
                    options: {
                        animation: false,
                        plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: false
                        }
                        }
                    },
                    data: {
                        //labels: lab3,
                        datasets: [
                        {
                            label: 'Repartition',
                            data: dat4,
                            //borderColor: '#3d9970',
                            backgroundColor: ['#3080d0','#c11b1b','#3d9970'],
                        }
                        ]
                    }
                    }
                );

              },
            error:function(err){
                console.log(err);
            }
        });
    });
  </script>
  <style>
    .badge-e2c{
        background: #3080d0
    }
    .badge-ge{
        background: #c11b1b
    }
    .badge-er{
        background: #3d9970
    }
  </style>
@endsection