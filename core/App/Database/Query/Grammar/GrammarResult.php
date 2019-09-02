<?php

namespace Core\App\Database\Query\Grammar;

use Core\App\Database\Model;

class GrammarResult
{
    protected $sql;
    protected $values;
    protected $model;

    public function __construct(string $sql, array $values, Model $model)
    {
        $this->sql = $sql;
        $this->model = $model;
        $this->values = $values;
    }

    /**
     * @return string
     */
    public function getSql(): string
    {
        return $this->sql;
    }

    /**
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @return string
     */
    public function modelName(): string
    {
        return get_class($this->model);
    }


}