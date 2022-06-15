@extends('visitors.base')

@section('content')
    <br />
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-12 col-sm-12 ">
                @forelse ($pages as $page)
                <h3>{{ $page->titre }}</h3><br />
                <div>
                    {!! $page->contenu !!}
                </div>
                @empty
                    <div class="text-center">
                        <b>Aucune page !</b>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <br /><br /><br /><br /><br /><br />

@endsection