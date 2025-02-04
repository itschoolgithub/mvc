<?php
namespace App\Core;

use \PDO;

class DB
{
    private PDO $connect;

    private $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    public function __construct()
    {
        global $dbConfig;
        $dsn           = "mysql:dbname={$dbConfig['dbname']};host={$dbConfig['host']};port={$dbConfig['port']}";
        $this->connect = new \PDO ($dsn, $dbConfig['username'], $dbConfig['password'], $this->options);
    }
    public function execute($sql, $params = [])
    {
        $query = $this->connect->prepare($sql);
        $query->execute($params);
        return $query;
    }

    public function all($sql, $params = []): array
    {
        $query = $this->execute($sql, $params);
        return $query->fetchAll();
    }

    public function get($sql, $params = []): array | bool
    {
        $query = $this->execute($sql, $params);
        return $query->fetch();
    }

    public function query($sql, $params = []): void
    {
        $this->execute($sql, $params);
    }
}
