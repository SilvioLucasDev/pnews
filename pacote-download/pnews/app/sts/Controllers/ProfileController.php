<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ProfileController
{
    public function index()
    {
        $loadView = new \Core\ConfigView("sts/Views/profile/profile");
        $loadView->renderAll();
    }

    public function getProfile()
    {        
        $sendApp = new \Sts\Models\StsProfile();
        $sendApp->getProfile();
    }
}
