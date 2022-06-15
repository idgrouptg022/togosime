@extends('admin.base')

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
                                <li class="breadcrumb-item active" aria-current="page">Profil</li>
                           </ol>
                       </nav>
                   </div>
               </div>
           </div>
        </div>

        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12">
                    @if ($message = Session::get('success'))    
                        <div class="alert alert-success">
                            {{$message}}
                        </div>
                    @endif
                    @if ($message = Session::get('error'))    
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @endif
                </div>
            </div>
            
            @foreach ($users as $user)
                <form action="{{ route('updateProfil', session()->get('id')) }}" method="post" class="row">
                    @csrf
                    <div class="col-lg-4 col-md-12 col-sm-12"><br /><br />
                        <label for="nom">Nom complet</label>
                        <input type="text" name="nom" id="nom" required value="{{$user->name}}" class="form-control"><br />
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12"><br /><br />
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required value="{{$user->email}}" class="form-control"><br />
                        <button type="submit" class="btn btn-success float-right">
                            Mettre à jour
                        </button>
                    </div>
                    <div class="col-12"><br /><br />
                        <a href="#!" data-toggle="modal" data-target="#profilModal"><i class="fa fa-lock"></i> Modifier mon mot de passe</a>
                    </div>
                </form>
            @endforeach

        </div>
    </div>

    <div class="modal fade" id="profilModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    ria-hidden="true">
                            
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content" style="border-radius: 10px;">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">Produit</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('updatePassword') }}" method="post" class="row">
                        @csrf
                        <div class="col-12">
                            <label for="old_password">Ancien mot de passe</label>
                            <input type="password" minlength="4" maxlength="20" required class="form-control" name="old_password" id="old_password" placeholder="Saisir dans le champs ...">
                        </div>
                        <div class="col-12">
                            <label for="password">Nouveau mot de passe</label>
                            <input type="password" minlength="4" maxlength="20" required class="form-control" name="password" id="password" placeholder="Saisir dans le champs ...">
                        </div>
                        <div class="col-12">
                            <label for="password_confirm">Confirmer mot de passe</label>
                            <input type="password" minlength="4" maxlength="20" required class="form-control" name="password_confirm" id="password_confirm" placeholder="Saisir dans le champs ..."><br />
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success">
                                Mettre à jour
                            </button>
                        </div>
                            
                    </form>
                    
                </div><br />
            </div>
        </div>
        <footer class="footer text-center">
           Togosimé 2019 | By <a href="https://ibtagroup.com">IBTAGroup</a>.
       </footer>
    </div>

@endsection