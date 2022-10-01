@extends('admin.app')

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Liste des véhicules et son chauffeur correspondant</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
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
                                            <th>Chauffeur</th>
                                            <th>Tel</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($tabVehicule as $vehicule)
                                           <tr>
                                                <td>{{ $vehicule->getMatricule() }}</td>
                                                <td>{{ $vehicule->getNom() }}</td>
                                                <td>{{ $vehicule->getTel() }}</td>
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
    </div>
    <!-- /.container-fluid -->
</div>

@endsection