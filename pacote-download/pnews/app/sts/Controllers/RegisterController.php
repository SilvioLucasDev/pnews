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

    public function registerUser()
    {
        $this->data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $sendApp = new \Sts\Models\StsRegister($this->data);
        $this->data['register'] = $sendApp->registerUser();

        if ($this->data['register']) {
            header("location: " . URL . "home-controller/index");
        } else {
            $this->index();
        }
    }
}
