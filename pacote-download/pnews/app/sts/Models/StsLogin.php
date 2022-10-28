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
            "SELECT id_usuario, senha 
             FROM sts_usuario 
             WHERE email = :email",
            "email={$this->data['email']}"
        );

        $this->data['result'] = $pdoSelect->getResult();

        if (isset($this->data['result'][0]) and !empty($this->data['result'][0])) {

            extract($pdoSelect->getResult()[0]);

            if (password_verify($this->data['senha'], $senha)) {
                $_SESSION['id_usuario'] = $id_usuario;

                $return = array(
                    "cod" => 0,
                    "msg" => 'Login realizado com sucesso!',
                );
    
                echo json_encode($return, JSON_UNESCAPED_UNICODE);
                exit;

            } else {
                $return = array(
                    "cod" => 200,
                    "msg" => 'Erro S300: E-mail e ou Senha inválido!',
                );
    
                echo json_encode($return, JSON_UNESCAPED_UNICODE);
                exit;
            }

        } else {
            $return = array(
                "cod" => 210,
                "msg" => 'Erro S210: E-mail e ou Senha inválido!',
            );

            echo json_encode($return, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
}
