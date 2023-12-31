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
        <h2 id="title">DONNEES GLOBALES ENVIRONNEMENTALES</h2>
        <div class="row">
            <div class="col-md-5 col-sm-12">
                <fieldset>
                    <legend>Selectionner un operateur pour obtenir ses donnees specifiques</legend>
                    <form class="" action="/dashboard" method="get">
                        <div class="form-group">
                            <select required name="name" id="entreprise_id" class="form-control">
                                <option value="">Operateur ...</option>
                                @foreach ($entreprises as $op)
                                    <option value="{{ $op->id }}">{{ $op->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
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
        <div id="elec-section" class="hs">
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
        </div>
        <hr/>
        <div id="eau-section" class="hs">
            <div class="section-title">
                <h5 class="text-center">Consommation eau en m3</h5>
            </div>
            <div class="row">
                <div style="display: flex" class="col-md-5 col-sm-12">
                    <div style="align-self: center">
                        <p>Moyenne de la consommation d'eau des entreprises participantes </p>
                    </div>
                </div>
                <div class="col-md-7 col-sm-12">
                    <div style="width: 500px;"><canvas id="eau"></canvas></div>
                </div>
            </div>
        </div>
        <hr/>
        <div id="ges-section">
            <div class="section-title">
                <h5 class="text-center">Emission de Gaz à effet de serre en tCO2e </h5>
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

        <hr/>
        <div id="source-section" class="hs">
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

      </div>
    </section><!-- End Services Section -->
  </main><!-- End #main -->
  <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
  <script>
    var elec = document.getElementById("elec").getContext("2d");
    $(document).ready(function(){
        $.ajax({
            url:"{{ route('front.data') }}",
            type:'get',
            dataType:'json',
            success:function(secs){
                console.log('ok')
                //console.log(Object.keys(secs.sec1));
                drawCharts(secs);

              },
            error:function(err){
                console.log(err);
            }
        });
    });

    $('#entreprise_id').change(function(){
        var _id = $(this).val();


        if(_id>0){
            $('.hs').hide();
            var name = $('#entreprise_id option:selected').text();
            var title = `DONNEES ENVIRONNEMENTALES - ${name}`;
        }else{
            $('.hs').show();
            var title = `DONNEES ENVIRONNEMENTALES GLOBALES`;
        }
        $('#title').text(title);
        $.ajax({
            url:"{{ route('front.data') }}",
            type:'get',
            dataType:'json',
            data:{id:_id},
            success:function(secs){
                console.log('ok')
                //console.log(Object.keys(secs.sec1));
                //elecChart.destroy();
                let chart1 = Chart.getChart("elec"); // <canvas> id
                    if (chart1 != undefined) {
                        console.log("electricite");
                        chart1.destroy();
                    }
                let chart2 = Chart.getChart("eau"); // <canvas> id
                    if (chart2 != undefined) {
                        console.log("eau");
                        chart2.destroy();
                    }
                let chart3 = Chart.getChart("ges"); // <canvas> id
                    if (chart3 != undefined) {
                        console.log("ges");
                        chart3.destroy();
                    }
                    let chart4 = Chart.getChart("source"); // <canvas> id
                    if (chart4 != undefined) {
                        console.log("source");
                        chart4.destroy();
                    }
                drawCharts(secs);

              },
            error:function(err){
                console.log(err);
            }
        });
    });

    function drawCharts(secs){
        var qt_eau = secs.qt_eau;
        console.log(Object.values(qt_eau));
        console.log(Object.entries(qt_eau));
       // var arr1 = Object.entries(secs.elec);
        lab1 = Object.keys(secs.elec);
        dat1 = Object.values(secs.elec);
       // var arr2 = Object.entries(secs.eau);
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

        var elecChart = new Chart(
            elec,
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
    }
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
