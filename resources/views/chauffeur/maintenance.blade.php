@extends('chauffeur.app')

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Gestion des maintenances</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-lg-4">
                            <form action="{{ route('panne') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="matricule"> Matricule véhicule</label>
                                    <input class="form-control" id="matricule" name="matricule" type="text" value="{{ $vehicule->getMatricule() }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="date"> Date</label>
                                    <input class="form-control" id="date" name="date" type="date" value="{{ $dateEncours }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="heure"> Heure</label>
                                    <input class="form-control" id="heure" name="heure" type="time" value="{{ $heureEncours }}" required>
                                </div>
                                <button type="submit" class="btn btn-lg btn-danger btn-block"><i class="fa fa-warning"></i> Panne</button>
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