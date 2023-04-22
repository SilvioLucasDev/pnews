<?php

namespace Core;

use Helper\FormatConfig;

class ConfigView extends FormatConfig
{
    private $name;
    private $data;

    public function __construct($name, array $data = NULL)
    {
        $this->name = (string) $this->formatView($name);
        $this->data = $data;
    }

    // RENDERIZA TODOS OS INCLUDES
    public function renderAll()
    {
        if (file_exists('app/' . $this->name . '.phtml')) {
            include 'app/sts/Views/include/header.phtml';
            include 'app/sts/Views/include/navbar.phtml';
            include 'app/' . $this->name . '.phtml';
            include 'app/sts/Views/include/footer.phtml';
        } else {
            $this->locationError();
        }
    }

    // NÃO RENDERIZA TODOS OS INCLUDES
    public function render()
    {
        if (file_exists('app/' . $this->name . '.phtml')) {
            include 'app/sts/Views/include/header.phtml';
            include 'app/' . $this->name . '.phtml';
            include 'app/sts/Views/include/footer.phtml';
        } else {
            $this->locationError();
        }
    }

    // RENDERIZA A NAVBAR DO MAPA INICIAL 
    public function renderStartMap()
    {
        if (file_exists('app/' . $this->name . '.phtml')) {
            include 'app/sts/Views/include/header.phtml';
            include 'app/sts/Views/include/startMap/navbar.phtml';
            include 'app/' . $this->name . '.phtml';
            include 'app/sts/Views/include/footer.phtml';
        } else {
            $this->locationError();
        }
    }

    // RENDERIZA A NAVBAR DO ADM
    public function admRenderAll()
    {
        if (file_exists('app/' . $this->name . '.phtml')) {
            include 'app/sts/Views/include/header.phtml';
            include 'app/sts/Views/include/adm/navbar.phtml';
            include 'app/' . $this->name . '.phtml';
            include 'app/sts/Views/include/footer.phtml';
        } else {
            $this->locationError();
        }
    }

    // REDIRECIONA PARA A PÁGINA DE ERRO DEFAULT
    public function locationError()
    {
        $name = explode("/", $this->name);

        $u = new \Helper\Utils;
        $u->errorDefault(
            'Erro C200: Falha ao carregar a Página: <strong>'. strtoupper(end($name)) .'</strong>',
            'Erro',
            'Voltar',
            'home-controller/index',
            'N'
        );
        exit;
    }
}
