<?php

namespace App\Models;

use App\Models\Database;
use PDO;

class Usuario
{
    public static function all(): array
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM usuarios ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find(int $id): ?array
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    public static function create(array $data): int
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO usuarios (name, last_name, email, cpf, birth_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['name'] ?? '',
            $data['last_name'] ?? '',
            $data['email'] ?? '',
            $data['cpf'] ?? '',
            $data['birth_date'] ?? null
        ]);
        return (int) $db->lastInsertId();
    }

    public static function update(int $id, array $data): bool
    {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE usuarios SET name = ?, last_name = ?, email = ?, cpf = ?, birth_date = ? WHERE id = ?");
        return $stmt->execute([
            $data['name'] ?? '',
            $data['last_name'] ?? '',
            $data['email'] ?? '',
            $data['cpf'] ?? '',
            $data['birth_date'] ?? null,
            $id
        ]);
    }

    public static function delete(int $id): bool
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }
}