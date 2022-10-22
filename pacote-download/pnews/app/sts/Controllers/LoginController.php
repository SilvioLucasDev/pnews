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
        $loadView = new \Core\ConfigView("sts/Views/login/login");
        $loadView->render();
    }

    public function validateLogin()
    {
        $this->data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $sendApp = new \Sts\Models\StsLogin($this->data);
        $this->data['login'] = $sendApp->validateLogin();

        if ($this->data['login']) {
            header("location: " . URL . "home-controller/index");
        } else {
            $this->index();
        }
    }
}
