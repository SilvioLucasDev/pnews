<?php
    //ALTERAR INFORMAÇÕES "#" DE ACORDO COM SEU PROJETO
    session_start();
    ob_start();

    // DEFINE URL's
    define('URL', 'http://localhost/#/');
    define('URL_ASSETS', 'http://localhost/#/assets/');

    define('CONTROLLER', 'LoginController');
    define('METHOD', 'index');

    // ERRRO
    define('ERROR_CONTROLLER', 'ErrorController');
    define('ERROR_METHOD', 'error');

    // KEY GOOGLE MAPS
    define('KEY_MAPS', '#');

    // CREDENCIAIS BANCO
    define('DB', '#');          // TIPO DE BANCO
    define('HOST', '#');    // HOST DB
    define('DBPORT', '#');         // PORTA DB
    define('DBNAME', '#');  // NOME DB
    define('USER', '3');         // USUÁRIO DB
    define('PASS', '');             // SENHA DB

    // pr_  -> print_r($)
    // pr_t -> print_r($this->[''])
    // br_  -> echo "<br>";
    // err_ -> comando para exibir erros
    // cl_  -> console.log()