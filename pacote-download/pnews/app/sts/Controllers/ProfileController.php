<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ProfileController
{
    private array $data;

    public function index()
    {
        $loadView = new \Core\ConfigView("sts/Views/profile/profile");
        $loadView->renderAll();
    }
}
