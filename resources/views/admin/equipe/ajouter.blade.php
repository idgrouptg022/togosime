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
                               <li class="breadcrumb-item active" aria-current="page">Ajouter un membre</li>
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


                    <form action="{{ route('storeMembre') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <label for="photo">* Photo du membre :</label>
                        <input type="file" name="image" id="photo" class="form-control">
                        <br />

                        <label for="nom">* Nom du membre :</label>
                        <input type="text" name="nom" id="nom" required class="form-control" placeholder="Saisir le nom du membre ici ....">
                        <br />

                        <label for="poste">* Poste du membre :</label>
                        <input type="text" name="poste" id="poste" required class="form-control" placeholder="Saisir le poste du membre ici ....">
                        <br />

                        <label for="telephone">* Téléphone du membre :</label>
                        <input type="tel" name="telephone" id="telephone" class="form-control" required placeholder="Exemple: +22899009900">
                        <br />

                        <label for="editor1">Les détails du membre  <em class="text-muted ml-4">(Ce champ est optionnel)</em></label>
                        <textarea name="contenu" id="editor1" rows="10" class="form-control" placeholder="fdkfldflk"></textarea><br />

                        <button type="submit" class="btn btn-success">
                            Enregistrer le membre
                        </button>

                    </form>
                </div>
            </div>
        </div>

    </div>


@endsection

@section('scriptJs')
    <script src="{{ URL::asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function() {

            CKEDITOR.replace('editor1');
        })
    </script>
@endsection
