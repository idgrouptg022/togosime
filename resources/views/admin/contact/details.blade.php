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
                               <li class="breadcrumb-item active" aria-current="page">Contacts</li>
                           </ol>
                       </nav>
                   </div>
               </div>
           </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                
                <div class="col-lg-8 col-md-12 col-sm-12">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @endif

                    @foreach ($contacts as $contact)
                        <form action="{{ route('ajouterContactFrom', $contact->id) }}" method="post" class="row">
                            @csrf
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="libelle">Libellé</label>
                                <input type="text" id="libelle" required name="libelle" class="form-control" value="{{ $contact->libelle }}" placeholder="Saisir dans le champs ..."><br />
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="valeur">Valeur</label>
                                <input type="text" id="valeur" required name="valeur" class="form-control" value="{{ $contact->valeur }}" placeholder="Saisir dans le champs ...">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success">
                                    Mettre à jour
                                </button>
                            </div>
                        </form><br /><br />
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