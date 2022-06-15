@extends('visitors.base')

@section('content')
<br><br />
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-sm-12">
            <h3><b>Nos services</b></h3>
            <h5>
                Parcourez nos services de livraisons, d'hébergement en plus quelques
                hôtels et restaurants avec lesquels nous travaillons.
            </h5><br /><br />
        </div>
    </div>
    <div class="row">
        @forelse($services as $service)
            <div class="col-lg-6 col-md-12 col-sm-12">
                <img src="{{ URL::asset('storage/app/public/'.$service->image) }}" alt="" width="100%"><br />

                <h3 class="mt-3">{{ $service->titre }}</h3>

                <p>
                    {!! $service->contenu !!}
                </p>

                <br /><br />
            </div>
        @empty
            <div class="col-12">
                <h1 class="text-center">Aucun service disponible</h1>
            </div>
        @endforelse
    </div>
</div><br /><br /><br /><br />

@endsection
