<?php
require_once 'source/class/Session.php';
$session = new Session();
if (!$session->validade()) {
    header("Location: ./");
    exit();
}

$page = "Menu";
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $page ?> - Duty Saude</title>

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
        <script src="source/js/logout.js"></script>
        <script src="source/js/loading.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <style>
            html, body {
                height: 100%;
                margin: 0;
            }
            body {
                background-image: url('source/img/banner.jpg');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                display: flex;
                flex-direction: column;
            }
            .content {
                flex: 1;
            }
            .card-text {
                font-size: 0.9em;
            }
            .icon-group {
                position: relative;
                display: inline-block;
            }
            
            .icon-group .fa-briefcase {
                margin-right: 8px;
            }

            .icon-group .fa-plus {
                position: absolute;
                top: 10px;
                right: -15px; /* Ajuste a posição horizontal conforme necessário */
                font-size: 20px;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <h1 class="visually-hidden"><?php echo $page ?> - Duty Saude</h1>

        <nav class="navbar bg-custom">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">
                    <img src="source/img/logo-white.png" class="d-inline-block align-text-top me-1" alt="DutySaude" height="30">
                    DutySaude.com.br
                </a>
                <form class="d-flex" role="search">
                    <button class="btn btn-outline-light btn-sm" type="button" onclick="logout('');"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
                </form>
            </div>
        </nav>

        <div class="content w-100 p-3 principal">
            <div class="row">
                <div class="col-lg col-md-4 col-sm-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title mb-1 text-muted">
                                <div class="icon-group">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <i class="fa-solid fa-plus smaller-icon text-success"></i>
                                </div>
                            </h2>
                            <h6 class="card-title mb-3">Nova Empresa</h6>
                            <a onclick="OpenLink('newempresa');" class="btn btn-primary btn-sm btnduty">Cadastrar</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-md-4 col-sm-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title mb-1 text-muted"><i class="fa-solid fa-briefcase"></i></h2>
                            <h6 class="card-title mb-3">Empresas</h6>
                            <a onclick="OpenLink('empresas');" class="btn btn-primary btn-sm btnduty">Visualizar</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-md-4 col-sm-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title mb-1 text-muted">
                                <div class="icon-group">
                                    <i class="fa-solid fa-user-group"></i>
                                    <i class="fa-solid fa-plus smaller-icon text-success"></i>
                                </div>
                            </h2>
                            <h6 class="card-title mb-3">Novo Cliente</h6>
                            <a onclick="OpenLink('newcliente');" class="btn btn-primary btn-sm btnduty">Cadastrar</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-md-4 col-sm-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title mb-1 text-muted"><i class="fa-solid fa-user-group"></i></h2>
                            <h6 class="card-title mb-3">Clientes</h6>
                            <a onclick="OpenLink('clientes');" class="btn btn-primary btn-sm btnduty">Visualizar</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-md-4 col-sm-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title mb-1 text-muted">
                                <div class="icon-group">
                                    <i class="fa-solid fa-hospital"></i>
                                    <i class="fa-solid fa-plus smaller-icon text-success"></i>
                                </div>
                            </h2>
                            <h6 class="card-title mb-3">Novo Plano</h6>
                            <a onclick="OpenLink('newplano');" class="btn btn-primary btn-sm btnduty">Cadastrar</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-md-4 col-sm-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title mb-1 text-muted"><i class="fa-solid fa-hospital"></i></h2>
                            <h6 class="card-title mb-3">Planos(s)</h6>
                            <a onclick="OpenLink('planos');" class="btn btn-primary btn-sm btnduty">Visualizar</a>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="text-white mt-1 mb-3">

            <div class="row">
                <div class="col-lg col-md-4 col-sm-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title mb-1 text-muted"><i class="fa-solid fa-building-user"></i></h2>
                            <h6 class="card-title mb-3">Parceiro(s)</h6>
                            <a href="#" class="btn btn-primary btn-sm btnduty">Acessar</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-md-4 col-sm-12 mb-3">

                </div>
                <div class="col-lg col-md-4 col-sm-12 mb-3">

                </div>
                <div class="col-lg col-md-4 col-sm-12 mb-3">

                </div>
                <div class="col-lg col-md-4 col-sm-12 mb-3">

                </div>
                <div class="col-lg col-md-4 col-sm-12 mb-3">

                </div>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
