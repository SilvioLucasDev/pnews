<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmValidateRegistrationController
{
    public function __construct()
    {
        $u = new \Helper\Utils;
        $u->valSessionAdm();
    }
    
    public function index()
    {
        $loadView = new \Core\ConfigView("sts/Views/adm-validate-registration/adm-validate-registration");
        $loadView->admRenderAll();
    }

    public function getRegisters()
    {        
        $sendApp = new \Sts\Models\AdmValidateRegistration();
        $sendApp->getRegisters();
    }

    public function refuse()
    {           
        $url = $_SERVER['REQUEST_URI'];
        $url_parts = parse_url($url);
        $path_parts = explode('/', $url_parts['path']);
        $id = end($path_parts);

        $sendApp = new \Sts\Models\AdmValidateRegistration();
        $sendApp->refuseRegister($id);
    }

    public function accept()
    {        
        $url = $_SERVER['REQUEST_URI'];
        $url_parts = parse_url($url);
        $path_parts = explode('/', $url_parts['path']);
        $id = end($path_parts);

        $sendApp = new \Sts\Models\AdmValidateRegistration();
        $sendApp->acceptRegister($id);
    }
}
