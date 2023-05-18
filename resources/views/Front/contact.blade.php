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
                               <h1 class="heading-section">Contactez nous</h1>
                                <h2>Laissez nous un message et nous vous contacterons</h2>
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
                        <li class="address">Rue Massoukou, Brazzaville, Congo-Brazzaville</li>
                        <li class="phone"><a href="tel://00242 06 468 0107">+242 06 468 0107</a></li>
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
                <h3>Laissez un message</h3>
                <form action="/front/contact" method="POST">
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
                        <div class="col-md-12">
                            <!-- <label for="email">Email</label> -->
                            <input type="text" id="email" name="email" class="form-control" placeholder="Votre adresse email">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <!-- <label for="subject">Subject</label> -->
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Objet de votre message">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <!-- <label for="message">Message</label> -->
                            <textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Saisissez votre message ici"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Envoyez" class="btn btn-primary">
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

@endsection
