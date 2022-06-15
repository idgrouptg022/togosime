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
                               <li class="breadcrumb-item active" aria-current="page">Ajouter page</li>
                           </ol>
                       </nav>
                   </div>
               </div>
           </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <button type="button" class="btn btn-success" id="iconBtn">
                        <i class="fa fa-plus"></i>
                        Cliquez pour ajouter une icone *
                    </button><br /><br />

                    <div id="iconCover">
                        (Cliquez sur une icone pour sélectionner)<br />
                        @forelse ($icons as $icon)
                            <a href="#!" class="icofont-click">
                                <div>
                                    <i class="icon-get icofont-{{ $icon->nom }} icofont-2x" data-value="{{ $icon->nom }}"></i>
                                </div>
                            </a>
                        @empty
                            <b>Aucune icone n'a été ajoutée</b>
                        @endforelse<br />
                    </div>
                    Icône sélectionnée (par défaut)
                    <h1>
                        <i id="selecedIcon" class="icofont-like icofont-2x"></i>
                    </h1><br />
                </div>
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
                    

                    <form action="{{ route('ajouterPageFrom') }}" method="post">
                        @csrf

                        <input type="hidden" name="icone" id="inputIcon" value="like">

                        <label for="titre">Titre de la page</label>
                        <input type="text" required class="form-control" id="titre" name="titre" placeholder="Saisir le titre ici ...">
                        <br />


                        <label for="editor1">Contenu de la page</label>
                        <textarea required name="contenu" id="editor1" rows="10" class="form-control">Saisir ici ...</textarea><br />

                        <button type="submit" class="btn btn-success">
                            Publier la page
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

            $('#iconBtn').click(function() {
                $('#iconCover').slideToggle();
            });

            $('.icon-get').each(function () {
                $(this).click(function () {
                    $('#selecedIcon').removeClass();
                    $('#selecedIcon').addClass('icofont-' + $(this).attr('data-value') + ' icofont-2x');
                    $('#inputIcon').val($(this).attr('data-value'));
                })
            })
        })
    </script>
@endsection