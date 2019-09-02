<?php

namespace Core\App\Database;

use Core\App\Database\Query\Grammar\GrammarResult;

class Database extends Connection
{
    public function get(GrammarResult $query, bool $first = false)
    {
        $statement = $this->prepare($query);

        $statement->execute();

        return $first
            ? $statement->fetch()
            : $statement->fetchAll();
    }

}