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

    public static function find(int $id): ?array
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT id_exercicio, nome, id_usuario, descricao, frequencia, duracao, data_exercicio, horario FROM exercicio WHERE id_exercicio = ?");
        $stmt->execute([$id]);
        $exercicio = $stmt->fetch(PDO::FETCH_ASSOC);
        return $exercicio ?: null;
    }

    public static function create(array $dados): bool
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO exercicio (nome, id_usuario, descricao, frequencia, duracao, data_exercicio, horario) VALUES (?, ?, ?, ?, ?, ?, ?)");

        return $stmt->execute([
            $dados['nome'] ?? '',
            $dados['id_usuario'] ?? null,
            $dados['descricao'] ?? '',
            $dados['frequencia'] ?? '',
            $dados['duracao'] ?? '',
            $dados['data_exercicio'] ?? null,
            $dados['horario'] ?? null,
        ]);
    }

    public static function update(int $id, array $dados): bool
    {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE exercicio SET nome = ?, id_usuario = ?, descricao = ?, frequencia = ?, duracao = ?, data_exercicio = ?, horario = ? WHERE id_exercicio = ?");

        return $stmt->execute([
            $dados['nome'] ?? '',
            $dados['id_usuario'] ?? null,
            $dados['descricao'] ?? '',
            $dados['frequencia'] ?? '',
            $dados['duracao'] ?? '',
            $dados['data_exercicio'] ?? null,
            $dados['horario'] ?? null,
            $id,
        ]);
    }

    public static function delete(int $id): bool
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM exercicio WHERE id_exercicio = ?");
        return $stmt->execute([$id]);
    }
}