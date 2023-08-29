@extends('Layouts/front')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="/">Accueil</a></li>
          <li>Rapports</li>
        </ol>
        <h2>RAPPORTS</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="" style="display: flex; flex-direction: column; justify-content: space-between; min-height: 200px;" id="">
                @foreach ($rapports as $faq )
                <div class="bg-light p-3 mt-2">
                    <div class="">
                      <div class="">
                        <a href="{{ $faq->fichier }}">{{ $faq->name }}</a>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
              <div class="blog-pagination mt-lg-5">
                {{ $rapports->links() }}
              </div>

        </div>
    </section><!-- End About Section -->

  </main><!-- End #main -->

@endsection
