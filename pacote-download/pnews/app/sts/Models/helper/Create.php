<?php

namespace Helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Create extends conn
{
    private object $insert;
    private string $table;
    private array $values;
    private string $query;
    private object $conn;
    private string|null $result = NULL;
    private array $response;

    // RETORNA DADOS DO BANCO DE DADOS
    function getResult()
    {
        return $this->result;
    }

    // RETORNA STATUS DA SOLICITACAO SQL
    function sqlResult()
    {
        return $this->response;
    }

    // INSERT ALL
    // EX: $pdoCreate->exeCreate("usuarios", $this->data['select']);
    public function exeCreate($table, array $values)
    {
        $this->table = (string) $table;
        $this->values = $values;

        $this->exeReplaceValues();
        $this->exeInstruction();
    }

    // TRATA E CRIA A QUERY A SER EXECUTADA
    private function exeReplaceValues()
    {
        $columns = implode(', ', array_keys($this->values));
        $values = ':' . implode(', :', array_keys($this->values));
        $this->query = "INSERT INTO {$this->table} ($columns) VALUES ($values)";
    }

    // EXECUTA A QUERY
    private function exeInstruction()
    {
        $this->connection();

        try {
            $this->insert->execute($this->values);
            $this->result = $this->conn->lastInsertId();

            //VERIFICA O NÚMERO DE LINHAS AFETADAS E RETORNA UM ARRAY COM O STATUS DA CONSULTA SQL
            $affected_rows = $this->insert->rowCount();
            if ($affected_rows >= 1) {
                $response["status"] = "success";
                $response["idInsert"] = $this->conn->lastInsertid();
                $response["message"] = $affected_rows . " row inserted into database " . $this->table;
            } else {
                $response["status"] = "warning";
                $response["message"] = $affected_rows . " row inserted into database " . $this->table;
            }
        } catch (PDOException $err) {
            $this->result = null;

            $response["status"] = "error";
            $response["message"] = "Insert table failed: " . $err->getMessage();
        }

        $this->response["data"] = $response;
    }

    // CRIA UMA CONEXÃO COM O DB
    private function connection()
    {
        $this->conn = $this->connectDb();
        $this->insert = $this->conn->prepare($this->query);
    }
}
