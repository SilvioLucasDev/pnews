<?php

namespace Core;

use Helper\FormatConfig;

class ConfigController extends FormatConfig
{
    private string $url;
    private array  $urlArray; // URLCONJUNTO
    private string $urlController;
    private string $urlMethod;
    private string $urlParameter;
    private string $class;

    public function __construct()
    {
        //VERIFICA SE A URL ESTÁ SETADA
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            //PEGA OS PARÂMETROS DA URL
            $this->url = $this->clearUrl(filter_input(INPUT_GET, 'url', FILTER_DEFAULT));
            $this->urlArray = explode("/", $this->url);

            //VERIFICA SE O USUÁRIO SETOU A CONTROLLER, MÉTODO E/OU PARÂMETRO
            if (isset($this->urlArray[0]) && isset($this->urlArray[1])) {
                $this->urlController = $this->formatController($this->urlArray[0]);
                $this->urlMethod = $this->formatMethod($this->urlArray[1]);
                $this->urlParameter = isset($this->urlArray[2]) ? $this->urlArray[2] : "";

            } else {
                $this->urlController = $this->formatController(ERRORCONTROLLER);
                $this->urlMethod = $this->formatMethod(ERRORMETHOD);
                $this->urlParameter = "";
            }

        } else {

            $this->urlController = $this->formatController(CONTROLLER);
            $this->urlMethod = $this->formatMethod(METHOD);
            $this->urlParameter = "";
        }

        // var_dump($this->urlArray[2]);
        // echo "URL: {$this->url} <br>";
        // echo "Controller: {$this->urlController} <br>";
        // echo "Metodo: {$this->urlMethod} <br>";
    }

    public function loadPage()
    {
        $this->class = "\\Sts\\Controllers\\" . $this->urlController;

        if (class_exists($this->class)) {
            $this->loadMethod();
        } else {
            $this->urlController = $this->formatController(ERRORCONTROLLER);
            $this->urlMethod = $this->formatMethod(ERRORMETHOD);
            $this->loadPage();
        }
    }

    public function loadMethod()
    {
        $loadClass = new $this->class();

        if (method_exists($loadClass, $this->urlMethod)) {

            if ($this->urlParameter != "") {

                $loadClass->{$this->urlMethod}($this->urlParameter);
            } else {
                $loadClass->{$this->urlMethod}();
            }
        } else {
            $this->urlController = $this->formatController(ERRORCONTROLLER);
            $this->urlMethod = $this->formatMethod(ERRORMETHOD);
            $this->loadPage();
        }
    }
}
