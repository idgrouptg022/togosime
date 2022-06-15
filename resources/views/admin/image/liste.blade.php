@extends('admin.base')

@section('scriptCSS')
    
    <style>
        .page-container {
            height: 270px;
            overflow: auto;
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
                               <li class="breadcrumb-item active" aria-current="page">Utilisateurs</li>
                           </ol>
                       </nav>
                   </div>
               </div>
           </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                
                @forelse ($images as $image)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <img src="{{ URL::asset($image->fichier) }}" alt="" width="100%">
                        <a href="{{ route('supprimerImage', $image->id) }}" class="btn btn-outline-danger btn-block">
                            Supprimer
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <br /><br />
                        <b>Aucune image ajoutée !</b>
                    </div>
                @endforelse

            </div>
        </div>

        <footer class="footer text-center">
           Togosimé 2019 | By <a href="https://ibtagroup.com">IBTAGroup</a>.
       </footer>

    </div>

    
@endsection

@section('scriptJs')
    
@endsection