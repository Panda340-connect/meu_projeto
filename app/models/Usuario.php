<?php

namespace App\Models;

use PDO;

require_once __DIR__ . '/Database.php';

class Usuario
{
    public static function all(): array
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM usuario ORDER BY id_usuario DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find(int $id): ?array
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM usuario WHERE id_usuario = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    public static function create(array $data): int
    {
        $db = Database::connect();
        $sql = "INSERT INTO usuario (nome, email, senha, telefone, tipo_usuario) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            $data['nome'] ?? '',
            $data['email'] ?? '',
            $data['senha'] ?? '',
            $data['telefone'] ?? null,
            $data['tipo_usuario'] ?? 'Idoso'
        ]);
        return (int) $db->lastInsertId();
    }

    public static function update(int $id, array $data): bool
    {
        $db = Database::connect();
        $sql = "UPDATE usuario SET nome = ?, email = ?, senha = ?, telefone = ?, tipo_usuario = ? WHERE id_usuario = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            $data['nome'] ?? '',
            $data['email'] ?? '',
            $data['senha'] ?? '',
            $data['telefone'] ?? null,
            $data['tipo_usuario'] ?? 'Idoso',
            $id
        ]);
    }

    public static function delete(int $id): bool
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM usuario WHERE id_usuario = ?");
        return $stmt->execute([$id]);
    }
}