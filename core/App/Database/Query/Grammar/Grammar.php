<?php

namespace Core\App\Database\Query\Grammar;

class Grammar
{
    public const SELECT = 'SELECT';
    public const WHERE  = 'WHERE';
    public const FROM   = 'FROM';

    private $dependents = [
        self::SELECT,
        self::FROM,
        self::WHERE
    ];

    protected $query  = [];
    private $values = [];
    protected $model;

    protected function buildQuery(): GrammarResult
    {
        $sql = implode(' ', $this->compile());
        return new GrammarResult($sql, $this->values, $this->model);
    }

    private function compile(): array
    {
        $sql = [];

        foreach ($this->dependents as $dependent) {
            $method = 'compile'.ucfirst(strtolower($dependent));
            $sql[$dependent] = $this->$method();
        }

        return $sql;
    }

    private function compileWhere(): string
    {
        $clause = self::WHERE . ' ';
        $wrap   = [];

        if(!isset($this->query[self::WHERE])) {
            return '';
        }

        $wheres = $this->query[self::WHERE];

        foreach ($wheres as $where) {
            $this->values[] = $where['value'];
            $where['value'] = '?';

            $wrap[] = implode(' ', $where);
        }

        return $clause . implode(' AND ', $wrap);
    }

    private function compileSelect()
    {
        $clause = [self::SELECT , '*'];

        return implode(' ', $clause);
    }

    private function compileFrom()
    {
        $from   = $this->model->getTable();
        $clause = [self::FROM, $from];

        return implode(' ', $clause);
    }
}