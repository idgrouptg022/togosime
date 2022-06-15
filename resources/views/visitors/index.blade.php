@extends('visitors.base')

@section('scriptCSS')

    <style>
        .square-container {
            border: 3px solid #079E2B;
            padding: 0 15px;
        }
        .square-container .titre{
            background-color: #079E2B;
        }
        .carouselImage {
            background-size: cover;

            background-repeat: no-repeat;
            width: 100%;
            height: 50vh;
            position: relative
        }

        body {
            background-color: #f5f3ee;
        }

    </style>

@endsection

@section('content')


    <div class="container-fluid pl-4">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($carousels as $carousel)
                            @if ($loop->first)
                                <div class="carousel-item active">
                                    <div class="carouselImage" style="background-image: url('{{ URL::asset($carousel->image) }}')"></div>
                                    {{-- <img class="d-block w-100" src="{{ URL::asset($carousel->image) }}" alt=""> --}}
                                    <h6 style="margin-top: -90px; background-color: rgba(0, 0, 0, 0.6); position: relative;"
                                    class="text-center pt-3 pb-3">
                                        <span class="font-weight-bold red-text pr-2 pt-1 pb-1" style="border-right: 5px solid green;">
                                        {{ $carousel->prix }} F CFA
                                        </span>
                                        <span class="pl-3"><a href="{{ route('produit_detail', ['id' => $carousel->id]) }}" class="white-text"><b>{{ $carousel->nom }}</b></a></span>
                                        <div class="mt-2"></div>
                                        <a href="#" class="btn btn-orange btn-sm m-0 contacter-modal" data-toggle="modal" data-target="#basicExampleModal"  data-value="{{ $carousel->nom }}">
                                            Contacter
                                        </a>
                                    </h6>
                                </div>
                            @else
                                <div class="carousel-item">
                                    <div class="carouselImage" style="background-image: url('{{ URL::asset($carousel->image) }}')"></div>
                                    <h6 style="margin-top: -90px; background-color: rgba(0, 0, 0, 0.6); position: relative;"
                                    class="text-center pt-3 pb-3">
                                        <span class="font-weight-bold red-text pr-2 pt-1 pb-1" style="border-right: 5px solid green;">
                                        {{ $carousel->prix }} F CFA
                                        </span>
                                        <span class="pl-3"><a href="{{ route('produit_detail', ['id' => $carousel->id]) }}" class="white-text"><b>{{ $carousel->nom }}</b></a></span>
                                        <div class="mt-2"></div>
                                        <a href="#" class="btn btn-orange btn-sm m-0 contacter-modal" data-toggle="modal" data-target="#basicExampleModal"  data-value="{{ $carousel->nom }}">
                                            Contacter
                                        </a>
                                    </h6>
                                </div>
                            @endif

                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="square-container">
                    <div class="titre text-center white-text pt-2 pb-2 mb-1">
                        <i class="icofont-film"></i>
                        <b>SPOTS VIDEOS</b>
                    </div>
                    <div>
                        <iframe width="100%" height="255" src="https://www.youtube.com/embed/nZFQPjWpXkE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                        Cliquez sur <a target="_blank" href="https://www.youtube.com/channel/UCgR9RjhUoF8EBvg4f8oqmrw">Ce lien</a> pour
                        accéder à toute notre chaîne de vidéos.<hr />

                        <i class="icofont-youtube red-text"></i>
                        <a target="_blank" href="https://www.youtube.com/channel/UCgR9RjhUoF8EBvg4f8oqmrw">
                            <b>Chaîne youtube</b>
                        </a>
                        <div class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div><br /><br />
        <div class="row border-bottom">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="row">
                    @include('visitors.included.for', ["produits" => $produits])
                </div>
                <div class="row">
                    <div class="col-12">
                        {{ $produits->links() }}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                <div class="square-container annonce-position">
                    <div class="titre text-center white-text pt-2 pb-2 mb-1">
                        <i class="icofont-alarm"></i>
                        <b>COMMUNIQUES ET ANNONCES</b>
                    </div>
                    <div id="carouselExampleControls00" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($annonces as $annonce)
                                @if ($loop->first)
                                    <div class="carousel-item active mb-1">

                                        <img class="d-block w-100" src="{{ URL::asset($annonce->image) }}" alt="">
                                        <div class="grey lighten-3 text-center pr-2 pl-2 pt-2 pb-2">
                                            <b>{{ $annonce->titre }}</b>
                                        </div>
                                        <div class="mt-3" style="text-align: justify; height: 100px;">
                                            {{ substr($annonce->description, 0, 200) }} ...
                                        </div>
                                        <a href="{{ route('vDetailsAnnonce', $annonce->id) }}" class="green-text">Lire plus</a>
                                    </div>
                                @else
                                    <div class="carousel-item mb-1">
                                        <img class="d-block w-100" src="{{ URL::asset($annonce->image) }}" alt="">
                                        <div class="grey lighten-3 text-center pr-2 pl-2 pt-2 pb-2">
                                            <b>{{ $annonce->titre }}</b>
                                        </div>
                                        <div class="mt-3" style="text-align: justify; height: 100px;">
                                            {{ substr($annonce->description, 0, 200) }} ...
                                        </div>
                                        <a href="{{ route('vDetailsAnnonce', $annonce->id) }}" class="green-text">Lire plus</a>
                                    </div>
                                @endif

                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div><br /><br />
        <div class="row">

            @forelse ($pages as $page)

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <a href="{{ route('vDetailsPage', $page->id) }}">
                        <div class="card card-content p-3" style="font-size: 14px; height: 230px; overflow: hidden;">
                            <h1 class="text-center">
                                <i class="icofont-{{ $page->icone }} icofont-2x text-success"></i>
                            </h1>
                            <div class="text-center black-text">
                                <h6><span class="font-weight-bold green-text">{{ $page->titre }}</span></h6>
                            </div>
                            <div class="black-text">
                                <?=(strlen($page->contenu) > 130) ? substr($page->contenu, 0, 130) . "..." : $page->contenu ?>
                                <span class="text-success">Lire plus</span>
                            </div>
                        </div>
                    </a><br />
                </div>

            @empty
                <div class="col-12 text-center"><br /><br /><br />
                    <strong>Aucune page n'a été ajoutée</strong>
                </div>
            @endforelse

        </div><br />

        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Notre équipe</h2><br />
            </div>
        </div>
        <div class="row">
            @foreach($members as $member)
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body" style="height: 240px; overflow: auto;">
                            <div class="row">
                                <div class="col-lg-3 col-sm-12 text-center col-md-5">
                                    <img src="{{ URL::asset('storage/app/public/'.$member->photo) }}" width="100" class="rounded-circle" alt="">
                                </div>
                                <div class="col-lg-9 col-sm-8 col-md-7">
                                    <h6>{{ $member->nom }}</h6>
                                    <p class="card-text">{{ $member->poste }}</p>
                                    <p>Téléphone : {{ $member->numero_telephone }}</p>

                                    <div class="m-0" class="pl-2">
                                        {!! $member->details !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br />
                </div>
            @endforeach
        </div>
    </div><br /><br /><br />

    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="photos-box">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($images as $image)
                                @if ($loop->first)
                                    <div class="carousel-item active">
                                        <img class="img-fluid" src="{{ URL::asset($image->fichier) }}" alt="">
                                    </div>
                                @else
                                    <div class="carousel-item">
                                        <img class="img-fluid" src="{{ URL::asset($image->fichier) }}" alt="">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
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
