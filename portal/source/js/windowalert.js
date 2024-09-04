const htmlalertbox = "<div id='alertbox' style='position: fixed; width: 100%; max-width: 400px; right: 0px; bottom: 0px; padding: 10px;'></div>";

function gerarCodigo(tamanho) {
    const caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let codigo = '';

    for (let i = 0; i < tamanho; i++) {
        const indiceAleatorio = Math.floor(Math.random() * caracteres.length);
        codigo += caracteres.charAt(indiceAleatorio);
    }

    return codigo;
}

function ExibirAlert(typ, msg) {
    console.group("Alerta");
    console.log(msg);
    console.groupEnd();

    let alerta;
    let alertaid = gerarCodigo(20);


    switch (typ.toUpperCase()) {
        case "I":
            alerta = "<div id='" + alertaid + "' style='cursor: default;' class='alert alert-info m-0 mt-2' role='alert'>" + msg + "</div>";
            break;
        case "W":
            alerta = "<div id='" + alertaid + "' style='cursor: default;' class='alert alert-warning m-0 mt-2' role='alert'>" + msg + "</div>";
            break;
        case "E":
            alerta = "<div id='" + alertaid + "' style='cursor: default;' class='alert alert-danger m-0 mt-2' role='alert'>" + msg + "</div>";
            break;
        case "S":
            alerta = "<div id='" + alertaid + "' style='cursor: default;' class='alert alert-success m-0 mt-2' role='alert'>" + msg + "</div>";
            break;
    }

    $("#alertbox").append(alerta);

    alertaid = "#" + alertaid;
    
    let timeshow = msg.length;
    timeshow = timeshow * 100;
    if (timeshow < 1000) {
       timeshow = 1000; 
    }
    if (timeshow > 3000) {
       timeshow = 3000; 
    }
    
    setTimeout(() => {
        $(alertaid).animate({opacity: 0.0}, timeshow);
    }, timeshow);
    setTimeout(() => {
        $(alertaid).remove();
    }, timeshow * 2);
}

$(document).ready(function () {
    document.body.innerHTML += htmlalertbox;
    console.log("Carregou - Script de Alertas");
});

