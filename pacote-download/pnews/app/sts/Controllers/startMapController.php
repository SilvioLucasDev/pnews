<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class StartMapController
{
    public function index()
    {
        $loadView = new \Core\ConfigView("sts/Views/start-map/start-map");
        $loadView->renderStartMap();
    }

    public function getBorracharias()
    {
        $sendApp = new \Sts\Models\StsStartMap();
        $sendApp->getBorracharias();
    }
}
