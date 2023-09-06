@extends('Layouts/front')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{ route('front.accueil') }}">Accueil</a></li>
          <li>Faq</li>
        </ol>
        <h2>FOIRE AUX QUESTIONS</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="accordion" id="accordionExample">
                <?php $i=0; ?>
                @foreach ($faqs as $faq )
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $i }}">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $i }}" aria-expanded="true" aria-controls="collapseOne">
                        <span style="font-weight: 700; color:#769C38;">{{ $faq->question }}</span>
                      </button>
                    </h2>
                    <div id="collapse{{ $i }}" class="accordion-collapse collapse {{ $i==0?'show':'' }}" aria-labelledby="heading{{ $i }}" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        <?= $faq->reponse ?>
                      </div>
                    </div>
                  </div>
                  <?php $i++; ?>
                @endforeach

              </div>


        </div>
    </section><!-- End About Section -->

  </main><!-- End #main -->

@endsection
