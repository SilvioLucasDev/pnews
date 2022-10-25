<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class StsRegister
{
    private array $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    // *********************************************************************************
    // ***** FUNÇÃO PARA REALIZAR CADASTRO DE USUÁRIO *****
    public function registerUser()
    {
        $pdoSelect = new \Helper\Read();
        $pdoSelect->fullRead(
            "SELECT email, cpf 
             FROM usuarios 
             WHERE cpf = :cpf OR email = :email",
            "cpf={$this->data['cpf']}&email={$this->data['email']}"
        );

        $this->data['result'] = $pdoSelect->getResult();

        if (count($this->data['result']) == 0) {

            $this->data['insert'] = [
                "nome" => $this->data['nome'],
                "cpf" => $this->data['cpf'],
                "dt_nascimento" => $this->data['dt_nascimento'],
                "telefone" => $this->data['telefone'],
                "email" => $this->data['email'], //TRATAR E-MAIL COM A UTILS
                "senha" => password_hash($this->data['senha'], PASSWORD_DEFAULT),
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

            if ($pdoCreate->getResult() != NULL) {
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
