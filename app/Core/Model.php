<?php
namespace App\Core;

abstract class Model
{
    protected DB $database;

    public function __construct()
    {
        $this->database = new DB;
    }

    abstract public function all(): array;

    abstract public function get(int $id): array | bool;

    abstract public function create(array $data): void;

    abstract public function update(array $data): void;
    
    abstract public function delete(int $id): void;
}
