<?php

namespace Php\LeadsCrmApp;

use \Php\LeadsCrmApp\Settings;
use PDO;
use PDOException;

class DataBase
{

    public static function connect()
    {
        try {
            $dsn = "mysql: host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME']  . ";charset=utf8mb4";
            $db = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            error_log("Connection failed" . $e->getMessage());
            return null;
        }
    }

    public static function select($table, $fields = "*", $where = '', $links = null, $relations = null,  $order = '', $offset = null, $limit = null, $group = '', $having = '')
    {
        $fields = is_array($fields) ? implode(', ', $fields) : $fields;
        $sql = ["SELECT {$fields} FROM {$table}"];

        if ($links) {
            foreach ($links as $extTable) {
                $relation = $relations[$extTable];
                $joinType = $relation['type'] ?? 'INNER';
                $sql[] = "{$joinType} JOIN {$extTable} ON";
                $sql[] = "{$table}.{$relation['external']} = {$extTable}.{$relation['primary']}";
            }
        }

        if ($where) {
            $sql[] = "WHERE {$where}";
        }

        if ($group) {
            $sql[] = "GROUP BY {$group}";
            if ($having) {
                $sql[] = "HAVING {$having}";
            }
        }

        if ($order) {
            $sql[] = "ORDER BY {$order}";
        }

        if ($limit !== null) {
            $sql[] = "LIMIT {$limit}";
            if ($offset !== null) {
                $sql[] = "OFFSET {$offset}";
            }
        }

        return implode(' ', $sql) . ';';
    }

    public static function insert(string $table, array $data): string
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        return $sql;
    }

    public static function update(string $table, array $data, array $conditions): string
    {
        $set = implode(', ', array_map(fn ($col) => "{$col} = ?", array_keys($data)));
        $where = implode(' AND ', array_map(fn ($col) => "{$col} = ?", array_keys($conditions)));

        $sql = "UPDATE {$table} SET {$set} WHERE {$where}";

        return $sql;
    }

    public static function delete(string $table, array $conditions): string
    {
        $where = implode(' AND ', array_map(fn ($col) => "{$col} = ?", array_keys($conditions)));
        $sql = "DELETE FROM {$table} WHERE {$where}";

        return $sql;
    }

    public static function count($table, $column = '*', $distinct_columns = false, $conditions = [])
    {
        $distinct = $distinct_columns ? 'DISTINCT' : '';
        $where = implode(' AND ', array_map(fn ($col) => "{$col} = ?", array_keys($conditions)));
        $sql = "SELECT COUNT($distinct $column) FROM {$table} WHERE {$where}";

        return $sql;
    }
}
