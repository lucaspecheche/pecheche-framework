<?php

namespace Core\App\Database\Query;

use Core\App\Database\Database;
use Core\App\Database\Model;
use Core\App\Database\Query\Grammar\Grammar;

class Builder extends Grammar
{
    protected $model;
    protected $database;
    protected $query;

    public function __construct(Model $model)
    {
        $this->model      = $model;
        $this->query      = [];
        $this->database   = $this->getConnection();
    }

    public function where($column, $operator, $value)
    {
        $this->query[Grammar::WHERE][] = [
            'column' => $column,
            'operator' => $operator,
            'value' => $value
        ];

        return $this;
    }

    public function get()
    {
        return $this->database->get($this->buildQuery());
    }

    public function first()
    {
    }

    protected function getConnection()
    {
        return new Database();
    }

}