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
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('listeProduit')}} ">Produit</a></li>
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
                    
                    @foreach ($produits as $produit)
                        <form action="{{ route('updateProduit', $produit->id) }}" method="post" enctype="multipart/form-data" class="row">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 col-sm-6 col-md-12">
                                    <b>Image du produit</b>
                                    <img src="{{ URL::asset($produit->image) }}" alt="" width="100%">
                                    <br /><br />
                                </div>
                            </div>                            
                            <div class="col-12">
                                <label for="nom">Nom du produit*</label>
                                <input type="text" class="form-control" required name="nom" id="nom" value="{{ $produit->nom }}">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label>Catégorie*</label>
                                <select name="categorie" required id="categorie" class="form-control">
                                    @forelse ($categories as $categorie)
                                        <option <?=($produit->categorie_id == $categorie->id) ? 'selected' : '' ?> value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                                    @empty
                                        <option disabled selected>Aucune catégorie</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <strong>Prix*</strong><br />
                                <input type="number" required id="prix" name="prix" class="btn-block mt-2 mb-2 form-control" value="{{ $produit->prix }}">
                            </div>
                            <div class="col-12">
                                <label for="description">Description du produit*</label>
                                <textarea class="form-control" required name="description" id="description" placeholder="Saisir dans le champs ..." rows="7">{{ $produit->description }}</textarea>
                            </div>
                            <div class="col-sm-12">
                                <strong>Sélectionnez une image*</strong><br />
                                <input type="file" id="image" name="image" class="btn-block mt-2 mb-2">
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success">
                                    Mettre à jour
                                </button>
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