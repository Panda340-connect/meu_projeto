<?php

namespace App\Validators;

class ExercicioValidator
{
    public static function validate(array $dados): array
    {
        $erros = [];

        if (empty(trim($dados['nome'] ?? ''))) {
            $erros['nome'] = 'O nome do exercício é obrigatório.';
        }

        if (empty($dados['id_usuario'] ?? '')) {
            $erros['id_usuario'] = 'O usuário é obrigatório.';
        }

        if (empty(trim($dados['descricao'] ?? ''))) {
            $erros['descricao'] = 'A descrição é obrigatória.';
        }

        if (empty(trim($dados['frequencia'] ?? ''))) {
            $erros['frequencia'] = 'A frequência é obrigatória.';
        }

        if (empty(trim($dados['duracao'] ?? ''))) {
            $erros['duracao'] = 'A duração é obrigatória.';
        }

        if (empty($dados['data_exercicio'] ?? '')) {
            $erros['data_exercicio'] = 'A data do exercício é obrigatória.';
        }

        if (empty($dados['horario'] ?? '')) {
            $erros['horario'] = 'O horário é obrigatório.';
        }

        return $erros;
    }
}
