<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('mdb/css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('mdb/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('mdb/css/mdb.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('icofont/icofont.min.css')}}">
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/logo.png') }}" type="image/x-icon">
    @yield('scriptCSS')
    <title>Togosime</title>

    <style>
        .menu-bar {
            background-color: #079E2B;
            padding: 5px 23px;
        }
        .search-form {
            margin-left: 100px;
        }
        .search-form input {
            height: 40px;
            border: none;
            outline: none;
            padding: 0 23px;
            width: 400px;
            border-radius: 2px;
        }

        .search-form button {
            height: 40px;
            border-radius: 2px;
            border: none;
            outline: none;
            padding: 0 15px;
            border: 1px solid #777;
        }
        .sous-menu {
            border-bottom: 1px solid #DDD;
            padding: 5px 23px;
        }
        .sous-menu a div {
            border: 1px solid #DDD;
            background-color: #EEE;
            border-radius: 15px;
            font-size: 14px;
            padding: 0 10px;
            color: #222;
            margin-right: 5px;
        }
        .sous-menu a div:hover {
            background-color: #FFF;
        }
        footer {
            background-color: #222;
            padding: 0 10px;
        }

        .btn-categorie {
            display: none;
        }

	.form-sm {
	    display: none;
    	}

        @media(max-width: 720px) {
            .sous-menu {
                display: none;
            }

            .btn-categorie {
                display: block;
            }
	    .form-sm {
		display: block;
            }
	}
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #079E2B;">
        <a class="navbar-brand" href="{{route('index')}}">
	    <table>
		<tr>
		     <td>
            		<img src="{{ URL::asset('assets/images/logo.png') }}" class="rounded" width="45" alt="">
		     </td>
		     <td class="pl-1 pt-1" style="line-height: 13px;">
			 <span class="white-text">
			     <small style="font-size: 12px;">TOGOSIME</small><br />
			     <small style="font-size: 12px;">Maison des produits<br />naturels locaux</small>
			 </span>
		     </td>
		</tr>
	    </table>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02" style="font-size: 14px;">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('index')}}"><b>Accueil</b> <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contacsAncre">
                        <i class="icofont-phone"></i>
                        Contacts
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#mapAncre">
                        <i class="icofont-google-map"></i>
                        Localisation
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('services') }}">
                        Services
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sitesTouristiques') }}">
                        Sites tourristiques
                    </a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="{{ route('produit_rechercher') }}">
                <input style="width: 330px;" class="form-control mr-sm-2" name="search" id="search" type="search" placeholder="Rechercher ...">
                <button class="btn btn-green darken-5 z-depth-0 btn-sm m-0" type="submit"
                style="padding-top: 10px; padding-bottom: 12px; border-radius: 4px; border: 1px solid #777;">
                    Rechercher
                </button>
            </form>
        </div>
      </nav>

    <div class="sous-menu">
        <div class="container-fluid">
            <div class="row">
                @forelse ($categories as $categorie)
                    <a href="{{ route('produit_categorie', ['id' => $categorie->id]) }}">
                        <div class="mb-1">
                            <strong>{{ $categorie->nom }}</strong>
                        </div>
                    </a>
                @empty

                @endforelse
            </div>
        </div>
    </div>

    <center>

	<form class="form-inline form-sm my-2 my-lg-0" action="{{ route('produit_rechercher') }}">
		<table width="100%">
			<tr>
				<td>
					<input class="form-control" style="width: 100%;" name="search" id="search" type="search" placeholder="Rechercher ...">
				</td>
				<td width="75">
					<button class="btn btn-green darken-5 z-depth-0 btn-sm m-0 btn-block" type="submit"
					style="padding-top: 10px; padding-bottom: 12px; border-radius: 4px; border: 1px solid #777;">
					    <i class="icofont-search"></i>
					</button>
				</td>
			</tr>
		</table>
	</form>


	<button class="btn btn-green btn-md roundedto btn-categorie" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
	<i class="icofont-list"></i>
	Voir toutes nos catégories
	</button>
    </center>


    <div class="collapse" id="collapseExample">
    <div class="card card-body">
        <ul class="list-group">
            @foreach ($categories as $categorie)
                <li class="list-group-item">
                    <a href="{{ route('produit_categorie', ['id' => $categorie->id]) }}">
                        {{ $categorie->nom }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    </div>

    @yield('content')

    <footer><br /><br />
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12" id="mapAncre">
                    <b class="white-text"><i class="icofont-map-pins"></i> OU VOUS POUVEZ NOUS TROUVER</b><br />
                    <div class="row">
                        <div class="col-6">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.6162216765356!2d1.1664683146216466!3d6.182090995524408!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTAnNTUuNSJOIDHCsDEwJzA3LjIiRQ!5e0!3m2!1sen!2stg!4v1580311007792!5m2!1sfr!2stg" width="100%" height="200" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                            <div class="white-text" style="font-size: 14px;">TOGOSIME ADIDOGOME</div>
                        </div>
                        <div class="col-6">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.6220912323442!2d1.2474619141599999!3d6.1813082287630525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1023e32dc23cb465%3A0x446d8e9abcf05ab0!2sETS%20TOGOSIME!5e0!3m2!1sfr!2stg!4v1576750000738!5m2!1sfr!2stg" width="100%" height="200" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                            <div class="white-text" style="font-size: 14px;">TOGOSIME HEDZRANAWOE</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12" id="contacsAncre"><br />


                    <b class="white-text">
                        <i class="icofont-phone"></i>
                        NOS CONTACTS
                    </b>
                    <address class="white-text font-size-14">
                        whatsapp : +22891732811<br />
                        Téléphone : +22899051969<br /><br /><br />


                        Togosime &copy; copyright 2019<br />
                        Powered by <a target="_blank" href="http://ibtagroup.com">IBTAGRoup</a>
                    </address>
                </div>
            </div>
        </div><br />
    </footer>

    <script src="{{URL::asset('mdb/js/popper.min.js')}}"></script>
    <script src="{{URL::asset('mdb/js/jquery.min.js')}}"></script>
    <script src="{{URL::asset('mdb/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('mdb/js/mdb.min.js')}}"></script>
    @yield('script')
</body>
</html>
