@extends('chauffeur.app')

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Gestion des trajets</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-lg-4">
                            @isset($erreur)
                                <span class="errors align-center">{{ $erreur }}</span> 
                            @endisset
                            <form action="{{ route('details-trajets') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="kilometre_effectue"> kilomètre effectué</label>
                                    <input class="form-control" id="kilometre_effectue" name="kilometre_effectue" type="number" required>
                                </div>
                                <div class="form-group">
                                    <label for="recette"> Montant Recette</label>
                                    <input class="form-control" id="recette" name="recette" type="number" required>
                                </div>
                                <div class="form-group">
                                    <label for="carburant"> Montant carburant</label>
                                    <input class="form-control" id="carburant" name="carburant" type="number" required>
                                </div>
                                <button type="submit" class="btn btn-lg btn-primary btn-block"><i class="fa fa-check"></i> Valider</button>
                            </form>
                        </div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-6"></div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <!-- /.container-fluid -->
</div>

@endsection