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
                               <li class="breadcrumb-item active" aria-current="page">Pages</li>
                           </ol>
                       </nav>
                   </div>
               </div>
           </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                
                @if ($message = Session::get('success'))
                    <div class="col-12">
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    </div>
                @endif

                @forelse ($pages as $page)

                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <a href="{{ route('detailsPage', $page->id) }}">
                            <div class="card card-content p-3 page-container">
                                <h1 class="text-center">
                                    <i class="icofont-{{ $page->icone }} icofont-2x text-success"></i>
                                </h1>
                                <div class="text-center text-secondary">
                                    <h6>{{ $page->titre }}</h6>
                                </div>
                                <div class="text-secondary">
                                    <?=(strlen($page->contenu) > 130) ? substr($page->contenu, 0, 130) . "..." : $page->contenu ?>
                                    <span class="text-success">Lire plus</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                @empty
                    <div class="col-12 text-center"><br /><br /><br />
                        <strong>Aucune page n'a été ajoutée</strong>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    
@endsection

@section('scriptJs')
    
@endsection