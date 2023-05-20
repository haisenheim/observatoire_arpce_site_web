<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>ANPCC Manager</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="NyotaShop Manager By Alliages Technologies" name="description" />
        <meta content="NyotaShop Manager" name="Clement ESSOMBA" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">

        <link rel="stylesheet" href="{{asset('css/adminlte.css')}}">
        <style>
            body,html{
                /* background: #f9faf9; */
                /* background: linear-gradient(to right, #5bbdd6,#FFFFFF,#5bbdd6); */
                /* background: url('img/bg1.png');
                background-size: cover; */
                height: 100%;
            }

            .bg-image {
                /* The image used */
                background-image: url('img/bg1.png');

                /* Add the blur effect */
                filter: blur(6px);
                -webkit-filter: blur(6px);

                /* Full height */
                height: 100%;

                /* Center and scale the image nicely */
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            .bg-text {
                    background-color: rgb(0,0,0); /* Fallback color */
                    background-color: rgba(0,0,0, 0.2); /* Black w/opacity/see-through */
                    color: white;
                    font-weight: bold;
                    border: 0.1px solid #f1f1f1;
                    position: absolute;
                    top: 45%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    z-index: 2;
                    padding: 20px;
                    text-align: center;
            }

            * {
                box-sizing: border-box;
                }

        </style>

    </head>

    <body class="">
        <div class="bg-image"></div>
        <div class="container">
            <div class="row">
                <div class="bg-text col-md-4 col-sm-12">
                    <div class="">
                        <div class="">
                            <!-- end row -->

                            <div class="">
                                <div class="">
                                    <div class="" style="background: transparent; border: none">
                                        <div class="card-body">
                                             <div class="text-center mb-5">

                                                <h5 class="font-size-24 font-bold mb-4 text-white" style="margin-top:20px; font-weight: 900">ANPCC MANAGER</h5>
                                            </div>

                                            <div class="">

                                                <form class="form-horizontal" action="{{ route('login') }}" method="post">
                                                     {{ csrf_field() }}
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group mb-4">
                                                                <input type="email" name="email" class="form-control" id="email" placeholder="Saisir votre adresse email">
                                                            </div>
                                                            <div class="form-group mb-4">
                                                                <input name="password" type="password" class="form-control" id="password" placeholder="Saisir votre mot de passe">
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="customControlInline">
                                                                        <label class="custom-control-label  text-white" style="font-size: 0.8rem;" for="customControlInline">Se souvenir de moi</label>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="mt-4">
                                                                <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Se Connecter</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                    <!-- end Account pages -->
                    <div style=" height: 90px; width: 100%; text-align: center;">
                       <span style="color: #cc6600; font-style:italic">By</span>
                       <img src="<?= asset('img/logo-alt.png') ?>" height="90" alt=""/>
                    </div>
                </div>
            </div>
        </div>


    </body>
</html>
