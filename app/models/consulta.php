<?php

namespace App\Models;

class Consulta
{
    public static function all(): array
    {
        $pdo = Database::connect();
        return $pdo->query('SELECT * FROM consulta ORDER BY data_consulta, horario')->fetchAll();
    }
}