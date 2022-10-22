<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class StsProfile
{
    private array $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    // *********************************************************************************
    // ***** FUNÇÃO PARA SELECIONAR DADOS DO USUÁRIO *****
    public function getDataUser()
    {
        $pdoSelect = new \Helper\Read();
        $pdoSelect->fullRead(
            "SELECT email, cpf 
             FROM usuarios 
             WHERE cpf = :cpf OR email = :email",
            "cpf={{$this->data['cpf']}email={$this->data['email']}"
        );

        $result = $pdoSelect->getResult()[0];

        if (count($result) == 0) {

            $this->data['insert'] = [
                "nome" => $this->data['nome'],
                "cpf" => $this->data['cpf'],
                "dt_nascimento" => $this->data['dt_nascimento'],
                "telefone" => $this->data['telefone'],
                "email" => $this->data['email'],
                "senha" => $this->data['senha'],
                "rua" => $this->data['rua'],
                "numero" => $this->data['numero'],
                "bairro" => $this->data['bairro'],
                "cidade" => $this->data['cidade'],
                "estado" => $this->data['estado'],
                "modelo_moto" => $this->data['modelo_moto'],
                "pneu_utilizado" => $this->data['pneu_utilizado'],
                "modelo_pneu" => $this->data['modelo_pneu'],
                "tp_medio_troca" => $this->data['tp_medio_troca'],
            ];

            $pdoCreate = new \Helper\Create();
            $pdoCreate->exeCreate("usuarios", $this->data['insert']);

            if (isset($pdoCreate->getResult())) {
                $_SESSION["retorno"] =  "sucesso";
                $_SESSION["msg"] = "Cadastro realizado com sucesso!";
                return true;
            } else {
                $_SESSION["retorno"] =  "erro";
                $_SESSION["msg"] = "Ocorreu um erro inesperado, se o erro persistir entre em contato com nosso atendimento.";
                return false;
            }
        } else {
            $_SESSION["retorno"] =  "erro";
            $_SESSION["msg"] = "E-mail e/ou CPF já cadastrado no sistema!";
            return false;
        }
    }
}
