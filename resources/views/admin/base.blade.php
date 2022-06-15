<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{URL::asset('dist/css/style.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('icofont/icofont.min.css') }}">
    <link href="{{ URL::asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/logo.png') }}" type="image/x-icon">
    @yield('scriptCSS')
    <title>Togosime - Admin</title>
    <style>
        input, select, textarea {
            border: 1px solid #CCC !important;
        }

        .modal input, .modal textarea, .modal select, .modal .btn {
            border-radius: 15px;
        }
    </style>
</head>
<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <a class="navbar-brand" href="{{ route('indexAdmin') }}">
                        <b class="logo-icon p-l-10">
                            <img src="{{URL::asset('assets/images/logo.png')}}" width="40" alt="homepage" class="light-logo rounded" />
                        </b>
                        <span class="logo-text">
                            Togosime
                        </span>
                    </a>
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5" style="background-color: #0AA71A !important;">
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <span class="d-none d-md-block">Créer nouveau <i class="fa fa-angle-down"></i></span>
                             <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" data-toggle="modal" data-target="#userModal" href="#">Utilisateur</a>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav float-right">
                        <!--<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="{{ route('message') }}"> <i class="font-24 mdi mdi-comment-processing"></i>
                            </a>
                        </li>-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{URL::asset('assets/images/users/1.jpg')}}" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <a class="dropdown-item" href="{{ route('profil') }}"><i class="fa fa-user-circle m-r-5 m-l-5"></i> Mon profil</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-power-off m-r-5 m-l-5"></i> Déconnexion</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-database" style="font-size: 13px;"></i><span class="hide-menu">Produits </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="#!" data-toggle="modal" data-target="#produitModal" class="sidebar-link"><i class="fa fa-plus" style="font-size: 14px;"></i><span class="hide-menu"> Ajouter un produit </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('listeProduit') }}" class="sidebar-link"><i class="fa fa-list" style="font-size: 14px;"></i><span class="hide-menu"> Liste des produits </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-th" style="font-size: 13px;"></i><span class="hide-menu">Catégories </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="#!" data-toggle="modal" data-target="#categorieModal" class="sidebar-link"><i class="fa fa-plus" style="font-size: 14px;"></i><span class="hide-menu"> Ajouter une catégorie </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('listeCategorie') }}" class="sidebar-link"><i class="fa fa-list" style="font-size: 14px;"></i><span class="hide-menu"> Liste des catégories </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-bell" style="font-size: 13px;"></i><span class="hide-menu">Annonces </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="#!" data-toggle="modal" data-target="#annonceModal" class="sidebar-link"><i class="fa fa-plus" style="font-size: 14px;"></i><span class="hide-menu"> Ajouter une annonce </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('listeAnnonce') }}" class="sidebar-link"><i class="fa fa-list" style="font-size: 14px;"></i><span class="hide-menu"> Liste des annonces </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-image" style="font-size: 13px;"></i><span class="hide-menu">Images </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="#!" data-toggle="modal" data-target="#imageModal" class="sidebar-link"><i class="fa fa-plus" style="font-size: 14px;"></i><span class="hide-menu"> Ajouter une image </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('listeImage') }}" class="sidebar-link"><i class="fa fa-list" style="font-size: 14px;"></i><span class="hide-menu"> Liste des images </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-users" style="font-size: 13px;"></i><span class="hide-menu">Utilisateurs </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="#!" data-toggle="modal" data-target="#userModal" class="sidebar-link"><i class="fa fa-plus" style="font-size: 14px;"></i><span class="hide-menu"> Ajouter un utilisateur </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('listeUser') }}" class="sidebar-link"><i class="fa fa-list" style="font-size: 14px;"></i><span class="hide-menu"> Liste des utilisateurs </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-book" style="font-size: 13px;"></i><span class="hide-menu">Pages </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{ route('ajouterPage') }}" class="sidebar-link"><i class="fa fa-plus" style="font-size: 14px;"></i><span class="hide-menu"> Ajouter une page </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('listePage') }}" class="sidebar-link"><i class="fa fa-list" style="font-size: 14px;"></i><span class="hide-menu"> Liste des pages </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-users" style="font-size: 13px;"></i><span class="hide-menu">Equipe </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{ route('ajouterMembre') }}" class="sidebar-link"><i class="fa fa-plus" style="font-size: 14px;"></i><span class="hide-menu"> Ajouter un membre </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('listeMembre') }}" class="sidebar-link"><i class="fa fa-list" style="font-size: 14px;"></i><span class="hide-menu"> Liste des membres </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-tags" style="font-size: 13px;"></i><span class="hide-menu">Services </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{ route('ajouterService') }}" class="sidebar-link"><i class="fa fa-plus" style="font-size: 14px;"></i><span class="hide-menu"> Ajouter un service </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('listeService') }}" class="sidebar-link"><i class="fa fa-list" style="font-size: 14px;"></i><span class="hide-menu"> Liste des services </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-star" style="font-size: 13px;"></i><span class="hide-menu">Sites touristiques </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{ route('ajouterSite') }}" class="sidebar-link"><i class="fa fa-plus" style="font-size: 14px;"></i><span class="hide-menu"> Ajouter un site </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('listeSite') }}" class="sidebar-link"><i class="fa fa-list" style="font-size: 14px;"></i><span class="hide-menu"> Liste des sites </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('banieres') }}" aria-expanded="false"><i class="fa fa-gift" style="font-size: 14px;"></i><span class="hide-menu">Banières</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('listeContact') }}" aria-expanded="false"><i class="fa fa-phone fa-rotate-90" style="font-size: 14px;"></i><span class="hide-menu">Nos contats</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('aPropos') }}" aria-expanded="false"><i class="fa fa-info-circle" style="font-size: 14px;"></i><span class="hide-menu">A propos</span></a></li>
                    </ul>
                </nav>
            </div>
        </aside>

        @yield('content')

    </div>

    <div class="modal fade" id="produitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    ria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 10px;">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">Produit</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('ajouterProduit') }}" method="post" class="row" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label for="nom">Nom du produit*</label>
                            <input type="text" class="form-control" required name="nom" id="nom" placeholder="Saisir dans le champs ...">
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label>Catégorie*</label>
                            <select name="categorie" required id="categorie" class="form-control">
                                @forelse ($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                                @empty
                                    <option disabled selected>Aucune catégorie</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <strong>Prix*</strong><br />
                            <input type="number" required id="prix" name="prix" class="btn-block mt-2 mb-2 form-control">
                        </div>
                        <div class="col-12">
                            <label for="description">Description du produit*</label>
                            <textarea class="form-control" required name="description" id="description" placeholder="Saisir dans le champs ..." rows="7"></textarea>
                        </div>
                        <div class="col-sm-12">
                            <strong>Sélectionnez une image*</strong><br />
                            <input type="file" required id="image" name="image" class="btn-block mt-2 mb-2">
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success">
                                Ajouter le produit
                            </button>
                        </div>

                    </form>

                </div><br />
            </div>
        </div>
    </div>

    <div class="modal fade" id="annonceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    ria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 10px;">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">Annonces</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('ajouterAnnonce') }}" enctype="multipart/form-data" method="post" class="row">
                        @csrf
                        <div class="col-12">
                            <label for="titre">Titre de l'annonce*</label>
                            <input type="text" required class="form-control" name="titre" id="titre" placeholder="Saisir dans le champs ...">
                        </div>
                        <div class="col-12">
                            <label for="description">Description de l'annonce*</label>
                            <textarea class="form-control" required name="description" id="description" placeholder="Saisir dans le champs ..." rows="10"></textarea>
                        </div>
                        <div class="col-sm-12">
                            <strong>Sélectionnez une image*</strong><br />
                            <input type="file" required id="image" name="image" class="btn-block mt-2 mb-2">
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success">
                                Ajouter l'annonce
                            </button>
                        </div>

                    </form>

                </div><br />
            </div>
        </div>
    </div>


    <div class="modal fade" id="categorieModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    ria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 10px;">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">Catégorie</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('ajouterCategorie') }}" method="post">
                        @csrf
                        <label for="nom">Nom de la catégorie*</label>
                        <input type="text" class="form-control" required name="nom" id="nom" placeholder="Saisir dans le champs ...">
                        <button type="submit" class="btn btn-success mt-2">
                            Ajouter la catégorie
                        </button>
                    </form>

                </div><br />
            </div>
        </div>
    </div>


    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    ria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 10px;">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">Image</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('ajouterImage') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-12">
                            <strong>Sélectionnez une image*</strong><br />
                            <input type="file" required id="image" name="image" class="btn-block mt-2 mb-2">
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success">
                                Ajouter l'image
                            </button>
                        </div>
                    </form>

                </div><br />
            </div>
        </div>
    </div>


    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    ria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 10px;">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">Utilisateur</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('ajouterUser') }}" method="post" class="row">
                        @csrf
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label for="nom">Nom complet*</label>
                            <input type="text" class="form-control" required name="nom" id="nom" placeholder="Saisir dans le champs ...">
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label for="email">Email*</label>
                            <input type="email" class="form-control" required name="email" id="email" placeholder="Saisir dans le champs ...">
                        </div>

                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success mt-2">
                                Ajouter l'utilisateur
                            </button>
                        </div>

                    </form>

                </div><br />
            </div>
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
    <script src="{{URL::asset('assets/extra-libs/DataTables/datatables.min.js')}}"></script>
    @yield('scriptJs')
</body>
</html>
