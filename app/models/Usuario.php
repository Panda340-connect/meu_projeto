<?php

namespace App\Models;

use App\Models\Database;
use PDO;

class Usuario
{
    public static function all(): array
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT id_usuario, nome, email, telefone, tipo_usuario FROM usuario ORDER BY id_usuario DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find(int $id): ?array
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT id_usuario, nome, email, telefone, tipo_usuario FROM usuario WHERE id_usuario = ?");
        $stmt->execute([$id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario ?: null;
    }

    public static function create(array $data): int
    {
        $db = Database::connect();
        $sql = "INSERT INTO usuario (nome, email, senha, telefone, tipo_usuario) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            $data['nome'] ?? '',
            $data['email'] ?? '',
            password_hash($data['senha'] ?? '', PASSWORD_DEFAULT),
            $data['telefone'] ?? null,
            $data['tipo_usuario'] ?? 'Idoso'
        ]);
        return (int) $db->lastInsertId();
    }

    public static function update(int $id, array $data): bool
    {
        $db = Database::connect();

        if (!empty($data['senha'])) {
            $sql = "UPDATE usuario SET nome = ?, email = ?, senha = ?, telefone = ?, tipo_usuario = ? WHERE id_usuario = ?";
            $stmt = $db->prepare($sql);
            return $stmt->execute([
                $data['nome'] ?? '',
                $data['email'] ?? '',
                password_hash($data['senha'], PASSWORD_DEFAULT),
                $data['telefone'] ?? null,
                $data['tipo_usuario'] ?? 'Idoso',
                $id
            ]);
        }

        $sql = "UPDATE usuario SET nome = ?, email = ?, telefone = ?, tipo_usuario = ? WHERE id_usuario = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            $data['nome'] ?? '',
            $data['email'] ?? '',
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