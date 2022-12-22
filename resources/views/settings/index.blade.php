@extends('layouts.master')



@section('content')
<?php 
use App\Setting;
?>
<div class="container">

    <div class="row">

        <div class="col-lg-12 table1">
            <div class="card mt-2 ">
                <div class="card-header">
                    <h3 class="font-weight-light my-4"> Paramètre de application</h3>
                </div>
                <div class="card-body">
                    <form role="form" action="{{route('setting.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>
                                        Communication Port Com:
                                    </label>
                                    @if($connexion == 1)
                                    <span class="badge badge-success">
                                        Connecté
                                    </span>
                                    @else
                                    <span class="badge badge-danger">
                                        Non Connecté
                                    </span>

                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>
                                        Langue :
                                    </label>
                                    <a class="badge badge-success" href="/lang/en">
                                        Anglais
                                    </a>
                                    <a class="badge badge-success" href="/lang/ar">
                                        Arabe
                                    </a>
                                </div>
                                <div class="form-group">
                                    <label>Titre Général:</label>
                                    <input type="text" required value="{{Setting::getSetting('titre')}}" name="titre"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Titre Général:</label>
                                    <input type="text" value="{{Setting::getSetting('telephone')}}" name="telephone"
                                        class="form-control">
                                </div>




                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <img src="{{Setting::getSetting('logo')}}" with="20px" />

                                </div>

                                <div class="form-group">
                                    <label>
                                        Logo :
                                    </label>
                                    <input type="file" name="logo" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <a href="{{route('clear.records')}}" class="btn  bubbly-button">
                                        Vider La Liste des Entrés
                                    </a>
                                </div>

                                <div class="form-group">
                                    <a href="{{route('backup')}}" class="btn  bubbly-button">
                                        Sauvgarder Les Données
                                    </a>
                                </div>



                            </div>


                        </div>



                        <div clas="row">
                            <div class="col-sm-4">
                                <button type="submit" class="btn  bubbly-button">
                                    Valider
                                </button>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
