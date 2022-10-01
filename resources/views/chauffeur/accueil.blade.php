@extends('chauffeur.app')

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Liste des véhicules disponibles</h1>
                @isset($erreur)
                   <span class="errors align-center">{{ $erreur }}</span> 
                @endisset
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <br>
        <!-- /.row -->
        <div class="row">
            @foreach ($tabVehicule as $vehicule)
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bus fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div><span class="bus"> {{ $vehicule->getMatricule(); }}</span></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <form action="{{ route('ajout') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="vehicules_id" value="{{ $vehicule->getIdVehicule(); }}">
                                    <button type="submit" class="btn btn-lg btn-primary btn-block"><i class="fa fa-plus-square"></i> Ajouter</button>
                                </form>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>        
                </div>
            @endforeach
        </div>
    </div>
    <!-- /.container-fluid -->
</div>

@endsection