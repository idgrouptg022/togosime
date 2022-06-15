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
                    
                    @foreach ($annonces as $annonce)
                        <form action="{{ route('updateAnnonce', $annonce->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 col-sm-6 col-md-12">
                                    <b>Image de l'annonce</b>
                                    <img src="{{ URL::asset($annonce->image) }}" alt="" width="100%">
                                </div>
                            </div><br /><br />
                            <div class="col-12">
                                <label for="titre">Titre de l'annonce*</label>
                                <input type="text" required class="form-control" name="titre" id="titre" value="{{ $annonce->titre }}">
                            </div>
                            <div class="col-12">
                                <label for="description">Description de l'annonce*</label>
                                <textarea class="form-control" required name="description" id="description" rows="10">{{ $annonce->description }}</textarea>
                            </div>
                            <div class="col-sm-12">
                                <strong>Sélectionnez une image</strong><br />
                                <input type="file" id="image" name="image" class="btn-block mt-2 mb-2">
                            </div>
                            <div class="col-sm-12"><br />
                                <button type="submit" class="btn btn-success">
                                    Mettre à jour
                                </button>
                                <a href="{{ route('supprimerAnnonce', $annonce->id) }}" class="btn btn-danger">
                                    Supprimer l'annonce
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