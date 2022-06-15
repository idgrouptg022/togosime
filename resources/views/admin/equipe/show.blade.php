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
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('listeMembre')}} ">Membres</a></li>
                               <li class="breadcrumb-item active" aria-current="page">{{  $team->nom }}</li>
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

                    <form action="{{ $team->pathUpdate() }}" method="post" enctype="multipart/form-data" class="row">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-md-12">
                                <b>Image du membre</b>
                                <img src="{{ URL::asset('storage/app/public/'. $team->photo) }}" alt="Image non chargée" width="100%">
                                <br /><br />
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="nom">Nom du membre*</label>
                            <input type="text" class="form-control" required name="nom" id="nom" value="{{ $team->nom }}">
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 mt-3">
                            <label for="poste">Poste du membre*</label>
                            <input type="text" name="poste" id="poste" required class="form-control" value="{{ $team->poste }}">
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 mt-3">
                            <label for="telephone">Téléphone du membre*</label>
                            <input type="tel" required id="telephone" name="telephone" class=" form-control" value="{{ $team->numero_telephone }}">
                        </div>
                        <div class="col-12 mt-3">
                            <label for="description">Détails du membre</label>
                            <textarea name="contenu" id="description" class="form-control" rows="10">{!! $team->details !!}</textarea>
                        </div>
                        <div class="col-sm-12">
                            <strong>Sélectionnez une image*</strong><br />
                            <input type="file" id="image" name="image" class="btn-block mt-2 mb-2 form-control">
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success">
                                Mettre à jour
                            </button>
                            <a href="{{ route('listeMembre') }}" class="btn btn-secondary ml-3">Retour</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <footer class="footer text-center">
           Togosimé 2019 | By <a href="https://ibtagroup.com">IBTAGroup</a>.
       </footer>

    </div>


@endsection

@section('scriptJs')
    <script src="{{ URL::asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function() {

            CKEDITOR.replace('description');
        })
    </script>
@endsection
