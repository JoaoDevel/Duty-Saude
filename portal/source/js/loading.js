var htmlmodalloading = "";
htmlmodalloading = htmlmodalloading + "<div class='modal fade' id='ModalLoading' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>";
htmlmodalloading = htmlmodalloading + "<div class='modal-dialog modal-dialog-centered' role='document'>";
htmlmodalloading = htmlmodalloading + "<div class='modal-content' style='border: 0px;background: rgba(0,0,0,0.0);'>";
htmlmodalloading = htmlmodalloading + "<div class='text-center'>";
htmlmodalloading = htmlmodalloading + "<div class='spinner-border text-light' style='width: 4rem; height: 4rem;' role='status'>";
htmlmodalloading = htmlmodalloading + "<span class='sr-only'>Loading...</span>";
htmlmodalloading = htmlmodalloading + "</div>";
htmlmodalloading = htmlmodalloading + "</div>";
htmlmodalloading = htmlmodalloading + "</div>";
htmlmodalloading = htmlmodalloading + "</div>";
htmlmodalloading = htmlmodalloading + "</div>";

function OpenLoading() {
    const intmodallogout = setInterval(() => {
        if (!$('#ModalLoading').is(':visible')) {
            $('#ModalLoading').modal('show');
        } else {
            clearInterval(intmodallogout);
        }
    }, 500);
}

function CloseLoading() {
    const intmodallogout = setInterval(() => {
        if ($('#ModalLoading').is(':visible')) {
            $('#ModalLoading').modal('hide');
        } else {
            clearInterval(intmodallogout);
        }
    }, 500);
}

function OpenLink(link) {
    OpenLoading();
    setTimeout(function () {
        window.location.href = link;
    }, 1000);
}


$(document).ready(function () {
    $('body').append(htmlmodalloading);
});