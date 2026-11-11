<?php

namespace App\Validators;

class UsuarioValidator
{
    public static function validate(array $data): array
    {
        $errors = [];

        if (empty(trim($data['name'] ?? ''))) {
            $errors['name'] = "O campo nome é obrigatório.";
        }

        if (empty(trim($data['email'] ?? ''))) {
            $errors['email'] = "O campo e-mail é obrigatório.";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "O e-mail informado é inválido.";
        }

        if (empty(trim($data['cpf'] ?? ''))) {
            $errors['cpf'] = "O campo CPF é obrigatório.";
        }

        if (empty(trim($data['birth_date'] ?? ''))) {
            $errors['birth_date'] = "O campo data de nascimento é obrigatório.";
        }

        return $errors;
    }
}