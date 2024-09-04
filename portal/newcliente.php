<?php
require_once 'source/class/Session.php';
$session = new Session();
if (!$session->validade()) {
    header("Location: ../");
    exit();
}

$page = "Novo Cliente";
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
    <link rel="icon" type="image/png" sizes="192x192" href="source/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="source/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="source/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="source/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="source/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#EA7127">

    <script src='https://code.jquery.com/jquery-3.7.1.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous">
    </script>

    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js" crossorigin="anonymous">
    </script>
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
    html,
    body {
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
                <img src="source/img/logo-white.png" class="d-inline-block align-text-top me-1" alt="DutySaude"
                    height="30">
                DutySaude.com.br
            </a>
            <form class="d-flex" role="search">
                <button class="btn btn-outline-light btn-sm me-3" type="button" onclick="OpenLink('painel');"><i
                        class="fa-solid fa-bars"></i></button>
                <button class="btn btn-outline-light btn-sm" type="button" onclick="logout('');"><i
                        class="fa-solid fa-arrow-right-from-bracket"></i></button>
            </form>
        </div>
    </nav>

    <div class="content w-100 p-3 principal">
        <div class="card">
            <div class="card-body">
                <h2 class="h5 mb-1 text-muted"><i class="fa-solid fa-user-group me-1"></i><?php echo $page ?></h2>
                <hr>
                <div class="row">
                    <div class="form-group col-lg-2 mb-2">
                        <label class="form-label">CPF <font class="text-danger"><b>*</b></font></label>
                        <input id="inputCpf" type="text" class="form-control form-control-sm">
                    </div>
                    <div class="form-group col-lg-2 mb-2">
                        <label class="form-label">RG</label>
                        <input id="inputRg" type="text" class="form-control form-control-sm">
                    </div>
                    <div class="form-group col-lg mb-2">
                        <label class="form-label">Nome</label>
                        <input id="inputNome" type="text" class="form-control form-control-sm">
                    </div>
                    <div class="form-group col-lg-2 mb-2">
                        <label class="form-label">Nascimento <font class="text-danger"><b>*</b></font></label>
                        <input id="inputNasc" type="date" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group col-lg-1 mb-2">
                        <label class="form-label">Sexo <font class="text-danger"><b>*</b></font></label>
                        <select id="inputSexo" class="form-control form-control-sm" required>
                            <option value="0">Feminino</option>
                            <option value="1">Masculino</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-1 mb-2">
                        <label class="form-label">Fator RH</label>
                        <select id="inputFtrh" class="form-control form-control-sm" required>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-3 mb-2">
                        <label class="form-label">Email <font class="text-danger"><b>*</b></font></label>
                        <input id="inputEmail" type="email" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group col-lg mb-2">
                        <label class="form-label">Nome da Mãe</label>
                        <input id="inputNmae" type="text" class="form-control form-control-sm">
                    </div>
                    <div class="form-group col-lg mb-2">
                        <label class="form-label">Nome do Pai</label>
                        <input id="inputNpai" type="text" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-2 mb-2">
                        <label class="form-label">CEP <font class="text-danger"><b>*</b></font></label>
                        <input id="inputCep" type="text" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group col-lg-4 mb-2">
                        <label class="form-label">Rua <font class="text-danger"><b>*</b></font></label>
                        <input id="inputRua" type="text" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group col-lg-1 mb-2">
                        <label class="form-label">Número <font class="text-danger"><b>*</b></font></label>
                        <input id="inputNumb" type="text" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group col-lg-2 mb-2">
                        <label class="form-label">Complemento</label>
                        <input id="inputComplent" type="text" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-4 mb-2">
                        <label class="form-label">Bairro <font class="text-danger"><b>*</b></font></label>
                        <input id="inputBairro" type="text" class="form-control form-control-sm" required>
                    </div>

                    <div class="form-group col-lg-4 mb-2">
                        <label class="form-label">Cidade <font class="text-danger"><b>*</b></font></label>
                        <input id="inputCidade" type="text" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group col-lg-2 mb-2">
                        <label class="form-label">Estado <font class="text-danger"><b>*</b></font></label>
                        <select id="inputUf" class="form-control form-control-sm" required>
                            <option value="AC">AC - Acre</option>
                            <option value="AL">AL - Alagoas</option>
                            <option value="AM">AM - Amazonas</option>
                            <option value="AP">AP - Amapá</option>
                            <option value="BA">BA - Bahia</option>
                            <option value="CE">CE - Ceará</option>
                            <option value="DF">DF - Distrito Federal</option>
                            <option value="ES">ES - Espírito Santo</option>
                            <option value="GO">GO - Goiás</option>
                            <option value="MA">MA - Maranhão</option>
                            <option value="MG">MG - Minas Gerais</option>
                            <option value="MS">MS - Mato Grosso do Sul</option>
                            <option value="MT">MT - Mato Grosso</option>
                            <option value="PA">PA - Pará</option>
                            <option value="PB">PB - Paraíba</option>
                            <option value="PE">PE - Pernambuco</option>
                            <option value="PI">PI - Piauí</option>
                            <option value="PR">PR - Paraná</option>
                            <option value="RJ">RJ - Rio de Janeiro</option>
                            <option value="RN">RN - Rio Grande do Norte</option>
                            <option value="RO">RO - Rondônia</option>
                            <option value="RR">RR - Roraima</option>
                            <option value="RS">RS - Rio Grande do Sul</option>
                            <option value="SC">SC - Santa Catarina</option>
                            <option value="SE">SE - Sergipe</option>
                            <option value="SP">SP - São Paulo</option>
                            <option value="TO">TO - Tocantins</option>
                        </select>

                    </div>
                    <div class="form-group col-lg-4 mb-2">
                        <label class="form-label">Telefone <font class="text-danger"><b>*</b></font></label>
                        <input type="tel" id="phone" name="phone" pattern="\(\d{2}\)\s\d{4,5}-\d{4}"
                            class="form-control form-control-sm" placeholder="(XX) XXXXX-XXXX" required>
                    </div>
                </div>
                <button type="button" id="btnsave" onclick="Salvar();" class="btn btn-primary btn-sm btnduty mt-2"><i
                        class="fa-solid fa-floppy-disk"></i> Salvar</button>
            </div>
        </div>
    </div>

    <script>
    function Salvar() {
        // Valores dos inputs
        const data = {
            cpf: $('#inputCpf').val(),
            rg: $('#inputRg').val(),
            nome: $('#inputNome').val(),
            nascimento: $('#inputNasc').val(),
            sexo: $('#inputSexo').val(),
            fator_rh: $('#inputFtrh').val(),
            email: $('#inputEmail').val(),
            nome_mae: $('#inputNmae').val(),
            nome_pai: $('#inputNpai').val(),
            telefone: $('#phone').val(),
            endereco: {
                rua: $('#inputRua').val(),
                numero: $('#inputNumb').val(),
                complemento: $('#inputComplent').val(),
                bairro: $('#inputBairro').val(),
                cidade: $('#inputCidade').val(),
                uf: $('#inputUf').val(),
                cep: $('#inputCep').val()
            }
        };

        // Verifique se todos os campos obrigatórios estão preenchidos
        for (const [key, value] of Object.entries(data)) {
            if (value === '' || (typeof value === 'object' && Object.values(value).includes(''))) {
                alert('Por favor, preencha todos os campos obrigatórios. Campo faltante: ' + key);
                return;
            }
        }

        // Envia os dados AJAX para o PHP
        $.ajax({
            url: 'source/form/clientes/newcliente.php',
            type: 'POST',
            contentType: 'application/json',
            headers: {
                'API-KEY': '!EYsCiszmzwaDKr2@bGTA^s$M3kJP^anK7Vzq@Tnbj^pLBFB&H'
            },
            data: JSON.stringify(data),
            success: function(response) {
                if (response.error) {
                    alert('Erro: ' + response.error);
                } else {
                    alert(response.message);
                    // Redirecionar ou limpar o formulário
                    window.location.href = 'painel.php';
                }
            },
            error: function(xhr, status, error) {
                alert('Erro ao salvar o cliente: ' + xhr.responseText);
            }
        });
    }
    </script>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>