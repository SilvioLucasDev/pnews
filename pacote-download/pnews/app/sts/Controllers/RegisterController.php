<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class RegisterController
{
    private array $data;

    public function index()
    {
        $loadView = new \Core\ConfigView("sts/Views/register/register");
        $loadView->render();
    }
}
