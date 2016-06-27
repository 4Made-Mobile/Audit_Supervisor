<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Cardeal Login</title>

        <!-- Bootstrap core CSS -->
        @include('layout.style')
        <style>
            body {
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #eee;
            }

            .form-signin {
                max-width: 330px;
                padding: 15px;
                margin: 0 auto;
            }
            .form-signin .form-signin-heading,
            .form-signin .checkbox {
                margin-bottom: 10px;
            }
            .form-signin .checkbox {
                font-weight: normal;
            }
            .form-signin .form-control {
                position: relative;
                height: auto;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                padding: 10px;
                font-size: 16px;
            }
            .form-signin .form-control:focus {
                z-index: 2;
            }
            .form-signin input[type="email"] {
                margin-bottom: -1px;
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
            }
            .form-signin input[type="password"] {
                margin-bottom: 10px;
                border-top-left-radius: 0;
                border-top-right-radius: 0;
            }
        </style>
    </head>

    <body>

        <div class="container">

            <form class="form-signin" action="/login" method="POST">
                <h2 class="form-signin-heading">Login</h2>
                {!! csrf_field() !!}
                <label for="login" class="sr-only">Usuário</label>
                <input type="text" id="login" name="login" class="form-control" placeholder="Digite seu usuario" required autofocus>
                <label for="password" class="sr-only">Senha</label>
                <input type="password" id="password" name="password" placeholder="*****" class="form-control" required>

                <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
            </form>

        </div>
    </body>
    @include('layout.scripts')
</html>