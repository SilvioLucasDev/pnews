<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class MapsController
{
    private array $data;

    public function index()
    {
        $loadView = new \Core\ConfigView("sts/Views/maps/maps");
        $loadView->renderAll();
    }

    public function getBorracharias()
    {
        $sendApp = new \Sts\Models\StsMaps();
        $this->data['maps'] = $sendApp->getBorracharias();
    }

    public function cadBorracharia()
    {
        $this->data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $sendApp = new \Sts\Models\StsMaps($this->data);
        $sendApp->cadBorracharia();
    }
}
