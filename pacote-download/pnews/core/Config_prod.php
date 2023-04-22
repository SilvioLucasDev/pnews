<?php
    //ALTERAR INFORMAÇÕES "#" DE ACORDO COM SEU PROJETO
    session_start();
    ob_start();

    // DEFINE URL's
    define('URL', 'https://www.pnews.store/');
    define('URL_ASSETS', 'https://www.pnews.store/assets/');

    define('CONTROLLER', 'StartMapController');
    define('METHOD', 'index');

    // ERRRO
    define('ERROR_CONTROLLER', 'ErrorController');
    define('ERROR_METHOD', 'error');

    // KEY GOOGLE MAPS
    define('KEY_MAPS', 'AIzaSyB9IWlEU_CZQqtyGqSr-lvN25n43fW6f2g');

    // CREDENCIAIS BANCO
    define('DB', 'mysql');                      // TIPO DE BANCO
    define('HOST', 'ns1012.hostgator.com.br');  // HOST DB
    define('DBNAME', 'pnewss45_sts_pnews');     // NOME DB
    define('USER', 'pnewss45_sts_pnews');       // USUÁRIO DB
    define('PASS', '0%dg%&JyYBeF');             // SENHA DB

    // pr_  -> print_r($)
    // pr_t -> print_r($this->[''])
    // br_  -> echo "<br>";
    // err_ -> comando para exibir erros
    // cl_  -> console.log()