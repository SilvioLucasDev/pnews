// ********************************************************************
// VALIDA FORM DE LOGIN 

function validateLogin() {
    var email = $('#email').val();
    var senha = $('#senha').val();

    function resInputError(id, tipo) {

        if (tipo === "") {
            $("#" + id).addClass("error-input-border");
            $("#" + id).after("<p class='error-input-text'>Este campo é obrigatório!</p>");

        } else if (tipo === "emailInvalido") {
            $("#" + id).addClass("error-input-border");
            $("#" + id).after("<p class='error-input-text'>Formato de e-mail inválido!</p>");
        }

        setTimeout(function () {
            $("#" + id).removeClass("error-input-border");
            $(".error-input-text").hide('slow');
        }, 3000);
    }

    if (!email) {
        resInputError("email", "");
        return false;

    } else if (!email.match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
        resInputError("email", "emailInvalido");
        return false;

    } else if (!senha) {
        resInputError("senha", "");
        return false;
    }

    return true;
};