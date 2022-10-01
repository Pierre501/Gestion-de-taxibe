@extends('admin.app')

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Gestion des véhicules</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Matricule</th>
                                            <th>Marque</th>
                                            <th>Modèle</th>
                                            <th>Etat</th>
                                            <th>Nombre des places</th>
                                            <th>Versement minimum</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listeVehicule as $vehicule)
                                            <tr>
                                                <td>{{ $vehicule->getMatricule() }}</td>
                                                <td>{{ $vehicule->getMarque() }}</td>
                                                <td>{{ $vehicule->getModel() }}</td>
                                                <td>{{ $vehicule->setEtatString($vehicule->getEtat()) }}</td>
                                                <td>{{ $vehicule->getNombreDePlace() }}</td>
                                                <td>{{ $vehicule->formatMillier($vehicule->getMontantVersement()) }} Ar</td>
                                                <td><a href="#" class="btn btn-primary"><i class="fa fa-edit"></i> Modifier</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="col-2">
                    <a href="{{ route('admin.ajoutVehicule') }}" class="btn btn-success"><i class="fa fa-plus-square"></i> Ajouter</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection