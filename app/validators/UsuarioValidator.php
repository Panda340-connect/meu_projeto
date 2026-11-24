<?php

namespace App\Validators;

class UsuarioValidator
{
    public static function validate(array $data, bool $isUpdate = false): array
    {
        $errors = [];

        if (empty(trim($data['nome'] ?? ''))) {
            $errors['nome'] = "O campo nome é obrigatório.";
        }

        if (empty(trim($data['email'] ?? ''))) {
            $errors['email'] = "O campo e-mail é obrigatório.";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "O e-mail informado é inválido.";
        }

        if (!$isUpdate && empty(trim($data['senha'] ?? ''))) {
            $errors['senha'] = "O campo senha é obrigatório.";
        }

        if (!empty(trim($data['telefone'] ?? '')) && strlen(preg_replace('/\D/', '', $data['telefone'])) < 10) {
            $errors['telefone'] = "Informe um telefone válido com DDD.";
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