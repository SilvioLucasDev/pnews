<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class StsMaps
{
    private $data;

    public function __construct($data = NULL)
    {
        $this->data = $data;
    }

    // *********************************************************************************
    // ***** FUNÇÃO PARA SELECIONAR BORRACHARIAS CADASTRADAS *****
    public function getBorracharias()
    {
        $pdoSelect = new \Helper\Read();
        $pdoSelect->fullRead(
            "SELECT borracharia.nome, borracharia.cnpj, borracharia.email,
                    telefone.telefone,
                    endereco.coordenadas, endereco.cep, endereco.cidade, endereco.estado, endereco.bairro, endereco.rua, endereco.numero, endereco.complemento
            FROM sts_borracharia AS borracharia 
            LEFT JOIN sts_telefone_borracharia AS telefone ON telefone.fk_telefone_borracharia = borracharia.id_borracharia 
            LEFT JOIN sts_endereco_borracharia AS endereco ON endereco.fk_endereco_borracharia = borracharia.id_borracharia
            WHERE fk_borracharia_status = :status",
            "status=2"
        );

        $this->data['result'] = $pdoSelect->getResult();

        if (isset($this->data['result']) and !empty($this->data['result'])) {

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

    // *********************************************************************************
    // ***** FUNÇÃO PARA CADASTRAR BORRACHARIA *****
    public function cadBorracharia()
    {
        $this->data['insert'] = [
            "nome" => $this->data['nome'],
            "telefone" => $this->data['telefone'],
            "email" => $this->data['email'], // TRATAR E-MAIL COM A UTILS
            "coordenadas" => $this->formatCoords($this->data['inputCoords']),
            "statusAprov" => 1
        ];

        $pdoCreate = new \Helper\Create();
        $pdoCreate->exeCreate("borracharias", $this->data['insert']);

        if ($pdoCreate->getResult() != NULL) {
            $_SESSION["retorno"] =  "sucesso";
            $_SESSION["msg"] = "Suceso! A borracharia cadastrada passará por um processo de aprovação que irá durar até 72horas úteis.";
            return true;
        } else {
            $_SESSION["retorno"] =  "erro";
            $_SESSION["msg"] = "Erro ao cadastrar nova borracharia!";
            return false;
        }
    }

    // *********************************************************************************
    // ***** FUNÇÃO PARA FORMATAR COORDENADAS *****
    public function formatCoords($string)
    {
        $search = array("(", ")");
        $replace = array("", "");
        $string = str_replace($search, $replace, $string);

        $coords = explode(" ", $string);
        return "{lat: " . $coords[0] . "lng: " . $coords[1] . "}";
    }
}
