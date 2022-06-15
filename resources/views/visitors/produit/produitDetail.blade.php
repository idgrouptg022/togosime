@extends('visitors.base')

@section('scriptCSS')
    <link rel="stylesheet" href="{{ asset('styles/visitors/productDetail.css') }}">
@endsection

@section('content')
<br><br />
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-sm-12 product">
            <div class="product-box">
                <div class="product-imgBx">
                    <img src="{{ URL::asset($produit->image) }}" alt="img-produit">
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="product-name">{{ $produit->nom }}</div>
            <h6 class="red-text product-price">{{ $produit->prix }} FCFA</h6>
            <br /><br />
            <p>{{ $produit->description }}</p>
            <div>
                <a href="#!" data-toggle="modal" data-target="#basicExampleModal" class="btn btn-orange btn-sm ml-0 z-depth-0 contacter-modal" data-value="{{ $produit->nom }}">
                    Contacter
                </a>
            </div>
        </div>
        <br />
        <br />
    </div>
</div><br /><br />
@include('visitors.included.modal')
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.contacter-modal').each(function() {
                $(this).click(function() {
                    $('a#whatsAppLink').attr("href", "https://wa.me/22891732811?text=Bonjour, j'ai vu le produit " + $(this).attr('data-value') + " sur la plate-forme togosime et je suis intéressé !");
                });
                /* misterix */
            });
        });
    </script>
@endsection
