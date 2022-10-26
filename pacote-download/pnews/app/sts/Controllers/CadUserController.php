<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class CadUserController
{
    private array $data;

    public function index()
    {
        $loadView = new \Core\ConfigView("sts/Views/cad-user/cad-user");
        $loadView->render();
    }

    public function cadUser()
    {
        $this->data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $sendApp = new \Sts\Models\StsCadUser($this->data);
        $sendApp->cadUser();
    }
}
