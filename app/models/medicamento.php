<?php

namespace App\Models;

use PDO;

require_once __DIR__ . '/Database.php';

class Medicamento
{
    public static function all(): array
    {
        $pdo = Database::getConnection();
        $sql = "SELECT m.*, u.nome AS nome_usuario
                FROM medicamento m
                INNER JOIN usuario u ON m.id_usuario = u.id_usuario
                ORDER BY m.horario ASC, m.id_medicamento DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $pdo = Database::getConnection();
        $sql = "SELECT * FROM medicamento WHERE id_medicamento = :id LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function create(array $data): bool
    {
        $pdo = Database::getConnection();
        $sql = "INSERT INTO medicamento (nome_medicamento, dosagem, horario, frequencia, id_usuario)
                VALUES (:nome_medicamento, :dosagem, :horario, :frequencia, :id_usuario)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':nome_medicamento' => trim($data['nome_medicamento'] ?? ''),
            ':dosagem' => trim($data['dosagem'] ?? ''),
            ':horario' => trim($data['horario'] ?? ''),
            ':frequencia' => trim($data['frequencia'] ?? ''),
            ':id_usuario' => (int) ($data['id_usuario'] ?? 0),
        ]);
    }

    public static function update(int $id, array $data): bool
    {
        $pdo = Database::getConnection();
        $sql = "UPDATE medicamento
                SET nome_medicamento = :nome_medicamento,
                    dosagem = :dosagem,
                    horario = :horario,
                    frequencia = :frequencia,
                    id_usuario = :id_usuario
                WHERE id_medicamento = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':nome_medicamento' => trim($data['nome_medicamento'] ?? ''),
            ':dosagem' => trim($data['dosagem'] ?? ''),
            ':horario' => trim($data['horario'] ?? ''),
            ':frequencia' => trim($data['frequencia'] ?? ''),
            ':id_usuario' => (int) ($data['id_usuario'] ?? 0),
        ]);
    }

    public static function delete(int $id): bool
    {
        $pdo = Database::getConnection();
        $sql = "DELETE FROM medicamento WHERE id_medicamento = :id";
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