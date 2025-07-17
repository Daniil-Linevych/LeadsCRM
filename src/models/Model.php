<?php

namespace Php\LeadsCrmApp\Models;

use Php\LeadsCrmApp\DataBase;
use PDO;
use PDOStatement;
use Iterator;

class Model implements Iterator
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

    public function get_query($sql, $params)
    {
        $this->run($sql, $params);
        return $this->query?->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function get_record($fields = "*", $where = '',  $params = null, $links = null)
    {
    }


    function current(): mixed
    {
        return $this->record;
    }

    function next(): void
    {
        $this->record = $this->query?->fetch(PDO::FETCH_ASSOC) ?? false;
    }

    function key(): mixed
    {
        return 0;
    }

    function rewind(): void
    {
        $this->record = $this->query->fetch(PDO::FETCH_ASSOC) ?? false;
    }

    function valid(): bool
    {
        return $this->record !== FALSE;
    }
}
