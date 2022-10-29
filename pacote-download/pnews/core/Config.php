<?php
    //ALTERAR INFORMAÇÕES "#" DE ACORDO COM SEU PROJETO

    // DEFINE URL's
    define('URL', 'http://localhost/pnews/');
    define('URL_ASSETS', 'http://localhost/pnews/assets/');

    define('CONTROLLER', 'LoginController');
    define('METHOD', 'index');

    // ERRRO
    define('ERROR_CONTROLLER', 'ErrorController');
    define('ERROR_METHOD', 'error');

    // KEY GOOGLE MAPS
    define('KEY_MAPS', 'AIzaSyB9IWlEU_CZQqtyGqSr-lvN25n43fW6f2g');

    // CREDENCIAIS BANCO
    define('DB', 'mysql');          // TIPO DE BANCO
    define('HOST', 'localhost');    // HOST DB
    define('DBPORT', 3307);         // PORTA DB
    define('DBNAME', 'sts_pnews');  // NOME DB
    define('USER', 'root');         // USUÁRIO DB
    define('PASS', '');             // SENHA DB

    // pr_  -> print_r($)
    // pr_t -> print_r($this->[''])
    // br_  -> echo "<br>";
    // err_ -> comando para exibir erros
    // cl_  -> console.log()