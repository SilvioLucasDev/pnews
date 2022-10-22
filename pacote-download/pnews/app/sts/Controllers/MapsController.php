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
}
