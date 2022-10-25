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
        $sendApp = new \Sts\Models\StsProfile();
        $this->data['profile'] = $sendApp->listProfile();

        if (!empty($this->data['profile'])) {
            $loadView = new \Core\ConfigView("sts/Views/profile/profile", $this->data);
            $loadView->renderAll();
        } else {
            header("location: " . URL . "home-controller/index");
        }
    }
}
