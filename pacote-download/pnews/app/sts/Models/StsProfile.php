<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class StsProfile
{
    private $data;

    public function __construct($data = NULL)
    {
        $this->data = $data;
    }

    // *********************************************************************************
    // ***** FUNÇÃO PARA SELECIONAR DADOS DO USUÁRIO *****
    public function listProfile()
    {
        $pdoSelect = new \Helper\Read();
        $pdoSelect->fullRead(
            "SELECT nome, cpf, dt_nascimento, telefone, email, senha, rua, numero, bairro, cidade, estado, modelo_moto, pneu_utilizado, modelo_pneu, tp_medio_troca
             FROM usuarios 
             WHERE id = :id",
            "id={$_SESSION['id_usuario']}"
        );

        $this->data['result'] = $pdoSelect->getResult();

        if (isset($this->data['result']) AND !empty($this->data['result'])) {
            return $this->data['result'][0];
            
        } else {
            $_SESSION["retorno"] =  "erro";
            $_SESSION["msg"] = "Ocorreu um erro inesperado, se o erro persistir entre em contato com nosso atendimento.";
            return false;
        }
    }
}
