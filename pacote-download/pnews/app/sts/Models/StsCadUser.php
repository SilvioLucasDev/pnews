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

    // ********************************************************************
    // VALIDA SE OS CAMPOS ESTÃO CERTO E SE O E-MAIL OU CPF JÁ EXISTE
    public function cadUser()
    {
        $u = new \Helper\Utils;
        if ($u->valString($this->data['nome'], 30) and $u->valString($this->data['sobrenome'], 50) and $u->valNumber($this->data['cpf'], 14) and $u->valNumberTwo($this->data['dt_nascimento'], 10) and $u->valPhone($this->data['telefone']) and $u->valEmail($this->data['email']) and $u->valPassword($this->data['senha'])) {

            if ($u->valNumber($this->data['cep'], 10) and $u->valString($this->data['rua'], 70) and $u->valString($this->data['bairro'], 70) and $u->valNumber($this->data['numero'], 10, '<=') and $u->valMinChar($this->data['complemento']) and $u->valString($this->data['cidade'], 50) and $u->valEmpty($this->data['estado'])) {

                if ($u->vaEmptyMinChar($this->data['apelido_veiculo']) and $u->valString($this->data['fabricante_veiculo'], 30) and $u->vaEmptyMinChar($this->data['modelo_veiculo']) and $u->valNumber($this->data['ano_veiculo'], 4)) {

                    if ($u->valNumberTwo($this->data['modelo_pneu_dianteiro'], 9) and $u->valNumberTwo($this->data['modelo_pneu_traseiro'], 9) and $u->valString($this->data['fabricante_pneu'], 30) and $u->valEmpty($this->data['ultima_troca_pneu']) and $u->valEmpty($this->data['tempo_medio_troca_pneu'])) {

                        $f = new \Helper\Format;
                        $this->data['cpf'] = $f->onlyNumbers($this->data['cpf']);
                        $this->data['dt_nascimento'] = $f->formatDateUs($this->data['dt_nascimento']);
                        $this->data['telefone'] = $f->onlyNumbers($this->data['telefone']);
                        $this->data['cep'] = $f->onlyNumbers($this->data['cep']);
                        $this->data['numero'] = $f->onlyNumbers($this->data['numero']);
                        $this->data['ano_veiculo'] = $f->onlyNumbers($this->data['ano_veiculo']);
                        $this->data['modelo_pneu_dianteiro'] = $f->onlyNumbers($this->data['modelo_pneu_dianteiro']);
                        $this->data['modelo_pneu_traseiro'] = $f->onlyNumbers($this->data['modelo_pneu_traseiro']);

                        $pdoSelect = new \Helper\Read();
                        $pdoSelect->fullRead(
                            "SELECT email, cpf 
                             FROM sts_usuario 
                             WHERE cpf = :cpf OR email = :email",
                            "cpf={$this->data['cpf']}&email={$this->data['email']}"
                        );

                        $this->data['result'] = $pdoSelect->getResult();

                        if (!isset($this->data['result'][0]) or empty($this->data['result'][0])) {
                            $this->setUser();
                        } else {

                            $return = array(
                                "cod" => 100,
                                "msg" => 'Erro S100: E-mail e ou CPF já cadastrado no sistema!',
                            );

                            echo json_encode($return, JSON_UNESCAPED_UNICODE);
                            exit;
                        }
                    } else {
                        $return = array(
                            "cod" => 110,
                            "msg" => 'Erro S110: Dados do pneu inválidos, verifique novamente.',
                        );

                        echo json_encode($return, JSON_UNESCAPED_UNICODE);
                        exit;
                    }
                } else {
                    $return = array(
                        "cod" => 120,
                        "msg" => 'Erro S120: Dados do veículo inválidos, verifique novamente.',
                    );

                    echo json_encode($return, JSON_UNESCAPED_UNICODE);
                    exit;
                }
            } else {
                $return = array(
                    "cod" => 130,
                    "msg" => 'Erro S130: Dados de endereço inválidos, verifique novamente.',
                );

                echo json_encode($return, JSON_UNESCAPED_UNICODE);
                exit;
            }
        } else {
            $return = array(
                "cod" => 140,
                "msg" => 'Erro S140: Dados pessoais inválidos, verifique novamente.',
            );

            echo json_encode($return, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    // ********************************************************************
    // INSERT DADOS USUÁRIO
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

        if ($pdoCreate->getResult() != NULL) {
            $this->data['id'] = $pdoCreate->getResult();
            $this->setPhone();
        } else {
            $return = array(
                "cod" => 150,
                "msg" => 'Erro S150: Tente novamente. Se o erro persistir entre em contato com nosso atendimento',
            );

            echo json_encode($return, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    // ********************************************************************
    // INSERT DADOS TELEFONE 
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
                "cod" => 160,
                "msg" => 'Erro S160: Tente novamente. Se o erro persistir entre em contato com nosso atendimento',
            );

            echo json_encode($return, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    // ********************************************************************
    // INSERT DADOS ENDERECO
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
                "cod" => 170,
                "msg" => 'Erro S170: Tente novamente. Se o erro persistir entre em contato com nosso atendimento',
            );

            echo json_encode($return, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    // ********************************************************************
    // INSERT DADOS VEÍCULO
    public function setAutomobile()
    {
        $this->data['insert_automobile'] = [
            "apelido_veiculo" => $this->data['apelido_veiculo'],
            "fabricante_veiculo" => $this->data['fabricante_veiculo'],
            "modelo_veiculo" => $this->data['modelo_veiculo'],
            "ano_veiculo" => $this->data['ano_veiculo'],
            "modelo_pneu_dianteiro" => $this->data['modelo_pneu_dianteiro'],
            "modelo_pneu_traseiro" => $this->data['modelo_pneu_traseiro'],
            "fabricante_pneu" => $this->data['fabricante_pneu'],
            "ultima_troca_pneu" => $this->data['ultima_troca_pneu'],
            "tempo_medio_troca_pneu" => $this->data['tempo_medio_troca_pneu'],
            "fk_veiculo_usuario" => $this->data['id'],
            "fk_veiculo_status" => 2,
            "dt_created" => date("Y-m-d H:i:s")
        ];

        $pdoCreate = new \Helper\Create();
        $pdoCreate->exeCreate("sts_veiculo_usuario", $this->data['insert_automobile']);

        if ($pdoCreate->getResult() != NULL) {
            $_SESSION['id_usuario'] = $this->data['id'];

            $return = array(
                "cod" => 0,
                "msg" => 'Cadastro realizado com sucesso!',
            );

            echo json_encode($return, JSON_UNESCAPED_UNICODE);
            exit;
        } else {

            $return = array(
                "cod" => 180,
                "msg" => 'Erro S180: Tente novamente. Se o erro persistir entre em contato com nosso atendimento',
            );

            echo json_encode($return, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
}
