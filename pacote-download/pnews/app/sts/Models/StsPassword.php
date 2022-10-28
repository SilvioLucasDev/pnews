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
             FROM sts_usuario 
             WHERE id_usuario = :id",
            "id={$_SESSION['id_usuario']}"
        );

        $this->data['result'] = $pdoSelect->getResult();

        if (isset($this->data['result']) and !empty($this->data['result'])) {
            extract($pdoSelect->getResult()[0]);

            if ($this->data['senha2'] == $this->data['senha3']) {

                if (password_verify($this->data['senha'], $senha)) {

                    if (!password_verify($this->data['senha'], $this->data['senha2'])) {
                        $this->data['update'] = [
                            "senha" => password_hash($this->data['senha2'], PASSWORD_DEFAULT),
                        ];

                        $pdoUpdate = new \Helper\Update();
                        $pdoUpdate->exeUpdate(
                            "sts_usuario",
                            $this->data['update'],
                            "WHERE id_usuario = :id",
                            "id={$_SESSION['id_usuario']}"
                        );

                        $this->data['result'] = $pdoUpdate->getResult();

                        if ($this->data['result']) {

                            $return = array(
                                "cod" => 0,
                                "msg" => 'Senha alterada com sucesso!'
                            );

                            echo json_encode($return, JSON_UNESCAPED_UNICODE);
                            exit;
                        } else {

                            $return = array(
                                "cod" => 400,
                                "msg" => 'Erro S400: Falha ao alterar a senha. Se o erro persistir entre em contato com nosso atendimento.',
                            );

                            echo json_encode($return, JSON_UNESCAPED_UNICODE);
                            exit;
                        }
                    } else {
                        $return = array(
                            "cod" => 410,
                            "msg" => 'Erro S410: Digite uma senha diferente da atual para prosseguir.',
                        );

                        echo json_encode($return, JSON_UNESCAPED_UNICODE);
                        exit;
                    }
                } else {
                    $return = array(
                        "cod" => 420,
                        "msg" => 'Erro S420: A senha atual digitada está incorreta!',
                    );

                    echo json_encode($return, JSON_UNESCAPED_UNICODE);
                    exit;
                }
            } else {
                $return = array(
                    "cod" => 430,
                    "msg" => 'Erro S430: As senhas digitadas não conferem!',
                );

                echo json_encode($return, JSON_UNESCAPED_UNICODE);
                exit;
            }
        } else {
            $return = array(
                "cod" => 440,
                "msg" => 'Erro S440: Falha ao alterar a senha. Se o erro persistir entre em contato com nosso atendimento.',
            );

            echo json_encode($return, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
}
