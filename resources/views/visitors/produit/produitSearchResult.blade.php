@extends('visitors.base')

@section('scriptCSS')
    <style>
        body {
            background-color: #f5f3ee;
        }
    </style>
@endsection

@section('content')
<br>
<div class="container">
    <div class="row">
        @include('visitors.included.for', ['produits'=>$produits])
    </div>
</div>
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
