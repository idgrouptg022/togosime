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
                               <li class="breadcrumb-item active" aria-current="page">Liste des services</li>
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
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="zero_config">
                                    <thead>
                                        <tr>
                                            <th><b>Titre du service</b></th>
                                            <th><b>sous-titre du service</b></th>
                                            <th class="text-center"><b>Action</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($services as $service)
                                            <tr>
                                                <td>{{ $service->titre }}</td>
                                                <td>{!!  \Illuminate\Support\Str::substr($service->contenu, 0, 43)."...."  !!}</td>
                                                <td width="100" class="text-center">
                                                    <form action="{{ route('deleteService', $service->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ $service->pathShow() }}" class="btn btn-outline-success">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous vraiment supprimer le service {{ $service->titre }} ?')"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">
                                                    <div class="text-center">
                                                        <b>Aucun service !</b>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><b>Titre du service</b></th>
                                            <th><b>sous-titre du service</b></th>
                                            <th class="text-center"><b>Action</b></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer text-center">
           Togosimé 2019 | By <a href="https://ibtagroup.com">IBTAGroup</a>.
       </footer>

    </div>


@endsection

@section('scriptJs')

    <script>
        $('#zero_config').DataTable();
    </script>

@endsection
