<?php

namespace Core\App\Database;

use Core\App\Database\Query\Grammar\GrammarResult;
use PDO;
use PDOStatement;

class Connection
{
    public function newConnection(): PDO
    {
        $config = $this->getConfig();

        $connection = new PDO( "$config->drive:host=$config->hostname;dbname=$config->database", $config->username, $config->password);

        $connection->setAttribute(PDO::ATTR_PERSISTENT, true);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connection;
    }

    protected function getConfig(): object
    {
        $databases  = config('database');
        $connection = $databases['connection'];
        return (object) array_merge($databases[$connection], ['drive' => $connection]);
    }

    public function bindValues(PDOStatement $statement, array $values): Connection
    {
        foreach ($values as $key => $value) {
            $statement->bindValue($key + 1, $value,
                is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR);
        }

        return $this;
    }

    public function prepare(GrammarResult $query): PDOStatement
    {
        $statement = $this->newConnection()->prepare($query->getSql());
        $statement->setFetchMode(\PDO::FETCH_CLASS, $query->modelName());
        $this->bindValues($statement, $query->getValues());

        return $statement;
    }
}