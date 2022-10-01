<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Login chauffeur</title>

        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">

        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="{{ asset('css/metisMenu.min.css') }}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{ asset('css/startmin.css') }}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title align-center">Se connecter</h3>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('login') }}" method="post" role="form">
                                @csrf
                                <fieldset>
                                    @if ($errors->any())
                                        <p class="errors align-center">Email ou mot de passe invalide</p>
                                    @endif
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control" id="email" name="email" type="email" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mot de passe</label>
                                        <input class="form-control" id="password" name="password" type="password" required autocomplete="current-password">
                                    </div>
                                    <div class="checkbox">
                                        <label for="remember_me">
                                            <input id="remember_me" name="remember" type="checkbox">Souviens moi
                                        </label>
                                        <div class="passwords">
                                            <label><a href="{{ route('password.request') }}">Mot de passe oublié ?</a></label>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-lg btn-success btn-block">Connexion</button>
                                    </div>
                                    <div class="top">
                                        <a href="{{ route('register') }}" class="btn btn-lg btn-primary btn-block">Créer un compte</a>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="{{ asset('js/metisMenu.min.js') }}"></script>

        <!-- Custom Theme JavaScript -->
        <script src="{{ asset('js/startmin.js') }}"></script>

    </body>
</html>
