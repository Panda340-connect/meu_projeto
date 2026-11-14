<?php

namespace App\Models;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $instance = null;

    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            $config = require __DIR__ . '/../../config/database.php';

            try {
                $dsn = "mysql:host={$config['host']};dbname={$config['name']};charset=utf8mb4";

                self::$instance = new PDO($dsn, $config['user'], $config['pass'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                die("Erro na conexão com o banco de dados: " . $e->getMessage());
            }
        }

        return self::$instance;
    }

    public static function connect(): PDO
    {
        return self::getConnection();
    }
}