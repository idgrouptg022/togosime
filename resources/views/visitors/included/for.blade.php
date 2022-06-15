@if (count($produits) > 0)
    @foreach ($produits as $produit)
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="product-panel">
                <div style="height: 190px; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                    <a href="{{ route('produit_detail', ['id' => $produit->id]) }}"><img src="{{ URL::asset($produit->image) }}" alt="img-produit" width="100%"></a>
                </div>
                <div class="product-description-panel">
                    <b class="red-text"><b>{{ $produit->prix }} FCFA</b></b>
                    <div class="text-truncate"><a href="{{ route('produit_detail', ['id' => $produit->id]) }}"><b>{{ $produit->nom }}</b></a></div>
                    <div class="buttons">
                        <a href="{{ route('produit_detail', ['id' => $produit->id]) }}" class="btn btn-orange btn-sm ml-0 z-depth-0">
                            Détails
                        </a>
                        <a href="#!" data-toggle="modal" data-target="#basicExampleModal" class="btn btn-green btn-sm ml-0 z-depth-0 contacter-modal" data-value="{{ $produit->nom }}">
                            Contacter
                        </a>
                    </div>
                </div>
            </div>
            <br />
        </div>
    @endforeach
@else
    <div class="text-center col-12">
        <br /><br /><br />
        <p class="text-center">Aucun produit ne correspond à votre recherhe</p>
        <br /><br /><br /><br /><br /><br />
    </div>
@endif
