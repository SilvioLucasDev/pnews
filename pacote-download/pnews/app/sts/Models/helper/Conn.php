<?php

namespace Helper;

use PDO;
use PDOException;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

abstract class Conn
{
    private string $db = DB;
    private string $host = HOST;
    private int|string $port = DBPORT;
    private string $bdName = DBNAME;
    private string $user = USER;
    private string $pass = PASS;
    private object $connect;

    public function connectDb()
    {
        try {
            $this->connect = new PDO($this->db . ':host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->bdName, $this->user, $this->pass);

            return $this->connect;

        } catch (PDOException $err) {
            die('Erro C100: Por favor tente novamente. Caso o problema persista entre em contato com o nosso atendimento.');
        }
    }
}
