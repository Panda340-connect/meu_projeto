<?php

namespace App\Models;

use App\Models\Database;
use PDO;

class Exercicio
{
    public static function all(): array
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT id_exercicio, nome, id_usuario, descricao, frequencia, duracao, data_exercicio, horario FROM exercicio ORDER BY id_exercicio DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(array $dados): bool
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO exercicio (nome, id_usuario, descricao, frequencia, duracao, data_exercicio, horario) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        return $stmt->execute([
            $dados['nome'],
            $dados['id_usuario'],
            $dados['descricao'],
            $dados['frequencia'],
            $dados['duracao'],
            $dados['data_exercicio'],
            $dados['horario'],
        ]);
    }
}
