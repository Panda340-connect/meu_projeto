<?php

namespace App\Validators;

class UsuarioValidator
{
    public static function validate(array $data, bool $isUpdate = false): array
    {
        $errors = [];

        $nome = trim($data['nome'] ?? '');
        if (empty($nome)) {
            $errors['nome'] = "O campo nome é obrigatório.";
        } elseif (mb_strlen($nome) < 3) {
            $errors['nome'] = "O nome deve ter pelo menos 3 caracteres.";
        } elseif (mb_strlen($nome) > 100) {
            $errors['nome'] = "O nome deve ter no máximo 100 caracteres.";
        }

        $email = trim($data['email'] ?? '');
        if (empty($email)) {
            $errors['email'] = "O campo e-mail é obrigatório.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "O e-mail informado é inválido.";
        } elseif (mb_strlen($email) > 100) {
            $errors['email'] = "O e-mail deve ter no máximo 100 caracteres.";
        }

        $senha = trim($data['senha'] ?? '');
        if (!$isUpdate && empty($senha)) {
            $errors['senha'] = "O campo senha é obrigatório.";
        } elseif (!empty($senha) && mb_strlen($senha) < 6) {
            $errors['senha'] = "A senha deve ter pelo menos 6 caracteres.";
        }

        $telefone = trim($data['telefone'] ?? '');
        if (!empty($telefone)) {
            $somenteNumeros = preg_replace('/\D/', '', $telefone);
            if (strlen($somenteNumeros) < 10 || strlen($somenteNumeros) > 11) {
                $errors['telefone'] = "Informe um telefone válido com DDD (10 ou 11 dígitos).";
            }
        }

        $tiposPermitidos = ['Idoso', 'Cuidador', 'Familiar', 'Administrador'];
        $tipo = trim($data['tipo_usuario'] ?? '');
        if (empty($tipo)) {
            $errors['tipo_usuario'] = "O campo tipo de usuário é obrigatório.";
        } elseif (!in_array($tipo, $tiposPermitidos, true)) {
            $errors['tipo_usuario'] = "Tipo de usuário inválido.";
        }

        return $errors;
    }
}