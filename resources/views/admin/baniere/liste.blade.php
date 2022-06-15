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
                               <li class="breadcrumb-item active" aria-current="page">Liste des banières</li>
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
                    
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <form action="{{ route('modifierNombreBanniere') }}" method="post">
                        @csrf
                        <table>
                            <tr>
                                <td>
                                    Nombre de produits à afficher
                                </td>
                                <td>
                                    <input type="number" name="valeur" value="{{ $nombreBanniere->valeur }}" placeholder="Saisir le nombre ici ..." class="form-control">
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-md btn-success">
                                        Soumettre
                                    </button>
                                </td>
                            </tr>
                        </table><br />
                    </form>
                </div>
            </div>

            <div class="row">
                
                @foreach(App\Produit::all() as $produit)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div style="height: 170px; overflow: hidden;" class="mb-2">
                            <img src="{{ URL::asset($produit->image) }}" alt="" width="100%">
                        </div>

                        @if(count(Illuminate\Support\Facades\DB::select("SELECT * FROM banieres WHERE id_produit = ?", [$produit->id])) == 0)
                            <a href="{{ route('ajouterProduitAuBanniere', ['id' => $produit->id]) }}" class="btn btn-block btn-md btn-success">
                                Ajouter
                            </a>
                        @else
                            <a href="{{ route('supprimerProduitDuBanniere', ['id' => $produit->id]) }}" class="btn btn-block btn-md btn-secondary">
                                Retier
                            </a>
                        @endif

                        <br /><br />
                    </div>
                @endforeach
                
            </div>
        </div>

        <footer class="footer text-center">
           Togosimé 2019 | By <a href="https://ibtagroup.com">IBTAGroup</a>.
       </footer>

    </div>

    
@endsection

@section('scriptJs')
    
@endsection