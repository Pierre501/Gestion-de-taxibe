@extends('chauffeur.app')

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Liste des salaires journaliés</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Matricule</th>
                                        <th>Kilomètre effectué</th>
                                        <th>Montant recètte</th>
                                        <th>Montant carburant</th>
                                        <th>Salaire journalié</th>
                                        <th>Date du salaire</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listeSalaire as $salaire)
                                        <tr>
                                            <td>{{ $salaire->getMatricule() }}</td>
                                            <td>{{ $salaire->formatMillier($salaire->getKilometreEffectue()) }} Km</td>
                                            <td>{{ $salaire->formatMillier($salaire->getMontantRecette()) }} Ar</td>
                                            <td>{{ $salaire->formatMillier($salaire->getMontantCarburant()) }} Ar</td>
                                            <td>{{ $salaire->formatMillier($salaire->getSalaire()) }} Ar</td>
                                            <td>{{ $salaire->getDateSalaire() }}</td>
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
    <!-- /.container-fluid -->
</div>

@endsection