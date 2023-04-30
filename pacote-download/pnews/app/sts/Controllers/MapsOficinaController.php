<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class MapsOficinaController
{
    private array $data;

    public function __construct()
    {
        $u = new \Helper\Utils;
        $u->valSession();
    }

    public function index()
    {
        $loadView = new \Core\ConfigView("sts/Views/maps-oficina/maps-oficina");
        $loadView->renderAll();
    }

    public function getOficinas()
    {
        $sendApp = new \Sts\Models\StsMaps();
        $sendApp->getEstablishment(2);
    }

    public function cadOficina()
    {
        $this->data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $sendApp = new \Sts\Models\StsMaps($this->data);
        $sendApp->cadEstablishment();
    }
}
