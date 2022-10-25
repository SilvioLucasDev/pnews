<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class StsPassword
{
    private array $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    // *********************************************************************************
    // ***** FUNÇÃO PARA ALTERAR A SENHA DO USUÁRIO *****
    public function alterPassword()
    {
        $pdoSelect = new \Helper\Read();
        $pdoSelect->fullRead(
            "SELECT senha
             FROM usuarios 
             WHERE id = :id",
            "id={$_SESSION['id_usuario']}"
        );

        $this->data['result'] = $pdoSelect->getResult();

        if (isset($this->data['result']) and !empty($this->data['result'])) {

            if ($this->data['senha2'] == $this->data['senha3']) {
                extract($pdoSelect->getResult()[0]);

                if (password_verify($this->data['senha'], $senha)) {
                    $this->data['update'] = [
                        "senha" => password_hash($this->data['senha2'], PASSWORD_DEFAULT),
                    ];

                    $pdoUpdate = new \Helper\Update();
                    $pdoUpdate->exeUpdate(
                        "usuarios",
                        $this->data['update'],
                        "WHERE id=:id",
                        "id={$_SESSION['id_usuario']}"
                    );

                    $this->data['result'] = $pdoUpdate->getResult();

                    if ($this->data['result']) {
                        $_SESSION["retorno"] =  "sucesso";
                        $_SESSION["msg"] = "Senha alterada com sucesso!";
                        return true;
                    } else {
                        $_SESSION["retorno"] =  "erro";
                        $_SESSION["msg"] = "Erro ao alterar a senha!";
                        return false;
                    }
                } else {
                    $_SESSION["retorno"] =  "erro";
                    $_SESSION["msg"] = "A senha atual digitada está incorreta!";
                    return false;
                }
            } else {
                $_SESSION["retorno"] =  "erro";
                $_SESSION["msg"] = "As senhas digitadas não conferem!";
                return false;
            }
        } else {

            $_SESSION["retorno"] =  "erro";
            $_SESSION["msg"] = "Erro ao alterar a senha!";
            return false;
        }
    }
}
