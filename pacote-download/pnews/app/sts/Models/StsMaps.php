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
            "SELECT nome, cnpj, telefone, email, coordenadas, cep, rua, numero, bairro, cidade, estado, complemento 
             FROM borracharias 
             WHERE statusAprov = :statusAprov",
            "statusAprov=2"
        );

        $this->data['result'] = $pdoSelect->getResult();

        if (isset($this->data['result']) and !empty($this->data['result'])) {
            return $this->data['result'];
        } else {
            $_SESSION["retorno"] =  "erro";
            $_SESSION["msg"] = "Ocorreu um erro inesperado, se o erro persistir entre em contato com nosso atendimento.";
            return false;
        }
    }

    // *********************************************************************************
    // ***** FUNÇÃO PARA CADASTRAR BORRACHARIA *****
    public function resgisterBorracharia()
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