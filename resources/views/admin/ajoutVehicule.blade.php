@extends('admin.app')

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Ajout véhicule</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-lg-4">
                            <form action="{{ route('admin.addVehicule') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label> Matricule</label>
                                    <input class="form-control" name="matricule" type="text"  required>
                                </div>
                                <div class="form-group">
                                    <label> Marque</label>
                                    <input class="form-control" name="marque" type="text"  required>
                                </div>
                                <div class="form-group">
                                    <label> Modèle</label>
                                    <input class="form-control" name="modele" type="text"  required>
                                </div>
                                <div class="form-group">
                                    <label> Nombre des places</label>
                                    <select class="form-control" name="nbrPlace">
                                        <option>Choisir le nombre des places</option>
                                        <option value="22">22</option>
                                        <option value="30">30</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label> Versement minimum</label>
                                    <select class="form-control" name="versement">
                                        <option>Choisir le versement minimum</option>
                                        @foreach ($listeVersement as $versement)
                                            <option value="{{ $versement->getIdVersement() }}">{{ $versement->formatMillier($versement->getMontantVersement()) }} Ar</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-lg btn-primary btn-block"><i class="fa fa-plus-square"></i> Ajouter</button>
                            </form>
                        </div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-6"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection