@extends('layouts.front')

@section('content')
<aside id="fh5co-hero">
    <div class="flexslider">
        <ul class="slides">
           <li style="background-image: url(images/img_bg_4.jpg);">
               <div class="overlay-gradient"></div>
               <div class="container">
                   <div class="row">
                       <div class="col-md-8 col-md-offset-2 text-center slider-text">
                           <div class="slider-text-inner">
                               <h1 class="heading-section">NOUVELLE PREINSCRIPTION</h1>
                                <h2>Reservez votre place. Remplissez le formulaire et nous vous accompagnerons</h2>
                           </div>
                       </div>
                   </div>
               </div>
           </li>
          </ul>
      </div>
</aside>

<div id="fh5co-contact">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-push-1 animate-box">

                <div class="fh5co-contact-info">
                    <h3>Informations de contact</h3>
                    <h4>EAD BRAZZAVILLE</h4>
                    <ul>
                        <li class="address">98 Rue MASUKU, <br> SIS AU QUARTIER MOUNGALI</li>
                        <li class="phone"><a href="tel://00242044449801">+ 242 04 444 98 01</a></li>
                        <li class="email"><a href="mailto:eadbzv@gmail.com">eadbzv@gmail.com</a></li>

                    </ul>
                    <h4 >EAD POINTE-NOIRE</h4>
                    <ul>
                        <li class="address">Derriere PLASCO, <br> SIS AU QUARTIER MPITA</li>
                        <li class="phone"><a href="tel://00242044449812">+ 242 04 444 98 12</a></li>
                        <li class="email"><a href="mailto:eadpnr@gmail.com">eadpnr@gmail.com</a></li>

                    </ul>
                </div>

            </div>
            <div class="col-md-6 animate-box">
                <h3>Remplissez le formulaire</h3>
                <form action="/etudiant/register" method="POST">
                    @csrf
                    <div class="row form-group">
                        <div class="col-md-6">
                            <!-- <label for="fname">First Name</label> -->
                            <input type="text" id="fname" name="nom" class="form-control" placeholder="Votre nom">
                        </div>
                        <div class="col-md-6">
                            <!-- <label for="lname">Last Name</label> -->
                            <input type="text" id="lname" name="prenom" class="form-control" placeholder="Votre Prenom">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-5">
                            <label for="email">Date de naissance</label>
                            <input type="date" id="dtn" name="dtn" class="form-control" placeholder="Date de naissance">
                        </div>

                        <div class="col-md-7">
                            <label for="email">Lieu de naissance</label>
                            <input type="text" id="lieu" name="lieu" class="form-control" placeholder="Lieu de naissance">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-4">
                            <select required name="option_id" id="option_id" class="form-control">
                                <option value="">Choix de l'option</option>
                                @foreach ($options as $option )
                                    <option value="{{ $option->id }}">{{ $option->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <select required name="niveau" id="niveau" class="form-control">
                                <option value="">NIVEAU</option>
                                <option value="1">NIVEAU 1</option>
                                <option value="2">NIVEAU 2</option>
                                <option value="3">NIVEAU 3</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <select required name="site_id" id="option_id" class="form-control">
                                <option value="">Choix du Site</option>
                                @foreach ($sites as $site )
                                    <option value="{{ $site->id }}">{{ $site->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-5">
                            <select required name="diplome_id" id="diplome_id" class="form-control">
                                <option value="">Dernier diplome</option>
                                @foreach ($diplomes as $diplome )
                                    <option value="{{ $diplome->id }}">{{ $diplome->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <select required name="serie_id" id="serie_id" class="form-control">
                                <option value="">SERIE</option>
                                @foreach ($series as $serie)
                                    <option value="{{ $serie->id }}">{{ $serie->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <input type="number" name="annee" class="form-control" placeholder="annee d'obtention">
                        </div>
                    </div>

                    <div class="row form-group">

                        <div class="col-md-7">
                            <input type="text" name="etablissement" class="form-control" placeholder="Etablissement">
                        </div>
                        <div class="col-md-5">
                            <select required name="ville_id" id="ville_id" class="form-control">
                                <option value="">VILLE</option>
                                @foreach ($villes as $ville)
                                    <option value="{{ $ville->id }}">{{ $ville->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="row form-group">

                        <div class="col-md-4">
                            <select required name="pay_id" id="pay_id" class="form-control">
                                <option value="">Nationalite</option>
                                @foreach ($pays as $pay)
                                    <option value="{{ $pay->id }}">{{ $pay->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <input type="text" name="telephone" class="form-control" placeholder="Telephone">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="whatsapp" class="form-control" placeholder="Numero Whatsapp">
                        </div>

                    </div>


                    <div class="row form-group">
                        <div class="col-md-4">
                            <!-- <label for="email">Email</label> -->
                            <input type="text" id="pere" name="pere" class="form-control" placeholder="Nom du pere">
                        </div>
                        <div class="col-md-4">
                            <!-- <label for="email">Email</label> -->
                            <input type="text" id="mere" name="mere" class="form-control" placeholder="Nom de la mere">
                        </div>

                        <div class="col-md-4">
                            <!-- <label for="email">Email</label> -->
                            <input type="text" id="tuteur" name="tuteur" class="form-control" placeholder="Nom du tuteur">
                        </div>
                    </div>


                    <div class="form-group">
                        <input type="submit" value="Enregistrer votre preinscription" class="btn btn-primary">
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

@endsection
