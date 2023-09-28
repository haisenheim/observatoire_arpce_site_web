
@extends('Layouts.front')

@section('content')
    <div id="main" class="scrolled-offset">
                <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

              <ol>
                <li><a href="{{ route('front.accueil') }}">ACCUEIL</a></li>
                <li>Profil</li>
              </ol>
              <h2>{{ $profil->entreprise->name }}</h2>

            </div>
        </section><!-- End Breadcrumbs -->
        <div class="container">
            <div class="m-5">
                <form method="POST" enctype="multipart/form-data" action="{{ route('account.profil.store') }}">
                    <div class="">
                        @csrf
                      <div class="row">
                        <div class="row">
                            <div class="col-md-7 col-sm-12">
                                <div class="form-group">
                                    <label for="">ENTREPRISE</label>
                                    <input type="text" name="name" value="{{ $profil->entreprise->name }}" required placeholder="Nom" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">TELEPHONE</label>
                                    <input type="text" name="phone" value="{{ $profil->entreprise->phone }}" required placeholder="Telephone" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" value="{{ $profil->entreprise->email }}" required placeholder="Email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">LOGO </label>
                                    <input type="file" name="logo" placeholder="image" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-12">
                                <fieldset>
                                    <legend>Compte utilisateur</legend>
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
                                </fieldset>
                            </div>
                        </div>

                      </div>
                    </div>
                    <div class="mt-4">
                      <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>
@endsection
