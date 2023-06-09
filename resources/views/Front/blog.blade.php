@extends('Layouts/front')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="/">ACCUEIL</a></li>
          <li>Publications</li>
        </ol>
        <h2>Publications</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="">
            @foreach ($rapports as $rapport)
                <div style="width: 100%; padding:10px;">
                    <div style="display:flex; justify-content: start;background-color: #ededed;">
                        <div style="width: 120px">
                            <img width="100" style="background: #fff" src="{{ $rapport->entreprise->photo }}" alt="">
                        </div>
                        <div style="padding: 10px 0;">
                            <h2><a href="{{ $rapport->fichier }}"> {{ $rapport->name }} </a></h2>
                            <p>{{ $rapport->entreprise->name }} <span style="font-size: 20px; font-weight: 900;">{{ $rapport->annee }}</span></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->
@endsection
