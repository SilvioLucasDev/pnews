<?php
    //ALTERAR INFORMAÇÕES "#" DE ACORDO COM SEU PROJETO

    // DEFINE URL's
    define('URL', 'http://localhost/pnews/');
    define('URLASSETS', 'http://localhost/pnews/assets/');

    define('CONTROLLER', 'LoginController');
    define('METHOD', 'index');

    // ERRRO
    define('ERRORCONTROLLER', 'ErrorController');
    define('ERRORMETHOD', 'error');

    // CREDENCIAIS BANCO
    define('DB', 'mysql');          // TIPO DE BANCO
    define('HOST', 'localhost');    // HOST DB
    define('DBPORT', 3307);         // PORTA DB
    define('DBNAME', 'sts_pnews');      // NOME DB
    define('USER', 'root');         // USUÁRIO DB
    define('PASS', '');             // SENHA DB

    // EXIBIR ERROS PHP
    ini_set("display_errors", 1);
    ini_set("display_startup_erros", 1);
    error_reporting(E_ALL);

    // DESCRIÇÃO DE ABREVIATURA PARA CÓDIGOS DE ERRO
    // "C" - Erros de configuração padrão -> Conexão DB, ConfigView etc...
    // "S" - Erros de páginas dinâmicas -> Formulário = Campo errado, formato errado etc..
