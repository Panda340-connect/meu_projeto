<?php
namespace App\Models;

// Database pertence ao mesmo namespace App\Models.
class User
{
    public static function all(): array
    {
        return Database::connect()
            ->query('SELECT * FROM users ORDER BY name')
            ->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $stmt = Database::connect()->prepare(
            'SELECT * FROM users WHERE id = ?'
        );
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public static function emailExists(string $email): bool
    {
        $stmt = Database::connect()->prepare(
            'SELECT 1 FROM users WHERE email = ?'
        );
        $stmt->execute([$email]);
        return (bool) $stmt->fetchColumn();
    }

    public static function create(string $name, string $email): int
    {
        $stmt = Database::connect()->prepare(
            'INSERT INTO users (name, email) VALUES (?, ?)'
        );
        $stmt->execute([$name, $email]);
        return (int) Database::connect()->lastInsertId();
    }
    public static function update(int $id, array $data): bool 
{
    $stmt = Database::connect()->prepare(
        'UPDATE users 
         SET name = ?, last_name = ?, email = ?, cpf = ?, birth_date = ? 
         WHERE id = ?'
    );
    return $stmt->execute([
        $data['name'], 
        $data['last_name'], 
        $data['email'], 
        $data['cpf'], 
        $data['birth_date'], 
        $id
    ]);
}
}