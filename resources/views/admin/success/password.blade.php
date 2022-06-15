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

        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark" style="margin-top: -100px;">
            <div class="auth-box bg-dark">
                <div id="loginform">
                    <div class="p-t-20 p-b-20"><br />
                        <h1 style="color: #FFF;" class="text-center">
                            <i class="fa fa-check"></i>
                        </h1><br />
                        <div class="text-center" style="color: #FFF;">
                            <h3 style="font-weight: 100;">Vérifiez votre boite mail</h3>
                            De nouveaux paramètres de connexion viennent de vous être envoyés par
                            mail. vérifiez et suivez les instructions mentionnées !
                        </div>
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

</body>
</html>