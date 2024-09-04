var configplans = [];
var dados = {
    cpf: false,
    plano: "",
    responsavel: "",
    titulares: []
};

$(document).ready(function () {

    var ajax1 = $.ajax({
        url: "source/form/planos/listconfigs.php",
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {
            console.log("Carregando planos...");
        }
    })
            .done(function (data) {
                console.log(data);
                configplans = data;
                Inicio();
                //$("#view-form").fadeIn("slow");
            })
            .fail(function (jqXHR, textStatus, data) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(data);
                ExibirMsg("E", "Erro ao carregar planos");
            });
});

function Inicio() {
    $("#define-person").fadeIn("slow");
}

function convertBool(value) {
    return parseInt(value) == 1;
}

function DefinirTipo() {

    dados.cpf = convertBool($("#inputTypePerson").val());

    $("#inputTypePlan").empty();

    $.each(configplans, function (index, plan) {
        if (dados.cpf == plan.cpf) {
            $("#inputTypePlan").append($('<option>', {
                value: plan.codigo,
                text: plan.descricao
            }));
        }
    });

    $("#define-person").fadeOut("slow", function () {
        $("#define-type-plan").fadeIn("slow");
    });
}

function BackTipo() {
    $("#define-type-plan").fadeOut("slow", function () {
        $("#define-person").fadeIn("slow");
    });
}

function DefinirPlan() {

    dados.plano = $("#inputTypePlan").val();
    console.log("Plano escolhido foi - " + dados.plano);

    if (dados.cpf) {
        $("#text-chave").html("Ok, insira agora o numero do CPF aqui...");
        $("#label-chave").html("CPF");
    } else {
        $("#text-chave").html("Ok, insira agora o numero do CNPJ aqui...");
        $("#label-chave").html("CNPJ");
    }
    $("#define-type-plan").fadeOut("slow", function () {
        $("#getchave").fadeIn("slow");
    });
}

function BackSelectPlan() {
    $("#getchave").fadeOut("slow", function () {
        $("#define-type-plan").fadeIn("slow");
    });
}

function ProcurarChave() {
    $("#inputChave").removeClass("is-invalid");
    if ($("#inputChave").val().trim() !== '') {
        $("#getchave").fadeOut("slow", function () {
            $("#loading").fadeIn("slow");
            ProcurarData();
        });
    } else {
        $("#inputChave").addClass("is-invalid");
    }
}

function ProcurarData() {
    $("#loading").fadeOut("slow", function () {
        let textview = "";
        if (dados.cpf) {
            textview = "O titular será FELIPE LOPES MELO?";
            $("#label-view-cod").html("CPF");
            $("#label-view-text").html("Nome");

            $("#inputCod").val("832.035.240-15");
            $("#inputResp").val("FELIPE LOPES MELO");
            $("#textPlan").val($("#inputTypePlan option:selected").text());
            $("#label-titular").html("<i class='fa-solid fa-user me-1'></i>Titular");
            
        } else {
            textview = "O representante será LDE SISTEMAS LTDA?";
            $("#label-view-cod").html("CNPJ");
            $("#label-view-text").html("Razão Social");

            $("#inputCod").val("64.476.816/0001-79");
            $("#inputResp").val("LDE SISTEMAS LTDA");
            $("#textPlan").val($("#inputTypePlan option:selected").text());
            $("#label-titular").html("<i class='fa-solid fa-user-group me-1'></i>Funcionário(s)");
        }
        $("#textviewcustom").html(textview);
        $("#dataview").fadeIn("slow");
    });

}

function ConfirmDados() {
    $("#dataview").fadeOut("slow", function () {
        $("#view-form").fadeIn("slow");
    });
}