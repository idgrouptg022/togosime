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
                               <li class="breadcrumb-item active" aria-current="page">Produits</li>
                           </ol>
                       </nav>
                   </div>
               </div>
           </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                @if ($message = Session::get('success'))
                    <div class="col-12">
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-10 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="zero_config">
                                    <thead>
                                        <tr>
                                            <th><b>Nom du produit</b></th>
                                            <th width="100"><b>Prix</b></th>
                                            <th width="200"><b>Catégorie</b></th>
                                            <th class="text-center"><b>Action</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($produits as $produit)    
                                            <tr>
                                                <td>{{ $produit->nom }}</td>
                                                <th width="100" class="text-right"><b>{{ $produit->prix }} F CFA</b></th>
                                                <td>
                                                    @foreach ($categories as $categorie)
                                                        @if ($produit->categorie_id == $categorie->id)
                                                            {{ $categorie->nom }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td width="100" class="text-center">
                                                    <a href="{{ route('detailsProduit', $produit->id) }}" class="btn btn-outline-success">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('supprimerProduit', $produit->id) }}" class="btn btn-outline-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">
                                                    <div class="text-center">
                                                        <b>Aucun produit !</b>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><b>Nom du produit</b></th>
                                            <th width="100"><b>Prix</b></th>
                                            <th><b>Catégorie</b></th>
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

        <footer class="footer text-center">
           Togosimé 2019 | By <a href="https://ibtagroup.com">IBTAGroup</a>.
       </footer>

    </div>

    
@endsection

@section('scriptJs')

    <script>
        $('#zero_config').DataTable();
    </script>
    
@endsection