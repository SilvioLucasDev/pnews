<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ErrorController
{
    public function error($code = NULL)
    {
        switch ($code) {

            case 404:
                $loadView = new \Core\ConfigView("sts/Views/error/error-404");
                $loadView->render();
                break;

            default:
                $loadView = new \Core\ConfigView("sts/Views/error/error-default");
                $loadView->render();
                break;
        }
    }
}

