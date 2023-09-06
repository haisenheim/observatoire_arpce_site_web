@extends('Layouts/front')

@section('content')
<script src="{{ asset('js/chart.min.js') }}"></script>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{ route('front.accueil') }}">Accueil</a></li>
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

      </div>
    </section><!-- End Services Section -->
  </main><!-- End #main -->
  <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
  <script>
    $(document).ready(function(){
        $.ajax({
            url:"{{ route('front.data') }}",
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

               // $(".badge-e2c").text("E2C - "+secs.source.e2c+"%");
               // $(".badge-ge").text("GE - "+secs.source.ge+"%");
              //  $(".badge-er").text("Renouvelable - "+secs.source.er+"%");
               // var l1 = Object.keys(secs.sec1);
               // var d1 = Object.values(secs.sec1);


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
