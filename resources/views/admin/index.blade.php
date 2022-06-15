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
                               <li class="breadcrumb-item active" aria-current="page">Accueil</li>
                           </ol>
                       </nav>
                   </div>
               </div>
           </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
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
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3 col-xlg-3">
                    <div class="card card-hover">
                        <a href="{{ route('listeProduit') }}">

                            <div class="box bg-cyan" style="border-radius: 4px;">
                                <h1 class="font-light text-white"><i class="fa fa-database"></i> {{ count($produits) }}</h1>
                                <h6 class="text-white">Tout les produits</h6>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-xlg-3">
                    <a href="{{ route('listeCategorie') }}">
                        <div class="card card-hover">
                            <div class="box" style="border-radius: 4px; background-color: #0AA71A;">
                                <h1 class="font-light text-white"><i class="fa fa-th"></i> {{ count($categories) }}</h1>
                                <h6 class="text-white">Toutes les catégories</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3 col-xlg-3">
                    <a href="{{ route('listeAnnonce') }}">
                        <div class="card card-hover">
                            <div class="box bg-warning" style="border-radius: 4px;">
                                <h1 class="font-light text-white"><i class="fa fa-bell"></i> {{ count($annonces) }}</h1>
                                <h6 class="text-white">Toutes les annonces</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3 col-xlg-3">
                    <a href="{{ route('listeImage') }}">
                        <div class="card card-hover">
                            <div class="box bg-danger" style="border-radius: 4px;">
                                <h1 class="font-light text-white"><i class="fa fa-image"></i> {{ count($images) }}</h1>
                                <h6 class="text-white">Toutes les images</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12"><br />
                    <i class="fa fa-list"></i>
                    <b>Liste des produits</b><br />

                    <div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="zero_config" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th><b>Nom du produit</b></th>
                                                        <th><b>Prix</b></th>
                                                        <th><b>Catégorie</b></th>
                                                        <th class="text-center"><b>Action</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($produits as $produit)    
                                                        <tr>
                                                            <td>{{ $produit->nom }}</td>
                                                            <td class="text-right">{{ $produit->prix }} F CFA</td>
                                                            <td>
                                                                @foreach ($categories as $categorie)
                                                                    @if ($categorie->id == $produit->categorie_id)
                                                                       {{ $categorie->nom }} 
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td width="120" class="text-center">
                                                                <a href="{{ route('detailsProduit', $produit->id) }}" class="btn btn-outline-success">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a href="{{ route('supprimerProduit', $produit->id) }}" class="btn btn-outline-danger">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th><b>Nom du produit</b></th>
                                                        <th><b>Prix</b></th>
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