<?php

namespace Helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Delete extends conn
{
    private object $delete;
    private string $table;
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

    // DELETE
    // EX: $pdoDelete->exeDelete("usuarios", "WHERE id=:id", "id=100");
    public function exeDelete($table, $terms, $parseString = null)
    {
        $this->table = (string) $table;
        $this->terms = (string) $terms;

        parse_str($parseString, $this->values);

        $this->query = "DELETE FROM {$this->table} {$this->terms}";

        $this->exeInstruction();
    }

    // EXECUTA A QUERY
    private function exeInstruction()
    {
        $this->connection();
        try {
            $this->delete->execute($this->values);
            $this->result = true;

            $response["status"] = "success";
            $response["message"] = "Row deleted into database";
        } catch (PDOException $err) {
            $this->result = false;

            $response["status"] = "error";
            $response["message"] = "Row deleted failed: " . $err->getMessage();
        }

        $this->response["data"] = $response;
    }

    // CRIA UMA CONEXÃO COM O DB
    private function connection()
    {
        $this->conn = $this->connectDb();
        $this->delete = $this->conn->prepare($this->query);
    }
}
