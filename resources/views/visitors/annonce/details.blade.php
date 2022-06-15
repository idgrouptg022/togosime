@extends('visitors.base')

@section('content')

<br />
<div class="container">
    <div class="row">
        
        @forelse ($annonces as $annonce)
            <div class="col-lg-6 col-md-12 col-sm-12 ">
                <img src="{{ URL::asset($annonce->image) }}" alt="" width="100%">
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 ">
                <div>
                    <h3>{{ $annonce->titre }}</h3>
                    {!! $annonce->description !!}
                </div>
            </div>
        @empty
            <div class="text-center col-12">
                <b>Aucune page !</b>
            </div>
        @endforelse
        
    </div>
</div>
<br /><br /><br /><br /><br /><br />

@endsection