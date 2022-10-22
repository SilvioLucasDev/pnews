<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class HomeController
{
    private array $data;

    public function index()
    {
        $loadView = new \Core\ConfigView("sts/Views/home/home");
        $loadView->renderAll();
    }
}
