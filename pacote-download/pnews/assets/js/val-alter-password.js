// ********************************************************************
// VALIDA FORM DE ALTERAÇÃO DE SENHA

function validateAlterPass() {
    var senha = $('#senha').val();
    var senha2 = $('#senha2').val();
    var senha3 = $('#senha3').val();

    function resInputError(id, tipo) {

        if (tipo === "") {
            $("#" + id).addClass("error-input-border");
            $("#"+id).after("<p class='error-input-text'>Este campo é obrigatório!</p>");

        } else if (tipo === "senhaError"){
            $("#" + id).addClass("error-input-border");
            $("#"+id).after("<p class='error-input-text'>As senhas digitadas não conferem!</p>");
        }

        setTimeout(function () {
            $("#" + id).removeClass("error-input-border");
            $(".error-input-text").hide('slow');
        }, 3000);
    }

    // VALIDAR AQUI SE OS CAMPOS ESTÃO PREENCHIDOS
    if (!senha) {
        resInputError("senha", "");
        return false;

    } else if (!senha2) {
        resInputError("senha2", "");
        return false;

    } else if (!senha3) {
        resInputError("senha3", "");
        return false;

    } else if (senha2 != senha3) {
        resInputError("senha3", "senhaError");
        return false;
        }

    return true;
};


