<?php

namespace App\Models;

use PDO;

require_once __DIR__ . '/Database.php';

class Refeicao
{
    public static function all(): array
    {
        $pdo = Database::getConnection();
        $sql = "SELECT r.*, u.nome AS nome_usuario
                FROM refeicao r
                INNER JOIN usuario u ON r.id_usuario = u.id_usuario
                ORDER BY r.horario ASC, r.id_refeicao DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $pdo = Database::getConnection();
        $sql = "SELECT * FROM refeicao WHERE id_refeicao = :id LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function create(array $data): bool
    {
        $pdo = Database::getConnection();
        $sql = "INSERT INTO refeicao (nome_refeicao, descricao, horario, id_usuario)
                VALUES (:nome_refeicao, :descricao, :horario, :id_usuario)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':nome_refeicao' => trim($data['nome_refeicao'] ?? ''),
            ':descricao' => trim($data['descricao'] ?? ''),
            ':horario' => trim($data['horario'] ?? ''),
            ':id_usuario' => (int) ($data['id_usuario'] ?? 0),
        ]);
    }

    public static function update(int $id, array $data): bool
    {
        $pdo = Database::getConnection();
        $sql = "UPDATE refeicao
                SET nome_refeicao = :nome_refeicao,
                    descricao = :descricao,
                    horario = :horario,
                    id_usuario = :id_usuario
                WHERE id_refeicao = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':nome_refeicao' => trim($data['nome_refeicao'] ?? ''),
            ':descricao' => trim($data['descricao'] ?? ''),
            ':horario' => trim($data['horario'] ?? ''),
            ':id_usuario' => (int) ($data['id_usuario'] ?? 0),
        ]);
    }

    public static function delete(int $id): bool
    {
        $pdo = Database::getConnection();
        $sql = "DELETE FROM refeicao WHERE id_refeicao = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public static function getUsuarios(): array
    {
        $pdo = Database::getConnection();
        $sql = "SELECT id_usuario, nome FROM usuario ORDER BY nome ASC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }
}