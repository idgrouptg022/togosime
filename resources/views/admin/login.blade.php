<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{URL::asset('dist/css/style.min.css')}}" rel="stylesheet">
    <title>Togosime - Admin</title>
</head>
<body class="bg-dark">
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>

        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark" style="margin-top: -50px;">
            <div class="auth-box bg-dark">
                <div id="loginform">
                    <div class="p-t-20 p-b-20"><br />
                        <h2 style="color: #FFF; font-weight: 100;">Connexion</h2><br />
                    </div>
                    <form class="form-horizontal m-t-20" method="POST" id="loginform" action="{{ route('login') }}">
                        @csrf
                        <div class="row p-b-30">
                            <div class="col-12">
                                
                                @if ($message = Session::get('error'))    
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @endif

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                                    </div>
                                    <input type="email" class="form-control form-control-lg" name="email" placeholder="Email ..." aria-label="Username" aria-describedby="basic-addon1" required="">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" name="password" placeholder="Mot de passe ..." aria-label="Password" aria-describedby="basic-addon1" required="">
                                </div>
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-12"><br />
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <button class="btn" id="to-recover" type="button"><i class="fa fa-lock m-r-5"></i> Mot de passe oublié ?</button>
                                        <button class="btn btn-success float-right" type="submit">Connexion</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="recoverform">
                    <div style="text-align: justify;">
                        <span class="text-white">Entrez l'addresse email que vous utilisiez dans le champs ci-dessous pour recevoir les instruction relatives à la récupération de votre mot de passe.</span><br /><br />
                    </div>
                    <div class="row m-t-20">
                        <form class="col-12" action="{{ route('resetPassword') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                </div>
                                <input type="email" required name="email" class="form-control form-control-lg" placeholder="Adresse email" aria-label="Username" aria-describedby="basic-addon1">
                            </div><br />
                            <div class="row m-t-20 p-t-20">
                                <div class="col-12"><br />
                                    <a class="btn" style="background-color: #CCC; color: #000;" href="#" id="to-login" name="action">Retour</a>
                                    <button class="btn btn-success float-right" type="submit" name="action">Envoyer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div style="position: fixed; top: 0; right: 0; left: 0;padding: 15px;">
            <a href="">
                <img class="rounded" src="{{URL::asset('assets/images/logo.png')}}" alt="logo" width="80">
            </a>
        </div>
        <div class="text-center" style="color: #FFF;">
            <span>
                Togosimé &copy;2019 | Tous droits réservés
            </span>
        </div>
    </div>


    <script src="{{URL::asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{URL::asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{URL::asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{URL::asset('assets/extra-libs/sparkline/sparkline.js')}}"></script>
    <script src="{{URL::asset('dist/js/waves.js')}}"></script>
    <script src="{{URL::asset('dist/js/sidebarmenu.js')}}"></script>
    <script src="{{URL::asset('dist/js/custom.min.js')}}"></script>
    <script src="{{URL::asset('assets/libs/flot/excanvas.js')}}"></script>
    <script src="{{URL::asset('assets/libs/flot/jquery.flot.js')}}"></script>
    <script src="{{URL::asset('assets/libs/flot/jquery.flot.pie.js')}}"></script>
    <script src="{{URL::asset('assets/libs/flot/jquery.flot.time.js')}}"></script>
    <script src="{{URL::asset('assets/libs/flot/jquery.flot.stack.js')}}"></script>
    <script src="{{URL::asset('assets/libs/flot/jquery.flot.crosshair.js')}}"></script>
    <script src="{{URL::asset('assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{URL::asset('dist/js/pages/chart/chart-page-init.js')}}"></script>

    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
        $('#to-login').click(function(){
            
            $("#recoverform").hide();
            $("#loginform").fadeIn();
        });
    </script>
</body>
</html>