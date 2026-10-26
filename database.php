<?php

declare(strict_types=1);

class Database
{
    private const HOST = 'localhost';
    private const USERNAME = 'root';
    private const PASSWORD = '';
    private const DATABASE = 'oop_crud';

    private mysqli $connection;

    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $this->connection = new mysqli(
                self::HOST,
                self::USERNAME,
                self::PASSWORD,
                self::DATABASE
            );
            $this->connection->set_charset('utf8mb4');
        } catch (mysqli_sql_exception $e) {
            error_log($e->getMessage());
            http_response_code(500);
            exit('Database connection failed. Please check your configuration.');
        }
    }

    public function getConnection(): mysqli
    {
        return $this->connection;
    }

    public function __destruct()
    {
        if (isset($this->connection)) {
            $this->connection->close();
        }
    }
}
