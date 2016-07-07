<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Auditoria Cardeal</title>
        @include('layout.style')
    </head>

    <body>
        <header>
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                                aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/">Cardeal Auditoria</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#"><b>
                                        <?php
                                        $user = \Auth::user();
                                        echo $user['name'];
                                        ?>
                                    </b></a></li>
                            <li><a href="/logout/">Sair</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3 col-md-2 sidebar">
                        <ul class="nav nav-sidebar">
                            <li><a href="/cliente/lista-geral/">Clientes</a></li>
                            <li><a href="/supervisor/lista-geral/">Supervisores</a></li>
                            <li><a href="/vendedor/lista-geral/">Vendedor</a></li>
                            <li><a href="/formulario/lista-geral/">Formulário</a></li>
                            <li><a href="/visita/lista-geral/">Visitas</a></li>
                            <li><a href="/usuario/lista-geral/">Usuarios</a></li>
                            <li><hr></li>
                            <li><a href="/feedback/lista-geral">Feedback</li>
                        </ul>
                    </div>
                    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>