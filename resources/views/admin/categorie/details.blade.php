@extends('admin.base')

@section('scriptCSS')
    
    <style>
        #iconCover {
            display: none;
            max-height: 200px;
            overflow: auto;
        }
        a.icofont-click div {
            color: #333;
            border: 1px solid #CCC;
            padding: 8px;
            border-radius: 3px;
            margin-bottom: 15px;
            display: inline-block;
        }
    </style>

@endsection

@section('content')
    
    <div class="page-wrapper">
        
        <div class="page-breadcrumb">
           <div class="row">
               <div class="col-12 d-flex no-block align-items-center">
                   <h4 class="page-title">Panneau de configuration</h4>
                   <div class="ml-auto text-right">
                       <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('indexAdmin')}} ">Accueil</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('listeAnnonce')}} ">Annonces</a></li>
                               <li class="breadcrumb-item active" aria-current="page">{{ $id }}</li>
                               <li class="breadcrumb-item active" aria-current="page">Détails</li>
                           </ol>
                       </nav>
                   </div>
               </div>
           </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12">

                    @if ($message = Session::get('error'))    
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @endif

                    @if ($message = Session::get('success'))    
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif
                    
                    @foreach ($categoriesEdit as $categorie)
                        <form action="{{ route('updateCategorie', $categorie->id) }}" method="post">
                            @csrf
                            
                            <div class="col-12">
                                <label for="nom">Nom de la categorie*</label>
                                <input type="text" required class="form-control" name="nom" id="nom" value="{{ $categorie->nom }}">
                            </div>
                            <div class="col-sm-12"><br />
                                <button type="submit" class="btn btn-success">
                                    Mettre à jour
                                </button>
                                <a href="{{ route('supprimerCategorie', $categorie->id) }}" class="btn btn-danger">
                                    Supprimer la catégorie
                                </a>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>

        <footer class="footer text-center">
           Togosimé 2019 | By <a href="https://ibtagroup.com">IBTAGroup</a>.
       </footer>

    </div>

    
@endsection

@section('scriptJs')
    
@endsection