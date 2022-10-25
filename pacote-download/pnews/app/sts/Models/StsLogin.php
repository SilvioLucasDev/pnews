<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class StsLogin
{
    private array $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    // *********************************************************************************
    // ***** FUNÇÃO PARA VALIDAR LOGIN DE USUÁRIO *****
    public function validateLogin()
    {
        $pdoSelect = new \Helper\Read();
        $pdoSelect->fullRead(
            "SELECT id, senha 
             FROM usuarios 
             WHERE email = :email",
            "email={$this->data['email']}"
        );

        $this->data['result'] = $pdoSelect->getResult();

        if (isset($this->data['result']) and !empty($this->data['result'])) {

            extract($pdoSelect->getResult()[0]);

            if (password_verify($this->data['senha'], $senha)) {

                $_SESSION['id_usuario'] = $id;
                return true;

            } else {
                $_SESSION["retorno"] =  "erro";
                $_SESSION["msg"] = "E-mail e/ou Senha inválido";
                return false;
            }
        } else {

            $_SESSION["retorno"] =  "erro";
            $_SESSION["msg"] = "E-mail e/ou Senha inválido";
            return false;
        }
    }
}
