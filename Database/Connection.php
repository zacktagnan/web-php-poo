<?php

namespace Database;

class Connection
{
    private $connection      = null;
    private static $instance = null;

    private function __construct()
    {
        $dsn = "mysql:dbname={$_ENV['DB_DATABASE']};host={$_ENV['DB_HOST'] }";
        try {
            $this->connection = new \PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
            //} catch (PDOException $e) { // original pero con ERROR
        } catch (\PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return self::getInstance()->connection;
    }
}
