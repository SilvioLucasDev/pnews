<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmLoginController
{
    private array $data;

    public function index()
    {
        $loadView = new \Core\ConfigView("sts/Views/adm-login/adm-login");
        $loadView->render();
    }

    public function validateLogin()
    {
        $this->data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $sendApp = new \Sts\Models\AdmLogin($this->data);
        $sendApp->validateLogin();
    }

    public function logout()
    {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        $this->index();
    }
}
