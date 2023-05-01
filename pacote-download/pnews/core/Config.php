<?php
//ALTERAR INFORMAÇÕES "#" DE ACORDO COM SEU PROJETO
session_start();
ob_start();

// DEFINE URL's
define('URL', 'http://localhost/pnews/');
define('URL_ASSETS', 'http://localhost/pnews/assets/');

define('CONTROLLER', 'StartMapController');
define('METHOD', 'index');

// ERRRO
define('ERROR_CONTROLLER', 'ErrorController');
define('ERROR_METHOD', 'error');

// KEY GOOGLE MAPS
define('KEY_MAPS', '#');

// CREDENCIAIS BANCO
define('DB', '');               // TIPO DE BANCO
define('HOST', '');             // HOST DB
define('DBPORT', '');           // PORTA DB
define('DBNAME', '');           // NOME DB
define('USER', '');             // USUÁRIO DB
define('PASS', '');             // SENHA DB

// pr_  -> print_r($)
// pr_t -> print_r($this->[''])
// br_  -> echo "<br>";
// err_ -> comando para exibir erros
// cl_  -> console.log()