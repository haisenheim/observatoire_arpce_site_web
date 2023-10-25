
@extends('Layouts.front')

@section('content')
    <div id="main" class="scrolled-offse">
        <div id="div-flash" class="container">
            @include('includes.flash-message')
        </div>
                <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

              <ol>
                <li><a href="{{ route('front.accueil') }}">ACCUEIL</a></li>
                <li>Profil</li>
              </ol>
              <h2>{{ $profil->name}}</h2>

            </div>
        </section><!-- End Breadcrumbs -->
        <div class="container">
            <div class="m-5">
                <form method="POST" enctype="multipart/form-data" action="{{ route('account.profil.store') }}">
                    <div class="container" style="max-width: 700px; margin: 0 auto;">
                        @csrf
                        <div class="form-group">
                            <label for="">NOM</label>
                            <input type="text" name="user_name" value="{{ $profil->name }}" required placeholder="Nom de l'administrateur" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">TELEPHONE</label>
                            <input type="text" name="user_phone" value="{{ $profil->phone }}" required placeholder="Numero de telephone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">EMAIL</label>
                            <input type="email" name="user_email" value="{{ $profil->email }}" required placeholder="Email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">MOT DE PASSE</label>
                            <input type="password" name="password"  required placeholder="Mot de passe" class="form-control">
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-success">Enregistrer</button>
                        </div>
                    </div>
                    </form>
            </div>
        </div>
    </div>
@endsection
