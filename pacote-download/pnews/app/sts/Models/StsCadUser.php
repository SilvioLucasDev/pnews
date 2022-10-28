<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class StsCadUser
{
    private array $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    // *********************************************************************************
    // ***** VALIDA SE O E-MAIL OU CPF JÁ EXISTE NA BASE *****
    public function cadUser()
    {
        $pdoSelect = new \Helper\Read();
        $pdoSelect->fullRead(
            "SELECT email, cpf 
             FROM sts_usuario 
             WHERE cpf = :cpf OR email = :email",
            "cpf={$this->data['cpf']}&email={$this->data['email']}"
        );

        $this->data['result'] = $pdoSelect->getResult();

        // VALIDAR AQUI SE OS DADOS ESTÃO PREENCHIDOS CORRETAMENTE E FORMATAR
        // SE ESTIVER ERRADO DEVOLVER UM ERRO AO USUÁRIO
        if (!isset($this->data['result'][0]) AND !empty($this->data['result'][0])) {
            $this->setUser();
        } else {
            $return = array(
                "cod" => 100,
                "msg" => 'Erro S100: E-mail e ou CPF já cadastrado no sistema!',
            );

            echo json_encode($return, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    // *********************************************************************************
    // ***** INSERT DADOS USUÁRIO *****
    public function setUser()
    {
        $this->data['insert_user'] = [
            "nome" => $this->data['nome'],
            "sobrenome" => $this->data['sobrenome'],
            "cpf" => $this->data['cpf'],
            "dt_nascimento" => $this->data['dt_nascimento'],
            "email" => $this->data['email'], //TRATAR E-MAIL COM A UTILS
            "senha" => password_hash($this->data['senha'], PASSWORD_DEFAULT),
            "fk_usuario_status" => 2,
            "dt_created" => date("Y-m-d H:i:s")
        ];

        $pdoCreate = new \Helper\Create();
        $pdoCreate->exeCreate("sts_usuario", $this->data['insert_user']);

        $this->data['id'] = $pdoCreate->getResult();

        if ($pdoCreate->getResult() != NULL) {
            $this->data['id'] = $pdoCreate->getResult();
            $this->setPhone();
        } else {
            $return = array(
                "cod" => 110,
                "msg" => 'Erro S110: Tente novamente. Se o erro persistir entre em contato com nosso atendimento',
            );

            echo json_encode($return, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    // *********************************************************************************
    // ***** INSERT DADOS TELEFONE  *****
    public function setPhone()
    {
        $this->data['insert_phone'] = [
            "telefone" => $this->data['telefone'],
            "fk_telefone_usuario" => $this->data['id'],
            "fk_telefone_status" => 2,
            "dt_created" => date("Y-m-d H:i:s")
        ];

        $pdoCreate = new \Helper\Create();
        $pdoCreate->exeCreate("sts_telefone_usuario", $this->data['insert_phone']);

        if ($pdoCreate->getResult() != NULL) {

            $this->setAdress();
        } else {
            $return = array(
                "cod" => 120,
                "msg" => 'Erro S120: Tente novamente. Se o erro persistir entre em contato com nosso atendimento',
            );

            echo json_encode($return, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    // *********************************************************************************
    // ***** INSERT DADOS ENDERECO *****
    public function setAdress()
    {
        $this->data['insert_adress'] = [
            "cep" => $this->data['cep'],
            "cidade" => $this->data['cidade'],
            "estado" => $this->data['estado'],
            "bairro" => $this->data['bairro'],
            "rua" => $this->data['rua'],
            "numero" => $this->data['numero'],
            "complemento" => $this->data['complemento'],
            "fk_endereco_usuario" => $this->data['id'],
            "fk_endereco_status" => 2,
            "dt_created" => date("Y-m-d H:i:s")
        ];

        $pdoCreate = new \Helper\Create();
        $pdoCreate->exeCreate("sts_endereco_usuario", $this->data['insert_adress']);

        if ($pdoCreate->getResult() != NULL) {
            $this->setAutomobile();
        } else {

            $return = array(
                "cod" => 130,
                "msg" => 'Erro S130: Tente novamente. Se o erro persistir entre em contato com nosso atendimento',
            );

            echo json_encode($return, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    // *********************************************************************************
    // ***** INSERT DADOS VEÍCULO *****
    public function setAutomobile()
    {
        $this->data['insert_automobile'] = [
            "apelido_veiculo" => $this->data['apelido_veiculo'],
            "fabricante_veiculo" => $this->data['fabricante_veiculo'],
            "modelo_veiculo" => $this->data['modelo_veiculo'],
            "ano_veiculo" => $this->data['ano_veiculo'],
            "fabricante_pneu" => $this->data['fabricante_pneu'],
            "modelo_pneu" => $this->data['modelo_pneu'],
            "ultima_troca_pneu" => $this->data['ultima_troca_pneu'],
            "tempo_medio_troca_pneu" => $this->data['tempo_medio_troca_pneu'],
            "fk_veiculo_usuario" => $this->data['id'],
            "fk_veiculo_status" => 2,
            "dt_created" => date("Y-m-d H:i:s")
        ];

        $pdoCreate = new \Helper\Create();
        $pdoCreate->exeCreate("sts_veiculo_usuario", $this->data['insert_automobile']);

        if ($pdoCreate->getResult() != NULL) {

            $return = array(
                "cod" => 0,
                "msg" => 'Cadastro realizado com sucesso!',
            );

            echo json_encode($return, JSON_UNESCAPED_UNICODE);
            exit;
        } else {

            $return = array(
                "cod" => 140,
                "msg" => 'Erro S140: Tente novamente. Se o erro persistir entre em contato com nosso atendimento',
            );

            echo json_encode($return, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
}
