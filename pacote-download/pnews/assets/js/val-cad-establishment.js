// ********************************************************************
// VALIDA FORM PARA CADASTRAR ESTABELECIMENTOS

function validateCadEstablishment() {
    var nome = $('#nome').val();
    var telefone = $('#telefone').val();
    var email = $('#email').val();

    function resInputError(id, tipo, qtd) {

        if (tipo === "") {
            $("#" + id).addClass("error-input-border");
            $("#" + id).after("<p class='error-input-text'>Este campo é obrigatório!</p>");

        } else if (tipo === "emailInvalido") {
            $("#" + id).addClass("error-input-border");
            $("#" + id).after("<p class='error-input-text'>Formato de e-mail inválido!</p>");

        } else if (tipo === "senhaInvalida") {
            $("#" + id).addClass("error-input-border");
            $("#" + id).after("<p class='error-input-text'>Este campo deve conter pelo menos 1 número, 1 letra maiuscula, 1 minúscula e 8 dígitos</p>");

        } else if (tipo === "somenteLetras") {
            $("#" + id).addClass("error-input-border");
            $("#" + id).after("<p class='error-input-text'>Este campo não aceita números e caracteres especiais!</p>");

        } else if (tipo === "somenteNumeros") {
            $("#" + id).addClass("error-input-border");
            $("#" + id).after("<p class='error-input-text'>Este campo aceita somente números!</p>");

        } else if (tipo === "semCaracteresEspeciais") {
            $("#" + id).addClass("error-input-border");
            $("#" + id).after("<p class='error-input-text'>Este campo não aceita caracteres especiais!</p>");

        } else if (tipo === "tamanhoMaior") {
            $("#" + id).addClass("error-input-border");
            $("#" + id).after("<p class='error-input-text'>Este campo deve conter no máximo " + qtd + " caracteres!</p>");

        } else if (tipo === "tamanhoMenor") {
            $("#" + id).addClass("error-input-border");
            $("#" + id).after("<p class='error-input-text'>Este campo deve conter no mínimo " + qtd + " caracteres!</p>");
        }

        setTimeout(function () {
            $("#" + id).removeClass("error-input-border");
            $(".error-input-text").hide('slow');
        }, 3000);
    }

    // NOME
    if (!nome) {
        resInputError("nome", "");
        return false;

    } else if (!nome.match(/^[a-zA-Zà-úÀ-Ú0-9\s]*$/)) {
        resInputError("nome", "semCaracteresEspeciais");
        return false;

    } else if (nome.length > 60) {
        resInputError("nome", "tamanhoMaior", "60");
        return false;
    }

    // TELEFONE
    if (!telefone && !email) {
        resInputError("telefone", "");
        return false;
    }

    if (telefone) {
        if (!telefone.match(/^[- ()0-9]+$/)) {
            resInputError("telefone", "somenteNumeros");
            return false;

        } else if (telefone.length < 14) {
            resInputError("telefone", "tamanhoMenor", "14");
            return false;

        } else if (telefone.length > 15) {
            resInputError("telefone", "tamanhoMaior", "15");
            return false;
        }
    }

    // E-MAIL
    if (!email && !telefone) {
        resInputError("email", "");
        return false;
    }

    if (email) {

        if (!email.match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            resInputError("email", "emailInvalido");
            return false;

        } else if (email.length > 70) {
            resInputError("email", "tamanhoMaior", "70");
            return false;
        }
    }
    return true;
};


