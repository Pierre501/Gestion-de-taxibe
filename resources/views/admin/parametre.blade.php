@extends('admin.app')

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Paramètre</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Nom du paramètre</th>
                                        <th>Pourcentage salaire</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listeParametre as $parametre)
                                        <tr>
                                            <td>{{ $parametre->getParametre() }}</td>
                                            <td>{{ $parametre->getPourcentage() }} %</td>
                                            <td><a href="{{ route('admin.modifParametre', ['id' => $parametre->getIdParametre()]) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Modifier</a></td>
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