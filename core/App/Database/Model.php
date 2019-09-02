<?php

namespace Core\App\Database;

use Core\App\Database\Query\Builder;

class Model
{
    protected $table;

    public static function all(): array
    {
        return (new static)->newQuery()->get();
    }

    public static function query(): Builder
    {
        return (new static)->newQuery();
    }

    public function newQuery(): Builder
    {
        return new Builder($this);
    }

    public function update(array $attributes)
    {

    }

    public function getTable(): string
    {
        return $this->table;
    }
}