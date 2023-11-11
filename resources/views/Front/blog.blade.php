@extends('Layouts/front')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{ route('front.accueil') }}">Accueil</a></li>
          <li>Publications</li>
        </ol>
        <h2>Publications</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-8 entries">

            @foreach ($articles as $article)
            <article class="entry">

                <div class="entry-img">
                  <img src="{{ $article->photo }}" alt="" class="img-fluid">
                </div>

                <h2 class="entry-title">
                  <a href="{{ route('front.article',$article->token) }}">{{ $article->name }}</a>
                </h2>

                <div class="entry-meta">
                  <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="#">{{ $article->user?$article->user->name:'admin' }}</a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time datetime="2020-01-01">{{ date_format($article->created_at,'d/m/Y') }}</time></a></li>

                  </ul>
                </div>

                <div class="entry-content">
                  <p>
                    {{ $article->body }}
                  </p>
                  <div class="read-more">
                    <a href="{{ route('front.article',$article->token) }}">Lire</a>
                  </div>
                </div>

              </article><!-- End blog entry -->
            @endforeach




            <div class="blog-pagination">
                {{ $articles->links() }}
            </div>

          </div><!-- End blog entries list -->

          <div class="col-lg-4">

            <div class="sidebar">
              <div class="sidebar-item search-form">
                <form action="">
                  <input type="text">
                  <button type="submit"><i class="bi bi-search"></i></button>
                </form>
              </div><!-- End sidebar search formn-->

              <h3 class="sidebar-title">Categories</h3>
              <div class="sidebar-item categories">
                <ul>
                    @foreach ($categories as $cat)
                    <li><a href="#">{{ $cat->name }} <span>({{ $cat->articles->count() }})</span></a></li>
                    @endforeach

                </ul>
              </div><!-- End sidebar categories-->


              <h3 class="sidebar-title">Mots clefs</h3>
              <div class="sidebar-item tags">
                <ul>
                    @foreach ($tags as $tag)
                    <li><a href="#">{{ $tag->name }}</a></li>
                    @endforeach
                </ul>
              </div><!-- End sidebar tags-->

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->
@endsection
