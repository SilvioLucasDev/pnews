<?php

namespace Helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Log
{
    private $logData;  // DADOS PARA LOG
    private $filePath; // CAMINHO DO ARQUIVO
    private $fileName; // NOME DO ARQUIVO
    private $fileType; // TIPO DO ARQUIVO .JSON

    public function __construct($logData, $filePath, $fileName, $fileType)
    {
        $this->logData = $logData;
        $this->filePath = $filePath;
        $this->fileName = $fileName;
        $this->fileType = $fileType;
    }

    public function createLog()
    {
        // DEFINE O CAMINHO
        $filePath = 'assets/json/audit/' . $this->filePath;

        // VERIFICA SE O CAMINHO JÁ EXISTE E SE NÃO ELE CRIA
        if (!file_exists($filePath)) {
            mkdir($filePath, 0777, true);
        }

        // DEFINE O NOME E TIPO DO AQUIVO A SER CRIADO
        $filePath .=  '/' . $this->fileName . '.' . $this->fileType;

        // VERIFICA SE É UM ARQUIVO JSON E SE FOR CONVERTE EM UM
        $this->logData = $this->fileType == "json" ? json_encode($this->logData, true) :  $this->logData;

        //ABRE O ARQUIVO E GRAVA AS NOVAS INFORMAÇÕES
        file_put_contents($filePath, $this->logData, FILE_APPEND | LOCK_EX);
    }
}
