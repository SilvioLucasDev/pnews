<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class PasswordController
{
    private array $data;

    public function index()
    {
        $this->data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $sendApp = new \Sts\Models\StsPassword($this->data);
        $sendApp->alterPassword();
    }
}
