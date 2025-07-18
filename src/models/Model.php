<?php

namespace Php\LeadsCrmApp\Models;

use Php\LeadsCrmApp\DataBase;
use PDO;
use PDOStatement;
use Iterator;

class Model
{
    protected const TABLE_NAME = '';
    protected const RELATIONS = [];

    private static ?PDO $connection = null;
    private static $connection_count = 0;

    private ?PDOStatement $query = null;
    private array|false $record = false;

    function __construct()
    {
        if (!self::$connection) {
            self::$connection = DataBase::connect();
        }
        self::$connection_count++;
    }

    function __destruct()
    {
        self::$connection_count--;
        if (self::$connection_count == 0) {
            self::$connection = null;
        }
    }

    public function run($sql, $params = null)
    {
        $this->closePreviousQuery();
        $this->query = self::$connection->prepare($sql);
        if ($params) {
            $this->bindParams($params);
        }

        $this->query->execute();
    }

    protected function closePreviousQuery(): void
    {
        if ($this->query) {
            $this->query->closeCursor();
        }
    }

    protected function bindParams(array $params): void
    {
        foreach ($params as $key => $value) {
            $paramKey = is_int($key) ? $key + 1 : $key;
            $this->query->bindValue(
                $paramKey,
                $value,
                $this->getPdoParamType($value)
            );
        }
    }

    protected function getPdoParamType(mixed $value): int
    {
        return match (gettype($value)) {
            'integer' => PDO::PARAM_INT,
            'boolean' => PDO::PARAM_BOOL,
            'NULL' => PDO::PARAM_NULL,
            default => PDO::PARAM_STR,
        };
    }

    public function select($fields = "*", $where = '',  $params = null, $links = null, $order = '', $offset = null, $limit = null, $group = '', $having = '')
    {
        $sql = DataBase::select(static::TABLE_NAME, $fields, $where, $links, static::RELATIONS, $order, $offset, $limit, $group, $having);
        $this->run($sql, $params);
        try {
            $this->run($sql, $params);
        } catch (\PDOException $e) {
            error_log("Create failed: " . $e->getMessage());
            return false;
        }
    }

    public function create(array $data)
    {
        $sql = DataBase::insert(static::TABLE_NAME, $data);
        try {
            $this->run($sql, array_values($data));
        } catch (\PDOException $e) {
            error_log("Create failed: " . $e->getMessage());
            return false;
        }
    }

    public function update(array $data, array $conditions = null)
    {
        $sql = DataBase::update(static::TABLE_NAME, $data, $conditions);
        $params = array_merge($data, $conditions);
        try {
            $this->run($sql, array_values($params));
        } catch (\PDOException $e) {
            error_log("Update failed: " . $e->getMessage());
            return false;
        }
    }

    public function delete(array $conditions)
    {
        $sql = DataBase::delete(static::TABLE_NAME, $conditions);
        try {
            $this->run($sql, array_values($conditions));
        } catch (\PDOException $e) {
            error_log("Delete failed: " . $e->getMessage());
            return false;
        }
    }

    public function find(array $param): ?array
    {
        $this->select('*', "{$param['key']} = :{$param['key']}", ["{$param['key']}" => $param['value']]);
        return $this->query?->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function all(): array
    {
        $this->select();
        return $this->query?->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    public function countAll()
    {
        $sql = DataBase::count(static::TABLE_NAME);
        try {
            $this->run($sql);
        } catch (\PDOException $e) {
            error_log("Select count failed: " . $e->getMessage());
            return false;
        }
        return $this->query?->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getRecordByQuery($sql, $params)
    {
        $this->run($sql, $params);
        return $this->query?->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
