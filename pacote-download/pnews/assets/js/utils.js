// ********************************************************************
// SHOW/HIDDEN ÍCONE DO INPUT DE SENHA
const iconPassword = document.querySelector('#icon-password');
const inputPassword = document.querySelector('#senha');

iconPassword.addEventListener("click", function () {
    const type = inputPassword.getAttribute("type");

    if (type === 'password') {
        inputPassword.setAttribute('type', 'text');
        iconPassword.classList.add('fa-eye-slash');
        iconPassword.classList.remove('fa-eye');
    } else {
        inputPassword.setAttribute('type', 'password');
        iconPassword.classList.add('fa-eye');
        iconPassword.classList.remove('fa-eye-slash');
    }
})

// ********************************************************************
// SHOW/HIDDEN ÍCONE DO INPUT DE NOVA SENHA
const iconPasswordNew = document.querySelector('#icon-password2');
const inputPasswordNew = document.querySelector('#senha2');

iconPasswordNew.addEventListener("click", function () {
    const type = inputPasswordNew.getAttribute("type");

    if (type === 'password') {
        inputPasswordNew.setAttribute('type', 'text');
        iconPasswordNew.classList.add('fa-eye-slash');
        iconPasswordNew.classList.remove('fa-eye');
    } else {
        inputPasswordNew.setAttribute('type', 'password');
        iconPasswordNew.classList.add('fa-eye');
        iconPasswordNew.classList.remove('fa-eye-slash');
    }
})

// ********************************************************************
// SHOW/HIDDEN ÍCONE DO INPUT DE CONFIRMAÇÃO DE SENHA
const iconPasswordConfirm = document.querySelector('#icon-password3');
const inputPassworConfirm = document.querySelector('#senha3');

iconPasswordConfirm.addEventListener("click", function () {
    const type = inputPassworConfirm.getAttribute("type");

    if (type === 'password') {
        inputPassworConfirm.setAttribute('type', 'text');
        iconPasswordConfirm.classList.add('fa-eye-slash');
        iconPasswordConfirm.classList.remove('fa-eye');
    } else {
        inputPassworConfirm.setAttribute('type', 'password');
        iconPasswordConfirm.classList.add('fa-eye');
        iconPasswordConfirm.classList.remove('fa-eye-slash');
    }
})
