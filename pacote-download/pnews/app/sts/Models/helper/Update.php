<?php

namespace Helper;

use PDOException;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Update extends Conn
{
    private object $update;
    private string $table;
    private array $data;
    private string|null $terms;
    private array $values = [];
    private string $query;
    private object $conn;
    private array|null|bool $result = [];
    private array $response;

    // RETORNA DADOS DO BANCO DE DADOS
    function getResult()
    {
        return $this->result;
    }

    // RETORNA STATUS DA SOLICITACAO SQL
    public function sqlResult()
    {
        return $this->response;
    }

    // UPDATE ALL
    // EX: $pdoUpdate->exeUpdate("usuarios", $this->data['update'], "WHERE id=:id", "id=67");
    public function exeUpdate($table, $data, $terms = null, $parseString = null)
    {
        $this->table = (string) $table;
        $this->data  = (array) $data;
        $this->terms = (string) $terms;

        parse_str($parseString, $this->values);

        $this->exeReplaceValues();
        $this->exeInstruction();
    }

    // TRATA E CRIA A QUERY A SER EXECUTADA
    private function exeReplaceValues()
    {
        foreach ($this->data as $key => $column) {
            $columns[] = $key . '=:' . $key;
        }
        $columns = implode(', ', $columns);
        $this->query = "UPDATE {$this->table} SET {$columns} {$this->terms}";
    }

    // EXECUTA A QUERY
    private function exeInstruction()
    {
        $this->connection();
        try {
            $this->update->execute(array_merge($this->data, $this->values));
            $this->result = true;

            $response["status"] = "success";
            $response["message"] = "Row(s) updated into database";
        } catch (PDOException $err) {
            $this->result = false;

            $response["status"] = "error";
            $response["message"] = "Update table Failed: " . $err->getMessage();
        }
        $this->response["data"] = $response;
    }

    // CRIA UMA CONEXÃO COM O DB
    private function connection()
    {
        $this->conn = $this->connectDb();
        $this->update = $this->conn->prepare($this->query);
    }
}
