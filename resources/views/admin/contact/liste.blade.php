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

                    <form action="{{ route('ajouterContact') }}" method="post" class="row">
                        @csrf
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label for="libelle">Libellé</label>
                            <input type="text" id="libelle" required name="libelle" class="form-control" placeholder="Saisir dans le champs ..."><br />
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label for="valeur">Valeur</label>
                            <input type="text" id="valeur" required name="valeur" class="form-control" placeholder="Saisir dans le champs ...">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success">
                                Ajouter le contact
                            </button>
                        </div>
                    </form><br /><br />

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><b>Libellé</b></th>
                                                    <th><b>valeur</b></th>
                                                    <th class="text-center"><b>Action</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($contacts as $contact)
                                                    <tr>
                                                        <td>{{ $contact->libelle }}</td>
                                                        <td>{{ $contact->valeur }}</td>
                                                        <td width="120" class="text-center">
                                                            <a href="{{ route('detailsContact', $contact->id) }}" class="btn btn-outline-success">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <a href="{{ route('supprimerContact', $contact->id) }}" class="btn btn-outline-danger">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center">
                                                            Aucun contacts !
                                                        </td>
                                                    </tr>
                                                @endforelse
                                                
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th><b>Libellé</b></th>
                                                    <th><b>valeur</b></th>
                                                    <th class="text-center"><b>Action</b></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
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