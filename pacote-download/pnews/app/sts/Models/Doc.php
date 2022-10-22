<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Doc
{
    private array $data;

    public function list()
    {
        session_start();

        // *********************************************************************************
        // ***** TESTE DA CLASSE FORMATCONFING *****
        // $f = new \Helper\FormatConfig();

        // $string = "sts/Views/error/error-404";
        // var_dump($f->formatView($string));

        // *********************************************************************************
        // ***** TESTE DA CLASSE FORMAT *****
        // $f = new \Helper\Format();

        // $string = "11222333444455";
        // echo "STRING: " . $string . "<br><br>";

        // $number = 112222333444455;
        // echo "NUMBER: " . $number . "<br><br>";

        // var_dump($f->docMask($string, "cnpj"));

        // echo "<br>";

        // var_dump($f->docMask("42949622836"));


        // *********************************************************************************
        // ***** CHAMA A FUNÇÃO DE LOG *****
        // $this->testeLog();


        // *********************************************************************************
        // ***** CÓDIGO PARA REALIZAR SELECT *****
        $pdoSelect = new \Helper\Read();
        $pdoSelect->fullRead("SELECT id, nome, cpf FROM usuarios WHERE id=:id", "id=63");
        return $pdoSelect->getResult();

        // $result = $pdoSelect->getResult();
        // var_dump($result);

        // echo "<br><hr><br>";

        // $result = $pdoSelect->sqlResult();
        // var_dump($result);
        // exit;

        // *********************************************************************************
        // ***** CÓDIGO PARA REALIZAR INSERT *****
        // $this->data['insert'] = [
        //     "nome" => 'Teste Create',
        //     "cpf" => '111.111.111-36',
        // ];

        // $pdoCreate = new \Helper\Create();
        // $pdoCreate->exeCreate("usuarios", $this->data['insert']);
        // $result = $pdoCreate->getResult();
        // var_dump($result);

        // echo "<br><hr><br>";

        // $result = $pdoCreate->sqlResult();
        // var_dump($result);
        // exit;


        // *********************************************************************************
        // ***** CÓDIGO PARA REALIZAR UPDATE *****
        // $this->data['update'] = [
        //     "nome" => 'Teste Update',
        //     "cpf" => '111.111.111-36',
        // ];

        // $pdoUpdate = new \Helper\Update();
        // $pdoUpdate->exeUpdate(
        //     "usuarios", 
        //     $this->data['update'], 
        //     "WHERE id=:id",
        //     "id=67"
        // );

        // $result = $pdoUpdate->getResult();
        // var_dump($result);

        // echo "<br><hr><br>";

        // $result = $pdoUpdate->sqlResult();
        // var_dump($result);
        // exit;

        // *********************************************************************************
        // ***** CÓDIGO PARA REALIZAR DELETE *****
        // $pdoDelete = new \Helper\Delete();
        // $pdoDelete->exeDelete(
        //     "usuarios", 
        //     "WHERE id=:id",
        //     "id=74"
        // );

        // $result = $pdoDelete->getResult();
        // var_dump($result);

        // echo "<br><hr><br>";

        // $result = $pdoDelete->sqlResult();
        // var_dump($result);
        // exit;


        // *********************************************************************************
        // ***** CÓDIGO PARA USAR PÁGINA DE ERRO DEFAULT *****
        // $u = new \Helper\Utils;
        // $u->errorDefault(
        //     'Erro S400: Erro ao atualizar foto de perfil',
        //     'Erro',
        //     'Voltar',
        //     'login-controller/index',
        //     'N'
        // );
        // exit;

        // return $result;
    }

    // *********************************************************************************
    // FUNÇÃO PARA LOG
    // public function testeLog()
    // {
    //     $logData = [
    //         "dadosUsuario" => [
    //             "dateAlter" => Date('d-m-Y H:i'),
    //             "data" => [
    //                 "oldData" => "Array de dados novos",
    //                 "newData" => "Array de dados antigos"
    //             ]
    //         ]
    //     ];

    //     // PODE PASSAR TODOS OS ATRIBUTOS POR PARÂMETRO
    //     // EX: $this->log($logData, $filePath, $fileName, $fileType);
    //     $this->log($logData);
    // }

    // private function log($logData)
    // {
    //     // DADOS PARA LOG EX: Array $logData
    //     // CAMINHO DO ARQUIVO EX: 'usuarios/' . $userId
    //     // NOME ARQUIVO EX: 'dadosUsuario'
    //     // TIPO ARQUIVO EX: 'json'
    //     $log = new \Helper\Log($logData, 1, 'dadosUsuario', 'json');
    //     var_dump($log->createLog()); 
    // }
}
