<?php
require_once 'source/class/Session.php';
$session = new Session();
if ($session->validade()) {
    header("Location: painel");
    exit();
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login - Duty Saude</title>

        <link rel="apple-touch-icon" sizes="57x57" href="source/img/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="source/img/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="source/img/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="source/img/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="source/img/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="source/img/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="source/img/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="source/img/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="source/img/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="source/img/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="source/img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="source/img/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="source/img/favicon/favicon-16x16.png">
        <link rel="manifest" href="manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="source/img/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#EA7127">

        <script src='https://code.jquery.com/jquery-3.7.1.min.js'></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="source/css/default.css">
        <script src="source/js/windowmsg.js"></script>
        <script src="source/js/windowalert.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <style>
            .box {
                display: flex;
                height: 100vh;
            }
            .backimg {
                flex: 1;
                background-image: url('source/img/banner.jpg');
                background-size: cover;
                background-position: center;
            }
            .login {
                width: 100%;
                max-width: 400px;
                background-color: #212529;
                padding: 50px;
                display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            }
            .blocklogin {
                width: 100%;
                border-radius: 5px;
                text-align: center;
                z-index: 0;
            }
            .blocklogin img {
                width: 100px;
                margin-left: calc(50% - 80px);
                margin-right: calc(50% - 80px);
                margin-bottom: 30px;
            }
            #linkforget {
                color: #007bff;
                text-decoration: none;
                background-color: transparent;
            }
        </style>
    </head>
    <body>
        <h1 class="visually-hidden">Login - Duty Saude</h1>

        <div class="box">
            <div class="backimg"></div>
            <div class="login">
                <form class="blocklogin">
                    <img src="source/img/logo.png">
                    <div class="form-group mb-3">
                        <input type="email" style="text-align: center;" class="form-control" id="InputEmail" aria-describedby="emailHelp" placeholder="seu@email.com">
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" style="text-align: center;" class="form-control" id="InputPassword" placeholder="senha">
                    </div>
                    <div class="form-group mb-3">
                        <a class="disab mb-3 text-white" id="linkforget" href="esquecisenha">Esqueci minha senha</a>
                    </div>
                    <button id="btncriar" type="button" style="width: calc(50% - 8px);margin-right: 5px;" class="btn btn-secondary" disabled="true">Solicitar Conta</button>
                    <button id="btnentrar" type="button" style="width: calc(50% - 7px);margin-left: 5px;" class="btn btn-danger btnduty">Entrar</button>
                    <p style="margin: 0px;margin-top: 13px;margin-bottom: -10px;cursor: default;"><small class="text-white opacity-50">2024 © DutySaude</small></p>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $('#btnentrar').on('click', function () {
                    var email = $('#InputEmail').val();
                    var pass = $('#InputPassword').val();

                    StartLoad();

                    $.ajax({
                        url: 'source/form/login/validade.php',
                        type: 'POST',
                        contentType: 'application/json',
                        dataType: 'json',
                        data: JSON.stringify({
                            email: email,
                            pass: pass
                        }),
                        success: function (response) {
                            // Processa a resposta de sucesso
                            document.location.reload(true);
                        },
                        error: function (jqXHR, textStatus, data) {
                            // Processa a resposta de erro
                            console.log(jqXHR);
                            console.log(textStatus);
                            console.log(data);
                            ExibirMsg("E", jqXHR.responseJSON.error);
                            StopLoad();
                        }
                    });
                });
            });

            function StartLoad() {
                $("#InputEmail").prop("disabled", true);
                $("#InputPassword").prop("disabled", true);
                $("#linkforget").removeAttr("href");
                $("#btncriar").prop("disabled", true);
                $("#btnentrar").prop("disabled", true);
                $("body").css("cursor", "wait");
            }

            function StopLoad() {
                $("#InputEmail").prop("disabled", false);
                $("#InputPassword").prop("disabled", false);
                $("#linkforget").attr("href", "esquecisenha");
                $("#btncriar").prop("disabled", false);
                $("#btnentrar").prop("disabled", false);
                $("#btnentrar").html("Entrar");
                $("body").css("cursor", "auto");
            }

        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>