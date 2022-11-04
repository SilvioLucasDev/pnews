$(window).on("load", function () {
    
    // ********************************************************************
    // MÁSCARA PARA INPUTS 

    $('.cpf').mask('000.000.000-00');
    $('.cnpj').mask('00.000.000/0000-00');
    $('.val').mask("#.##0,00", { reverse: true });
    $('.porcent').mask('#0%', { reverse: true });
    $('.cep').mask('00.000-000');
    $('.date').mask('00/00/0000');
    $('.hour').mask('00:00');

    $('.rg').mask('999.999.999-W', {
        translation: {
            'W': {
                pattern: /[xX0-9]/
            }
        },
        reverse: true
    });

    // TELEFONE
    var phoneMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
        phoneOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(phoneMaskBehavior.apply({}, arguments), options);
            }
        };

    $('.phone').mask(phoneMaskBehavior, phoneOptions);

    // MODELO PNEU
    $('.pneu').mask('000/00-00'), { reverse: true };
});