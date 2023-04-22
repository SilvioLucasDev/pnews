<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class StsStartMap
{
    private $data;

    public function __construct($data = NULL)
    {
        $this->data = $data;
    }

    // ********************************************************************
    // FUNÇÃO PARA PEGAR BORRACHARIAS CADASTRADAS
    public function getBorracharias()
    {
        $pdoSelect = new \Helper\Read();
        $pdoSelect->fullRead(
            "SELECT borracharia.nome, borracharia.cnpj, borracharia.email,
                    telefone.telefone,
                    endereco.coords_lat, endereco.coords_lat, endereco.coords_lng, endereco.cep, endereco.cidade, endereco.estado, endereco.bairro, endereco.rua, endereco.numero, endereco.complemento
            FROM sts_borracharia AS borracharia 
            LEFT JOIN sts_telefone_borracharia AS telefone ON telefone.fk_telefone_borracharia = borracharia.id_borracharia 
            LEFT JOIN sts_endereco_borracharia AS endereco ON endereco.fk_endereco_borracharia = borracharia.id_borracharia
            WHERE fk_borracharia_status = :status",
            "status=2"
        );

        $this->data['result'] = $pdoSelect->getResult();

        if (isset($this->data['result']) or !empty($this->data['result'])) {

            $f = new \Helper\Format;
            $this->data['result'][0]['cnpj'] = $f->maskAllData($this->data['result'][0]['cnpj'], 'cnpj');
            $this->data['result'][0]['telefone'] = $f->maskAllData($this->data['result'][0]['telefone'], 'tel');
            $this->data['result'][0]['cep'] = $f->maskAllData($this->data['result'][0]['cep'], 'cep');

            $return = array(
                "cod" => 0,
                "msg" => 'Pesquisa realizada com sucesso!',
                "res" => $this->data['result']
            );

            echo json_encode($return, JSON_UNESCAPED_UNICODE);
            exit;
        } else {
            $return = array(
                "cod" => 500,
                "msg" => 'Erro S500: Falha ao carregar borracharias. Se o erro persistir entre em contato com nosso atendimento.',
            );

            echo json_encode($return, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
}
