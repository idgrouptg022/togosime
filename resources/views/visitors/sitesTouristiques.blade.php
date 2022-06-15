@extends('visitors.base')

@section('content')
<br><br />
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-sm-12">
            <h3><b>Sites touristiques</b></h3>
            <h5>

            </h5><br /><br />
        </div>
    </div>
    <div class="row">
        @forelse ($sites as $site)
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div style="height: 250px; overflow: hidden;">
                    <img src="{{ URL::asset('storage/app/public/'.$site->image) }}" alt="" width="100%"><br />
                </div>

                <h3 class="mt-3">{{ $site->nom }}</h3>

                <p>{!! $site->description !!}</p>

                <br /><br />
            </div>
        @empty
            <div class="col-12">
                <h1 class="text-center">Aucun site disponible</h1>
            </div>
        @endforelse
    </div>
</div><br /><br /><br /><br />

@endsection
