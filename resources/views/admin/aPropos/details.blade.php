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
                               <li class="breadcrumb-item active" aria-current="page">A propos</li>
                           </ol>
                       </nav>
                   </div>
               </div>
           </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                
                <div class="col-lg-10 col-md-12 col-sm-12"><br />

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
                    
                    <form action="{{ route('ajouterAProposFrom') }}" method="post">
                        @csrf

                        @forelse ($a_propos as $a_prop)
                            <textarea required name="contenu" id="editor1" rows="10" class="form-control"><?=$a_prop->contenu ?></textarea><br />
                            <input type="hidden" name="id" value="{{ $a_prop->id }}">
                        @empty
                            <textarea required name="contenu" id="editor1" rows="10" class="form-control">Saisir ici ...</textarea><br />
                        @endforelse

                        <button type="submit" class="btn btn-success">
                            Publier
                        </button>

                    </form>

                </div>

            </div>
        </div>

        <footer class="footer text-center">
           Togosimé 2019 | By <a href="https://ibtagroup.com">IBTAGroup</a>.
       </footer>

    </div>

    
@endsection

@section('scriptJs')
    <script src="{{ URL::asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function() {

            CKEDITOR.replace('editor1');
        })
    </script>
@endsection