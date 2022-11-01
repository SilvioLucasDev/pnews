<?php

namespace Helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class FormatConfig
{
    // ********************************************************************
    // REMOVE CARACTERES ESPECIAIS E ACENTOS DA URL
    protected function clearUrl($url)
    {
        $url = strip_tags($url); // REMOVE TAGS HTML EX: <a></a>
        $url = trim($url);       // REMOVE ESPAÇOS EM BRANCO
        $url = rtrim($url, "/"); // REMOVE "/" NO FINAL DA URL

        $search = array('ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ');
        $replace = array('aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------------------------------');
        return $url = strtr(utf8_decode($url), utf8_decode($search[0]), $replace[0]);
    }

    // ********************************************************************
    // FORMATA CONTROLLER
    protected function formatController($controller)
    {                                                            //"error-controler";
        $controller = str_replace("-", " ", $controller);        //"error controler"
        $controller = ucwords($controller);                      //"Error Controller"
        return $controller = str_replace(" ", "", $controller);  //"ErrorController"
    }

    // ********************************************************************
    // FORMATA MÉTODO
    protected function formatMethod($method)
    {                                             //"error-controler";
        $method = str_replace("-", " ", $method); //"error controler"
        $method = ucwords($method);               //"Error Controller"
        $method = str_replace(" ", "", $method);  //"ErrorController"
        return $method = lcfirst($method);        //"errorController"
    }

    // ********************************************************************
    // FORMATA PASTA E ARQUIVO DA VIEW
    protected function formatView($url)
    {                                                       // "sts/Views/cad-file/cad-user"
        $url = explode("/", $url);                          // [0] => sts [1] => Views [2] => cad-file [3] => cad-user
        $lastValue = str_replace("-", " ", end($url));      // cad user
        $lastKey = key($url);                               // 3
        $lastValue = ucwords($lastValue);                   // Cad User
        $lastValue = str_replace(" ", "", $lastValue);      // CadUser
        $lastValue = lcfirst($lastValue);                   // cadUser
        $url[$lastKey] = $lastValue;                        // [0] => sts [1] => Views [2] => cad-file [3] => cadUser 

        $penultValue = str_replace("-", " ", prev($url));   // cad file
        $penultKey = key($url);                             // 2
        $penultValue = ucwords($penultValue);               // Cad File
        $penultValue = str_replace(" ", "", $penultValue);  // CadFile
        $penultValue = lcfirst($penultValue);               // cadFile
        $url[$penultKey] = $penultValue;                    // [0] => sts [1] => Views [2] => cadFile [3] => cadUser 

        return $url = implode("/", $url);                   // "sts/Views/cadFile/cadUser"
    }
}
