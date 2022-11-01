// ********************************************************************
// VALIDA FORM PÁGINA DE LOGIN 

function validateCadUser() {
    const nome = $('#nome').val();
    const sobrenome = $('#sobrenome').val();
    const cpf = $('#cpf').val();
    const dt_nascimento = $('#dt_nascimento').val();
    const telefone = $('#telefone').val();
    const email = $('#email').val();
    const senha = $('#senha').val();
    const cep = $('#cep').val();
    const rua = $('#rua').val();
    const bairro = $('#bairro').val();
    const numero = $('#numero').val();
    const complemento = $('#complemento').val();
    const cidade = $('#cidade').val();
    const estado = $('#estado').val();

    const apelido_veiculo = $('#apelido_veiculo').val();
    const fabricante_veiculo = $('#fabricante_veiculo').val();
    const modelo_veiculo = $('#modelo_veiculo').val();
    const ano_veiculo = $('#ano_veiculo').val();
    const modelo_pneu_dianteiro = $('#modelo_pneu_dianteiro').val();
    const modelo_pneu_traseiro = $('#modelo_pneu_traseiro').val();
    const fabricante_pneu = $('#fabricante_pneu').val();
    const ultima_troca_pneu = $('#ultima_troca_pneu').val();
    const tempo_medio_troca_pneu = $('#tempo_medio_troca_pneu').val();

    const stage1 = document.getElementById('stage-1');
    const stage2 = document.getElementById('stage-2');

    function resInputError(id, tipo, qtd) {

        if (id === "nome" || id === "sobrenome" || id === "cpf" || id === "dt_nascimento" || id === "telefone" || id === "email" || id === "senha" || id === "cep" || id === "rua" || id === "bairro" || id === "numero" || id === "complemento" || id === "cidade" || id === "estado") {
            stage1.style.display = "block"; // ESCONDER ETAPA 2
            stage2.style.display = "none"; // MOSTRAR ETAPA 1
        }

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

    } else if (!nome.match(/^[a-zA-Zà-úÀ-Ú\s]*$/)) {
        resInputError("nome", "somenteLetras");
        return false;
    }

    // SOBRENOME
    if (!sobrenome) {
        resInputError("sobrenome", "");
        return false;

    } else if (!sobrenome.match(/^[a-zA-Zà-úÀ-Ú\s]*$/)) {
        resInputError("sobrenome", "somenteLetras");
        return false;
    }

    // CPF
    if (!cpf) {
        resInputError("cpf", "");
        return false;

    } else if (!cpf.match(/^[\d.-]+$/)) {
        resInputError("cpf", "somenteNumeros");
        return false;

    } else if (cpf.length < 14) {
        resInputError("cpf", "tamanhoMenor", "14");
        return false;
    }

    // DATA NASCIEMTO
    if (!dt_nascimento) {
        resInputError("dt_nascimento", "");
        return false;

    } else if (!dt_nascimento.match(/^[\d/]+$/)) {
        resInputError("dt_nascimento", "somenteNumeros");
        return false;

    } else if (dt_nascimento.length < 10) {
        resInputError("dt_nascimento", "tamanhoMenor", "10");
        return false;
    }

    // TELEFONE
    if (!telefone) {
        resInputError("telefone", "");
        return false;

    } else if (!telefone.match(/^[- ()0-9]+$/)) {
        resInputError("telefone", "somenteNumeros");
        return false;

    } else if (telefone.length < 14) {
        resInputError("telefone", "tamanhoMenor", "14");
        return false;
    }

    // E-MAIL
    if (!email) {
        resInputError("email", "");
        return false;

    } else if (!email.match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
        resInputError("email", "emailInvalido");
        return false;
    }

    // SENHA
    if (!senha) {
        resInputError("senha", "");
        return false;

    } else if (!senha.match(/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/)) {
        resInputError("senha", "senhaInvalida");
        return false;

    } else if (senha.length < 8) {
        resInputError("senha", "tamanhoMenor", "8");
        return false;

    } else if (senha.length > 64) {
        resInputError("senha", "tamanhoMaior", "64");
    }

    // CEP
    if (!cep) {
        resInputError("cep", "");
        return false;

    } else if (!cep.match(/^[\d.-]+$/)) {
        resInputError("cep", "somenteNumeros");
        return false;

    } else if (cep.length < 10) {
        resInputError("cep", "tamanhoMenor", "10");
        return false;
    }

    // RUA
    if (!rua) {
        resInputError("rua", "");
        return false;

    } else if (!rua.match(/^[a-zA-Zà-úÀ-Ú\s]*$/)) {
        resInputError("rua", "somenteLetras");
        return false;

    } else if (rua.length > 70) {
        resInputError("rua", "tamanhoMaior", "70");
        return false;
    }

    // BAIRRO
    if (!bairro) {
        resInputError("bairro", "");
        return false;

    } else if (!bairro.match(/^[a-zA-Zà-úÀ-Ú\s]*$/)) {
        resInputError("bairro", "somenteLetras");
        return false;

    } else if (bairro.length > 70) {
        resInputError("bairro", "tamanhoMaior", "70");
        return false;
    }

    // NUMERO
    if (!numero) {
        resInputError("numero", "");
        return false;

    } else if (!numero.match(/^[\d.-]+$/)) {
        resInputError("numero", "somenteNumeros");
        return false;

    } else if (numero.length > 10) {
        resInputError("numero", "tamanhoMaior", "10");
        return false;
    }

    // COMPLEMENTO
    if (complemento.length > 30) {
        resInputError("complemento", "tamanhoMaior", "30");
        return false;
    }

    // CIDADE
    if (!cidade) {
        resInputError("cidade", "");
        return false;

    } else if (!cidade.match(/^[a-zA-Zà-úÀ-Ú\s]*$/)) {
        resInputError("cidade", "somenteLetras");
        return false;

    } else if (cidade.length > 50) {
        resInputError("cidade", "tamanhoMaior", "50");
        return false;
    }

    // ESTADO
    if (!estado) {
        resInputError("estado", "");
        return false;
    }

    // APELIDO VEÍCULO
    if (!apelido_veiculo) {
        resInputError("apelido_veiculo", "");
        return false;

    } else if (apelido_veiculo.length > 30) {
        resInputError("apelido_veiculo", "tamanhoMaior", "30");
        return false;
    }

    // FABRICANTE VEÍCULO
    if (!fabricante_veiculo) {
        resInputError("fabricante_veiculo", "");
        return false;

    } else if (!fabricante_veiculo.match(/^[a-zA-Zà-úÀ-Ú\s]*$/)) {
        resInputError("fabricante_veiculo", "somenteLetras");
        return false;

    } else if (fabricante_veiculo.length > 30) {
        resInputError("fabricante_veiculo", "tamanhoMaior", "30");
        return false;
    }

    // MODELO VEÍCULO
    if (!modelo_veiculo) {
        resInputError("modelo_veiculo", "");
        return false;

    } else if (modelo_veiculo.length > 30) {
        resInputError("modelo_veiculo", "tamanhoMaior", "30");
        return false;
    }

    // ANO VEÍCULO
    if (!ano_veiculo) {
        resInputError("ano_veiculo", "");
        return false;

    } else if (!ano_veiculo.match(/^[\d.-]+$/)) {
        resInputError("ano_veiculo", "somenteNumeros");
        return false;

    } else if (ano_veiculo.length > 4) {
        resInputError("ano_veiculo", "tamanhoMaior", "4");
        return false;

    } else if (ano_veiculo.length < 4) {
        resInputError("ano_veiculo", "tamanhoMenor", "4");
        return false;
    }

    // MODELO PNEU DIANTEIRO
    if (!modelo_pneu_dianteiro) {
        resInputError("modelo_pneu_dianteiro", "");
        return false;

    } else if (!modelo_pneu_dianteiro.match(/^[\d/-]+$/)) {
        resInputError("modelo_pneu_dianteiro", "somenteNumeros");
        return false;

    } else if (modelo_pneu_dianteiro.length > 10) {
        resInputError("modelo_pneu_dianteiro", "tamanhoMaior", "10");
        return false;
    }

    // MODELO PNEU TRASEIRO
    if (!modelo_pneu_traseiro) {
        resInputError("modelo_pneu_traseiro", "");
        return false;

    } else if (!modelo_pneu_traseiro.match(/^[\d/-]+$/)) {
        resInputError("modelo_pneu_traseiro", "somenteNumeros");
        return false;

    } else if (modelo_pneu_traseiro.length > 10) {
        resInputError("modelo_pneu_traseiro", "tamanhoMaior", "10");
        return false;
    }

    // FABRICANTE PNEU
    if (!fabricante_pneu) {
        resInputError("fabricante_pneu", "");
        return false;

    } else if (!fabricante_pneu.match(/^[a-zA-Zà-úÀ-Ú\s]*$/)) {
        resInputError("fabricante_pneu", "somenteLetras");
        return false;

    } else if (fabricante_pneu.length > 30) {
        resInputError("fabricante_pneu", "tamanhoMaior", "30");
        return false;
    }

    // ULTIMA TROCA PNEU
    if (!ultima_troca_pneu) {
        resInputError("ultima_troca_pneu", "");
        return false;
    }

    // TEMPO MÉDIO DE TROCA
    if (!tempo_medio_troca_pneu) {
        resInputError("tempo_medio_troca_pneu", "");
        return false;
    }

    return true;
};