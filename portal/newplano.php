<?php
require_once 'source/class/Session.php';
$session = new Session();
if (!$session->validade()) {
    header("Location: ../");
    exit();
}

$page = "Novo Plano";
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

        <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>   
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

        <link rel="stylesheet" href="source/css/default.css">
        <script src="source/js/windowmsg.js"></script>
        <script src="source/js/windowalert.js"></script>
        <script src="source/js/logout.js"></script>
        <script src="source/js/loading.js"></script>
        <script src="source/js/planos.js"></script>

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
        </style>
    </head>
    <body>
        <h1 class="visually-hidden"><?php echo $page ?> - Duty Saude</h1>

        <nav class="navbar bg-custom">
            <div class="container-fluid">
                <a class="navbar-brand text-white" onclick="OpenLink('painel');">
                    <img src="source/img/logo-white.png" class="d-inline-block align-text-top me-1" alt="DutySaude" height="30">
                    DutySaude.com.br
                </a>
                <form class="d-flex" role="search">
                    <button class="btn btn-outline-light btn-sm me-3" type="button" onclick="OpenLink('painel');"><i class="fa-solid fa-bars"></i></button>
                    <button class="btn btn-outline-light btn-sm" type="button" onclick="logout('');"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
                </form>
            </div>
        </nav>

        <div class="content w-100 p-3 principal">
            <div class="card">
                <div class="card-body">
                    <h2 class="h5 mb-1 text-muted"><i class="fa-solid fa-briefcase me-1"></i><?php echo $page ?></h2>
                    <hr>
                    <div id="define-person" style="display: none;">
                        <p class="m-0 mb-1"><b>Me diga o tipo do titular do plano, é CPF ou CNPJ?</b></p>
                        <div class="row">
                            <div class="form-group col-lg-2 mb-2">
                                <label class="form-label">Tipo</label>
                                <select id="inputTypePerson" class="form-control form-control-sm" required>
                                    <option value="1">CPF</option>
                                    <option value="0">CNPJ</option>
                                </select>
                            </div>
                        </div>
                        <button type="button" onclick="DefinirTipo();" class="btn btn-primary btn-sm btnduty mt-2"><i class="fa-solid fa-arrow-right me-2"></i>Avançar</button>
                    </div>

                    <div id="define-type-plan" style="display: none;">
                        <div class="row">
                            <p class="m-0 mb-1"><b>Muito bem, agora por favor me informe qual o plano com base na quantidade de vidas</b></p>
                            <div class="form-group col-lg-3 mb-2">
                                <label class="form-label">Plano</label>
                                <select id="inputTypePlan" class="form-control form-control-sm" required>
                                </select>
                            </div>
                        </div>
                        <button type="button" onclick="BackTipo();" class="btn btn-secondary btn-sm mt-2"><i class="fa-solid fa-rotate-left me-2"></i>Voltar</button>
                        <button type="button" onclick="DefinirPlan();" class="btn btn-primary btn-sm btnduty mt-2"><i class="fa-solid fa-arrow-right me-2"></i>Avançar</button>
                    </div>

                    <div id="getchave" style="display: none;">
                        <p class="m-0 mb-1"><b id="text-chave"></b></p>
                        <div class="form-group col-lg-2 mb-2">
                            <label id="label-chave" class="form-label"></label>
                            <input id="inputChave" type="number" class="form-control form-control-sm" required>
                        </div>
                        <button type="button" onclick="BackSelectPlan();" class="btn btn-secondary btn-sm mt-2"><i class="fa-solid fa-rotate-left me-2"></i>Voltar</button>
                        <button type="button" onclick="ProcurarChave();" class="btn btn-primary btn-sm btnduty mt-2"><i class="fa-solid fa-arrow-right me-2"></i>Avançar</button>
                    </div>

                    <div id="loading" style="display: none;">
                        <p class="m-0 mb-1"><b>Aguarde um momento enquanto...</b></p>
                        <div class="form-group col-lg-2 mb-2 text-center justify-content-center">
                            <div class="spinner-border mt-2 mb-2" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm mt-2" disabled="true"><i class="fa-solid fa-rotate-left me-2"></i>Voltar</button>
                        <button type="button" class="btn btn-primary btn-sm btnduty mt-2" disabled="true"><i class="fa-solid fa-arrow-right me-2"></i>Avançar</button>
                    </div>

                    <div id="dataview" style="display: none;">
                        <p class="m-0 mb-1"><b>Confirme os dados</b></p>
                        <div class="form-group col-lg-4 mb-2">
                            <p id="textviewcustom"></p>
                        </div>
                        <button type="button" onclick="" class="btn btn-secondary btn-sm mt-2" ><i class="fa-solid fa-rotate-left me-2"></i>Voltar</button>
                        <button type="button" onclick="ConfirmDados();" class="btn btn-primary btn-sm btnduty mt-2" ><i class="fa-solid fa-arrow-right me-2"></i>Avançar</button>
                    </div>

                    <div id="view-form" style="display: none;">
                        <div class="row">
                            <div class="form-group col-lg-2 mb-2">
                                <label class="form-label" id="label-view-cod">{CPF/CNPJ}</label>
                                <input id="inputCod" type="text" class="form-control form-control-sm" disabled="true">
                            </div>
                            <div class="form-group col-lg-4 mb-2">
                                <label class="form-label" id="label-view-text">{Nome/Razão Social}</label>
                                <input id="inputResp" type="text" class="form-control form-control-sm" disabled="true">
                            </div>
                            <div class="form-group col-lg-3 mb-2">
                                <label class="form-label">Plano</label>
                                <input id="textPlan" type="text" class="form-control form-control-sm" disabled="true">
                            </div>
                        </div>
                        <hr>
                        <h2 class="h6 mb-1 text-muted" id="label-titular"></h2>
                        <hr>
                        <!--<h2 class="h6 mb-1 text-muted"><i class="fa-regular fa-file me-1"></i>Anexo(s)</h2>-->
                        <h2 class="h6 mb-1 text-muted"><i class="fa-solid fa-paperclip me-1"></i>Anexo(s)</h2>
                    </div>
                </div>
            </div>
            
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
