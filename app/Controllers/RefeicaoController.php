<?php

namespace App\Validators;

class RefeicaoValidator
{
    public static function validate(array $data): array
    {
        $errors = [];

        $nomeRefeicao = trim($data['nome_refeicao'] ?? '');
        $descricao = trim($data['descricao'] ?? '');
        $horario = trim($data['horario'] ?? '');
        $idUsuario = (int) ($data['id_usuario'] ?? 0);

        if ($nomeRefeicao === '') {
            $errors['nome_refeicao'] = 'Informe o nome da refeição.';
        } elseif (mb_strlen($nomeRefeicao) > 50) {
            $errors['nome_refeicao'] = 'O nome da refeição deve ter no máximo 50 caracteres.';
        }

        if ($descricao === '') {
            $errors['descricao'] = 'Informe a descrição da refeição.';
        } elseif (mb_strlen($descricao) > 255) {
            $errors['descricao'] = 'A descrição deve ter no máximo 255 caracteres.';
        }

        if ($horario === '') {
            $errors['horario'] = 'Informe o horário da refeição.';
        }

        if ($idUsuario <= 0) {
            $errors['id_usuario'] = 'Selecione um usuário válido.';
        }

        return $errors;
    }
}