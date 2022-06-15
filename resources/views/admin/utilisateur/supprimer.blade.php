@extends('admin.base')

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
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('listeImage')}} ">Images</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $id }}</li>
                                <li class="breadcrumb-item active" aria-current="page">Supprimer</li>
                           </ol>
                       </nav>
                   </div>
               </div>
           </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12"><br /><br />
                    <strong class="text-danger">Avertissement !!!</strong><br />
                    Êtes-vous sûr(e) de vouloir supprimer cet utilisateur ? Cette action sera irréversible.<br /><br />
                    <a href="{{ route('listeUser') }}" class="btn btn-secondary">
                        Annuler
                    </a>
                    <a href="{{ route('supprimerUserForm', $id) }}" class="btn btn-danger">
                        Supprimer
                    </a>

                </div>
            </div>
        </div>

        <footer class="footer text-center">
           Togosimé 2019 | By <a href="https://ibtagroup.com">IBTAGroup</a>.
       </footer>
       
    </div>

@endsection