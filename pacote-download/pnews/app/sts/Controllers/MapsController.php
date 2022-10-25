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
        $sendApp = new \Sts\Models\StsMaps();
        $this->data['maps'] = $sendApp->getBorracharias();

        $loadView = new \Core\ConfigView("sts/Views/maps/maps", $this->data);
        $loadView->renderAll();
    }

    public function resgisterBorracharia()
    {
        $this->data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $sendApp = new \Sts\Models\StsMaps($this->data);
        $this->data['maps'] = $sendApp->resgisterBorracharia();

        $this->index();
    }
}
