@extends('admin.app')

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Modification paramètre</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-lg-4">
                            <form action="{{ route('admin.modification') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label> {{ $parametre->getParametre() }}</label>
                                    <input type="hidden" name="id" value="{{ $parametre->getIdParametre() }}" >
                                    <input class="form-control" name="pourcentage" type="number" value="{{ $parametre->getPourcentage() }}" required>
                                </div>
                                <button type="submit" class="btn btn-lg btn-primary btn-block"><i class="fa fa-edit"></i> Modifier</button>
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