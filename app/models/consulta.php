<?php

namespace App\Models;

use PDO;

require_once __DIR__ . '/Database.php';

class Consulta
{
    public static function all(): array
    {
        $db = Database::connect();
        $sql = "SELECT c.*, u.nome AS nome_usuario 
                FROM consulta c 
                INNER JOIN usuario u ON c.id_usuario = u.id_usuario 
                ORDER BY c.data_consulta ASC, c.horario ASC";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find(int $id_consulta): ?array
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM consulta WHERE id_consulta = ?");
        $stmt->execute([$id_consulta]);
        $consulta = $stmt->fetch(PDO::FETCH_ASSOC);
        return $consulta ?: null;
    }

    public static function getUsuarios(): array
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT id_usuario, nome FROM usuario ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(array $data): int
    {
        $db = Database::connect();
        $sql = "INSERT INTO consulta (especialidade, nome_medico, data_consulta, horario, local, id_usuario) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            trim($data['especialidade'] ?? ''),
            trim($data['nome_medico'] ?? '') ?: null,
            $data['data_consulta'] ?? '',
            $data['horario'] ?? '',
            trim($data['local'] ?? '') ?: null,
            (int) ($data['id_usuario'] ?? 0)
        ]);
        return (int) $db->lastInsertId();
    }

    public static function update(int $id_consulta, array $data): bool
    {
        $db = Database::connect();
        $sql = "UPDATE consulta 
                SET especialidade = ?, nome_medico = ?, data_consulta = ?, horario = ?, local = ?, id_usuario = ? 
                WHERE id_consulta = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            trim($data['especialidade'] ?? ''),
            trim($data['nome_medico'] ?? '') ?: null,
            $data['data_consulta'] ?? '',
            $data['horario'] ?? '',
            trim($data['local'] ?? '') ?: null,
            (int) ($data['id_usuario'] ?? 0),
            $id_consulta
        ]);
    }

    public static function delete(int $id_consulta): bool
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM consulta WHERE id_consulta = ?");
        return $stmt->execute([$id_consulta]);
    }
}