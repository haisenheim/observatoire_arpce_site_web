@extends('Layouts/front')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{ route('front.accueil') }}">Accueil</a></li>
          <li>Bonnes pratiques</li>
        </ol>
        <h2>BONNES PRATIQUES</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div style="display: flex; flex-direction: column; justify-content: space-between; min-height: 200px;">
                @foreach ($pratiques as $faq )
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
                {{ $pratiques->links() }}
              </div>


        </div>
    </section><!-- End About Section -->

  </main><!-- End #main -->

  <style>
        .bg-light{
            background: #ececec;
        }
  </style>

@endsection
