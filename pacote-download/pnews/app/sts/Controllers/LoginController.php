<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class LoginController
{
    private array $data;

    public function index()
    {
        // $sendApp = new \Sts\Models\StsLogin();
        // $this->data['login'] = $sendApp->list();

        // $loadView = new \Core\ConfigView("sts/Views/login/login", $this->data);
        // $loadView->renderAll();

        $loadView = new \Core\ConfigView("sts/Views/login/login");
        $loadView->render();
    }
}
