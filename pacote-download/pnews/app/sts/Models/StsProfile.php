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

    // ********************************************************************
    // SELECT TODOS DADOS DO USUÁRIO
    public function getProfile()
    {
        $pdoSelect = new \Helper\Read();
        $pdoSelect->fullRead(
            "SELECT usuario.nome, usuario.sobrenome, usuario.cpf, usuario.dt_nascimento, usuario.email,
                    telefone.telefone,
                    endereco.cep, endereco.cidade, endereco.estado, endereco.bairro, endereco.rua, endereco.numero, endereco.complemento,
                    veiculo.apelido_veiculo, veiculo.fabricante_veiculo, veiculo.modelo_veiculo, veiculo.ano_veiculo, veiculo.modelo_pneu_dianteiro,
                    veiculo.modelo_pneu_traseiro, veiculo.fabricante_pneu, veiculo.ultima_troca_pneu, veiculo.tempo_medio_troca_pneu
             FROM sts_usuario AS usuario 
             LEFT JOIN sts_telefone_usuario AS telefone ON telefone.fk_telefone_usuario = usuario.id_usuario 
             LEFT JOIN sts_endereco_usuario AS endereco ON endereco.fk_endereco_usuario = usuario.id_usuario 
             LEFT JOIN sts_veiculo_usuario AS veiculo ON veiculo.fk_veiculo_usuario = usuario.id_usuario 
             WHERE usuario.id_usuario = :id",
            "id={$_SESSION['id_usuario']}"
        );

        $this->data['result'] = $pdoSelect->getResult();

        if (isset($this->data['result']) or !empty($this->data['result'])) {

            $return = array(
                "cod" => 0,
                "msg" => 'Pesquisa realizada com sucesso!',
                "res" => $this->data['result'][0]
            );

            echo json_encode($return, JSON_UNESCAPED_UNICODE);
            exit;
        } else {
            $return = array(
                "cod" => 300,
                "msg" => 'Erro S300: Falha ao carregar dados. Se o erro persistir entre em contato com nosso atendimento.',
            );

            echo json_encode($return, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
}
