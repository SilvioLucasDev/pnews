<?php

namespace Helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

use PDO;

class Read extends Conn
{
    private object $select;
    private array|null $values;
    private string $query;
    private object $conn;
    private array|null $result = [];
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

    // SELECT ALL (*)
    // EX: pdoSelect->exeRead("usuario", "WHERE id=:id LIMIT:limit", "id=1&limit=1");
    public function exeRead($table, $terms = NULL, $parseString = NULL)
    {
        if (!empty($parseString)) {
            parse_str($parseString, $this->values);
        }

        $this->query = "SELECT * FROM {$table} {$terms}";

        $this->exeInstruction();
    }

    // SELECT ESPECÍFICO, CONSIGO DEFINIR OS CAMPOS
    // EX: pdoSelect->exeRead("SELECT id, nome FROM usuario WHERE id=:id LIMIT:limit", "id=1&limit=1");
    public function fullRead($query, $parseString = NULL)
    {
        $this->query = (string) $query;

        if (!empty($parseString)) {
            parse_str($parseString, $this->values);
        }

        $this->exeInstruction();
    }

    //EXECUTA A QUERY
    private function exeInstruction()
    {
        $this->connection();

        try {
            $this->exeParameter();
            $this->select->execute();
            $this->result = $this->select->fetchAll();

            //VERIFICA O NÚMERO DE LINHAS AFETADAS E RETORNA UM ARRAY COM O STATUS DA CONSULTA SQL
            $affected_rows = $this->select->rowCount();
            if ($affected_rows >= 1) {
                $response["status"] = "success";
                $response["message"] = $affected_rows . " row updated into database";
            } else {
                $response["status"] = "warning";
                $response["message"] = $affected_rows . " row(s) updated into database. No row updated";
            }
        } catch (PDOException  $err) {
            $this->result = NULL;

            $response["status"] = "error";
            $response["message"] = "Update table failed: " . $err->getMessage();
        }

        $this->response = $response;
    }

    // CRIA UMA CONEXÃO COM O DB
    private function connection()
    {
        $this->conn = $this->connectDb();
        $this->select = $this->conn->prepare($this->query);
        $this->select->setFetchMode(PDO::FETCH_ASSOC);
    }

    // PARSE STRING (BIND VALUE) PARA EVITAR SQL INJECTION
    private function exeParameter()
    {
        if (isset($this->values)) {
            foreach ($this->values as $key => $value) {
                if ($key == 'limit' || $key == 'offset' || $key == 'id') {
                    $value = (int) $value;
                }
                $this->select->bindValue(":{$key}", $value, (is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
        }
    }
}
