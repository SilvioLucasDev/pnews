<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class HomeController
{
    public function __construct()
    {
        $u = new \Helper\Utils;
        $u->valSession();
    }

    public function index()
    {
        $loadView = new \Core\ConfigView("sts/Views/home/home");
        $loadView->renderAll();
    }
}
