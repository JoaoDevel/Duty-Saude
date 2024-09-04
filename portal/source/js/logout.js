var htmlmodallogout = "";
htmlmodallogout = htmlmodallogout + "<div class='modal fade' id='JanelaLogoutModal' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>";
htmlmodallogout = htmlmodallogout + "<div class='modal-dialog'>";
htmlmodallogout = htmlmodallogout + "<div class='modal-content'>";
htmlmodallogout = htmlmodallogout + "<div class='modal-header'>";
htmlmodallogout = htmlmodallogout + "<h5 class='modal-title'><i class='fa-solid fa-triangle-exclamation text-danger me-2'></i>Fazer Logout?</h5>";
htmlmodallogout = htmlmodallogout + "</div>";
htmlmodallogout = htmlmodallogout + "<div class='modal-body'>";
htmlmodallogout = htmlmodallogout + "<p>Você tem certeza que deseja fazer logout do sistema?</p>";
htmlmodallogout = htmlmodallogout + "</div>";
htmlmodallogout = htmlmodallogout + "<div class='modal-footer'>";
htmlmodallogout = htmlmodallogout + "<button id='BtnLogout' href='#' class='btn btn-light btn-sm btnduty'><i class='fa-solid fa-arrow-right-from-bracket me-2'></i>Fazer logout</button>";
htmlmodallogout = htmlmodallogout + "<button type='button' class='btn btn-secondary btn-sm' data-bs-dismiss='modal'><i class='fa-solid fa-xmark me-2'></i>Cancelar</button>";
htmlmodallogout = htmlmodallogout + "</div>";
htmlmodallogout = htmlmodallogout + "</div>";
htmlmodallogout = htmlmodallogout + "</div>";
htmlmodallogout = htmlmodallogout + "</div>";


function logout(path) {
    console.log("Chamando modal logout");
    const intmodallogout = setInterval(() => {
        if (!$('#JanelaLogoutModal').is(':visible')) {
            $('#JanelaLogoutModal').modal('show');

            $("#BtnLogout").on("click", function () {
                $('#JanelaLogoutModal').modal('hide');
                let link = path + 'source/form/login/logout';
                OpenLink(link);
            });
        } else {
            clearInterval(intmodallogout);
        }
    }, 500);
}

$(document).ready(function () {
    $('body').append(htmlmodallogout);
});