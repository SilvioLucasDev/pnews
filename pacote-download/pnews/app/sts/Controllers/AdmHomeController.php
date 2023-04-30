<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmHomeController
{
    public function __construct()
    {
        $u = new \Helper\Utils;
        $u->valSession();
    }

    public function index()
    {
        $loadView = new \Core\ConfigView("sts/Views/adm-home/adm-home");
        $loadView->admRenderAll();
    }
}
