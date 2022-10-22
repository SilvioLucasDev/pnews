<?php

namespace Helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class FormatConfig
{
    protected function clearUrl($url)
    {
        $url = strip_tags($url); // REMOVE TAGS HTML EX: <a></a>
        $url = trim($url);       // REMOVE ESPAÇOS EM BRANCO
        $url = rtrim($url, "/"); // REMOVE "/" NO FINAL DA URL

        $search = array('ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ');
        $replace = array('aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------------------------------');
        return $url = strtr(utf8_decode($url), utf8_decode($search[0]), $replace[0]);
    }

    protected function formatController($controller)
    {                                                            //"error-controler";
        $controller = str_replace("-", " ", $controller);        //"error controler"
        $controller = ucwords($controller);                      //"Error Controller"
        return $controller = str_replace(" ", "", $controller);  //"ErrorController"
    }

    protected function formatMethod($method)
    {                                             //"error-controler";
        $method = str_replace("-", " ", $method); //"error controler"
        $method = ucwords($method);               //"Error Controller"
        $method = str_replace(" ", "", $method);  //"ErrorController"
        return $method = lcfirst($method);        //"errorController"
    }

    public function formatView($url)
    {                                                   // "sts/Views/error/error-404"
        $url = explode("/", $url);                      // [0] => sts [1] => Views [2] => error [3] => error-404
        $lastValue = str_replace("-", " ", end($url));  // error 404
        $lastKey = key($url);                           // 3
        $lastValue = ucwords($lastValue);               // Error 404
        $lastValue = str_replace(" ", "", $lastValue);  // Error404
        $lastValue = lcfirst($lastValue);               // error404
        $url[$lastKey] = $lastValue;                    // [0] => sts [1] => Views [2] => error [3] => error404               
        return $url = implode("/", $url);               // "sts/Views/error/error404"
    }
}
